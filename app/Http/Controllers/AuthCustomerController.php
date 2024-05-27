<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Support\Facades\Cookie;
use Validator;


class AuthCustomerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    public function login(Request $request)
    {
        $credentials = [
            'PhoneNumber' => $request->input('PhoneNumber'),
            'password' => $request->input('Password')
        ];


        if (
            !$token = auth('api')->attempt($credentials)
        ) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $cookie = Cookie::make('jwt_token', $token, 60, null, null, true, true, false, 'Strict');

        return redirect('/')->cookie($cookie);
    }

    public function register(Request $request)
    {

        $user = Customer::create([
            'CustomerName' => $request->input('CustomerName'),
            'Gender' => $request->input('Gender'),
            'PhoneNumber' => $request->input('PhoneNumber'),
            'HashedPassword' => $request->input('Password'),
        ]);

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        Cookie::queue(Cookie::forget('jwt_token', '/'));

        return redirect('/');

        // return response()->json(['message' => 'User successfully signed out']);
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

        $user = Customer::where('id', $userId)->update(
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
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
