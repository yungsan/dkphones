<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Laravel\Prompts\Output\ConsoleOutput;
use Validator;

class AuthEmployeeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:employee', ['except' => ['login', 'register']]);
    // }

    public function login(Request $request)
    {
        $credentials = [
            'EmployeeEmail' => $request->input('EmployeeEmail'),
            'password' => $request->input('Password')
        ];

        if (
            !$token = auth()->guard('employee')->attempt($credentials)
        ) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {

        $user = Employee::create([
            'EmployeeName' => $request->input('EmployeeName'),
            'EmployeeEmail' => $request->input('EmployeeEmail'),
            'Gender' => $request->input('Gender') ? $request->input('Gender') : 1,
            'DepartmentID' => $request->input('DepartmentID'),
            'PositionID' => $request->input('PositionID'),
            'PhoneNumber' => $request->input('PhoneNumber'),
            'HashedPassword' => $request->input('Password'),
        ]);

        // return $this->login($request);

        return response()->json([
            'message' => 'User successfully craete !',
            'user' => $user,
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function changePassWord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $userId = auth()->user()->id;

        $user = Employee::where('id', $userId)->update(
            ['password' => bcrypt($request->new_password)]
        );

        return response()->json([
            'message' => 'User successfully changed password',
            'user' => $user,
        ], 201);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => auth()->guard('employee')->user(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

