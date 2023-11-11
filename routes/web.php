<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/home', function () {
    return view('home');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/otp2', function () {
    return view('otp2');
});
Route::get('/new', function () {
    return view('new');
});



Route::post('/register',[user::class,'store'])->name('validate.form');



Route::get('/forgot', function () {
    return view('forgot');
});
Route::get('/form', function () {
    return view('form');
});
Route::get('/navbar', function () {
    return view('navbar');
});
Route::post('/insert', [user::class,'create']);
Route::post('/setpass', [user::class,'setpassword']);







Route::post('/forget',[user::class,'forgot']);
Route::post('/confirm',[user::class,'confirm']);


Route::post('/active1',[user::class,'active']);
Route::get('/table', [user::class,'index']);
Route::get('/update/{id}', [user::class,'edit']);
Route::get('/delete/{id}', [user::class,'destroy']);
Route::get('/send', [user::class,'sendmail']);
Route::get('/active', function () {
    return view('active');
});






