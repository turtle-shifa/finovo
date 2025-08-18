<?php

use App\Http\Controllers\InboundController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;

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

Route::get('/test', function(){
    return view('test');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup',function(){
    return view('signup');
});

Route::get('/signin',function(){
    return view('signin');
});

Route::resource('/users',UserController::class);

Route::get('/dashboard',function(){
    return view('dashboard');
});

Route::get('/company-create', [CompanyController::class, 'create']);

Route::post('/company-create', [CompanyController::class, 'store']);

Route::get('/logout',function(){
    session()->forget('user_id');
    return view('/signin');
});

Route::get('/category',[CategoryController::class,'index']);
Route::post('/category',[CategoryController::class,'store']);
Route::get('/category/{id}/edit', [CategoryController::class, 'edit']);
Route::get('/category/{id}/delete', [CategoryController::class, 'delete']);
Route::post('/category/{id}/update', [CategoryController::class, 'update']);

Route::get('/product-create',[ProductController::class,'create']);
Route::post('/product-create',[ProductController::class,'store']);

Route::get('/product',[ProductController::class,'index']);

Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
Route::get('/product/{id}/delete', [ProductController::class, 'delete']);
Route::post('/product/{id}/update', [ProductController::class, 'update']);


Route::get('/inbound',[InboundController::class,'index']);

Route::post('/stocks-store', [StockController::class, 'store']);
Route::get('/stocks', [StockController::class, 'index']);