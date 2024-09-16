<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SuperAdminGuard;

use Illuminate\Http\Request;




Route::redirect('/','/login');
Route::get('/login',[AuthController::class, 'getLoginPage'])->name('auth.loginPage')->middleware('guest');

Route::get('/forgot-password',[AuthController::class, 'getForgotPasswordPage'])->name('auth.getForgotPasswordPage')->middleware('guest');
Route::post('/forgot-password',[AuthController::class, 'requestForgotPasswordLink'])->name('auth.requestForgotPasswordLink')->middleware('guest');

Route::get('/reset-password/{token}',[AuthController::class, 'getPasswordResetPage'])->name('password.reset')->middleware('guest');
Route::post('/reset-password',[AuthController::class, 'resetPassword'])->name('auth.resetPassword')->middleware('guest');

Route::post('/login',[AuthController::class, 'authenticate'])->name('auth.login')->middleware('guest');
Route::post('/logout',[AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::resource('customers', CustomerController::class)->middleware('auth');
Route::resource('orders', OrderController::class)->middleware('auth');
Route::resource('products', ProductController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware(['auth', SuperAdminGuard::class]);


Route::get('/homepage', function () {
    return view('homepage');
 })->name('homepage');




























// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/hello', function(){
//     return "Hi";
// })->name('hello')->middleware([Bouncer::class]);

// Route::get('/hello', [StudentController::class, 'sayHello']);

// Route::get('/hi', [StudentController::class, 'sayWelcome']);


// Route::get('/students/{name}/{id}', function($id, $name){
//     //  return route('hello');
//     return "<h1>Id : {$id}  Student Name: {$name}  </h1>";
// });
