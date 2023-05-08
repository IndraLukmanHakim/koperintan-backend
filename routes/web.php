<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ProductGalleryController;
use App\Http\Controllers\Web\TransactionController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get("/login", [AuthController::class, 'login'])->name('login');
Route::post("/login", [AuthController::class, 'loginAuth'])->middleware('guest');

Route::middleware(['auth'])->group(function () {
  Route::post("/logout", [AuthController::class, 'logout']);

  Route::get('/', [DashboardController::class, 'index']);

  Route::get('/user', [UserController::class, 'index']);
  Route::get('/user/get/{user}', [UserController::class, 'get']);
  Route::post('/user/create', [UserController::class, 'create']);
  Route::post('/user/update', [UserController::class, 'update']);
  Route::post('/user/delete/{user}', [UserController::class, 'delete']);

  Route::get('/produk', [ProductController::class, 'index']);
  Route::get('/produk/get/{product}', [ProductController::class, 'get']);
  Route::post('/produk/create', [ProductController::class, 'create']);
  Route::post('/produk/update', [ProductController::class, 'update']);
  Route::post('/produk/delete/{product}', [ProductController::class, 'delete']);

  Route::get('/produk/gallery', [ProductGalleryController::class, 'index']);
  Route::get('/produk/gallery/{product}', [ProductGalleryController::class, 'kelola']);
  Route::post('/produk/gallery/create/{product}', [ProductGalleryController::class, 'create']);
  Route::post('/produk/gallery/delete/{productGallery}', [ProductGalleryController::class, 'delete']);

  Route::get('/transaksi', [TransactionController::class, 'index']);
  Route::post('/transaksi/update-status/{transaction}', [TransactionController::class, 'updateStatus']);
  Route::get('/transaksi/detail/{transaction}', [TransactionController::class, 'detail']);
  Route::post('/transaksi/delete/{transaction}', [TransactionController::class, 'delete']);
  Route::post('/transaksi/invoice/{transaction}', [TransactionController::class, 'invoice']);
  Route::get("/transaksi/export", [TransactionController::class, 'export']);
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
