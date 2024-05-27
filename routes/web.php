<?php

use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/product', [HomeController::class, 'product']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/product/{id}', [HomeController::class, 'detail']);

Route::get('/login', function () {
  return view('pages/login');
});

Route::post('/login', [AuthCustomerController::class, 'login']);


Route::post('/register', [AuthCustomerController::class, 'register']);
Route::get('/register', function () {
  return view('pages/register');
});


Route::middleware(['jwt.cookie'])->group(function () {
  Route::get('/profile', [HomeController::class, 'profile']);
  Route::put('/profile', [HomeController::class, 'editProfile'])->name('profile.update');
  Route::post('/logout', [AuthCustomerController::class, 'logout'])->name('auth.logout');
  Route::get('/order/{id}', [OrderController::class, 'orderDetail']);
  Route::put('/cancel-order', [OrderController::class, 'cancelOrder'])->name('aaa');

  Route::get('/cart', [CartController::class, 'addCart'])->name('cart.page');
  Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
  Route::delete('/addToCart', [CartController::class, 'deleteCart'])->name('deleteCart');
  Route::post('/buyNow', [CartController::class, 'buyNow'])->name('buyNow');

  Route::get('/checkout', [OrderController::class, 'index'])->name('checkout.page');
  Route::post('/checkout', [OrderController::class, 'create'])->name('checkout');

});


