<?php

use App\Http\Controllers\InboundController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
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


Route::get('/outbound', [OutboundController::class, 'create']);
Route::post('/outbound', [OutboundController::class, 'store']);;
Route::get('/outbound/{id}/invoice', [OutboundController::class, 'invoice'])->name('outbound.invoice');
Route::get('/outbound/{id}/invoice/pdf', [OutboundController::class, 'pdf'])->name('outbound.invoice.pdf');

Route::get('/generate-invoice',[OutboundController::class,'create']);

Route::get('/return', [ReturnController::class, 'create'])->name('return.create');
Route::post('/return/fetch', [ReturnController::class, 'fetchInvoice'])->name('return.fetch');
Route::post('/return/store', [ReturnController::class, 'store'])->name('return.store');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

// OPEX
Route::get('/opex/create', [TransactionController::class, 'createOpex'])->name('opex.create');
Route::post('/opex/store', [TransactionController::class, 'storeOpex'])->name('opex.store');


Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/settings', [CompanyController::class, 'edit']);
Route::post('/settings', [CompanyController::class, 'update']);

Route::get('/profile', [UserController::class, 'profileEdit']);
Route::post('/profile', [UserController::class, 'profileUpdate']);