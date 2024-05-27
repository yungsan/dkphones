<?php

use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\AuthEmployeeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeparmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceivedNoteController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'customer-auth'

], function ($router) {

    Route::group([

        'middleware' => 'auth:api'

    ], function ($router) {
        Route::post('logout', [AuthCustomerController::class, 'logout']);
        Route::post('refresh', [AuthCustomerController::class, 'refresh']);
        Route::post('me', [AuthCustomerController::class, 'me']);
    });

    Route::post('login', [AuthCustomerController::class, 'login']);
    Route::post('register', [AuthCustomerController::class, 'register']);

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'employee-auth'

], function ($router) {

    Route::group([
        'middleware' => 'auth:employee'
    ], function ($router) {
        Route::post('logout', [AuthEmployeeController::class, 'logout']);
        Route::post('refresh', [AuthEmployeeController::class, 'refresh']);
        Route::post('me', [AuthEmployeeController::class, 'me']);
    });

    Route::post('login', [AuthEmployeeController::class, 'login']);
    Route::post('register', [AuthEmployeeController::class, 'register']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'product'
], function ($router) {
    Route::get('/', [ProductController::class, 'getAll']);
    Route::post('/searchSKUBySupplier', [ProductController::class, 'searchSKUBySupplier']);

    Route::group([
        'middleware' => 'auth:employee'
    ], function ($router) {
        Route::post('create', [ProductController::class, 'create']);
        Route::put('update', [ProductController::class, 'update']);
        Route::delete('delete', [ProductController::class, 'delete']);
    });
});

Route::group([
    'middleware' => ['api', 'auth:employee', 'auth.role:1'],
    'prefix' => 'department'
], function ($router) {
    Route::get('/', [DeparmentController::class, 'getAll']);
    Route::post('/create', [DeparmentController::class, 'create']);
    Route::put('/update', [DeparmentController::class, 'update']);
    Route::delete('/delete', [DeparmentController::class, 'delete']);
});

Route::group([
    'middleware' => ['api', 'auth:employee', 'auth.role:1'],
    'prefix' => 'position'
], function ($router) {
    Route::post('/create', [PositionController::class, 'create']);
    Route::put('/update', [PositionController::class, 'update']);
    Route::delete('/delete', [PositionController::class, 'delete']);
    Route::get('/', [PositionController::class, 'getAll']);
    Route::get('/getOne', [PositionController::class, 'getOne']);
});

Route::group([
    'middleware' => ['api', 'auth:employee'],
    'prefix' => 'employee'
], function ($router) {

    Route::put('/update', [EmployeeController::class, 'update']);

    Route::group([
        'middleware' => 'auth.role:1'
    ], function ($router) {
        Route::get('/', [EmployeeController::class, 'getAll']);
        Route::delete('/delete', [EmployeeController::class, 'delete']);
    });

    Route::middleware('auth.role:1,3')->get('/getShipper', [EmployeeController::class, 'getShipper']);


});

Route::group([
    'middleware' => ['api', 'auth:employee'],
    'prefix' => 'customer'
], function ($router) {

    Route::get('/', [CustomerController::class, 'getAll']);
    Route::delete('/delete', [CustomerController::class, 'delete']);

    Route::put('/update', [CustomerController::class, 'update']);

});


Route::group([
    'middleware' => ['api', 'auth:employee', 'auth.role:1,2,3,4'],
    'prefix' => 'supplier'
], function ($router) {


    Route::get('/', [SupplierController::class, 'getAll']);
    Route::post('/create', [SupplierController::class, 'create']);
    Route::put('/update', [SupplierController::class, 'update']);
    Route::delete('/delete', [SupplierController::class, 'delete']);

});

Route::group([
    'middleware' => ['api', 'auth:employee'],
    'prefix' => 'status'
], function ($router) {


    Route::get('/', [StatusController::class, 'getAll']);
    Route::post('/create', [StatusController::class, 'create']);
    Route::put('/update', [StatusController::class, 'update']);
    Route::delete('/delete', [StatusController::class, 'delete']);

});


Route::group([
    'middleware' => ['api', 'auth:employee', 'auth.role:1,2,3,4'],
    'prefix' => 'brand'
], function ($router) {


    Route::get('/', [BrandController::class, 'getAll']);
    Route::post('/create', [BrandController::class, 'create']);
    Route::put('/update', [BrandController::class, 'update']);
    Route::delete('/delete', [BrandController::class, 'delete']);

});


Route::group([
    'middleware' => ['api', 'auth:employee', 'auth.role:1,2,4'],
    'prefix' => 'warehouse'
], function ($router) {

    Route::group([
        'middleware' => ['api', 'auth:employee', 'auth.role:1'],
    ], function ($router) {
        Route::post('/create', [WarehouseController::class, 'create']);
        Route::put('/update', [WarehouseController::class, 'update']);
        Route::delete('/delete', [WarehouseController::class, 'delete']);
    });

    Route::get('/', [WarehouseController::class, 'getAll']);

});

Route::group([
    'middleware' => ['api', 'auth:employee', 'auth.role:1,2'],
    'prefix' => 'received-note'
], function ($router) {


    Route::get('/', [ReceivedNoteController::class, 'getAll']);
    Route::post('/create', [ReceivedNoteController::class, 'create']);
    Route::put('/update', [ReceivedNoteController::class, 'update']);
    Route::delete('/delete', [ReceivedNoteController::class, 'delete']);

});

Route::group([
    'middleware' => ['api', 'auth:employee'],
    'prefix' => 'order'
], function ($router) {


    Route::get('/', [OrderController::class, 'getAll']);
    Route::get('/dashboard', [OrderController::class, 'dasboard']);
    Route::put('/update', [OrderController::class, 'update']);

});