<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Products;
use App\Http\Controllers\CartItems;
use App\Http\Controllers\Carts;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

// Route::group(['middleware' => 'check.word'], function () {
//   Route::resource('products', Products::class);
// });

Route::middleware('check.word')->group(function () {
  Route::resource('products', Products::class);
});

Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
  Route::get('user', [AuthController::class, 'user']);
  Route::get('logout', [AuthController::class, 'logout']);
  Route::post('carts/checkout', [Carts::class, 'checkout']);
  Route::resource('cart_items', CartItems::class);
  Route::resource('carts', Carts::class);
});
