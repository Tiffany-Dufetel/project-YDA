<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/calendar', CalendarController::class);

Route::resource('/company', CompanyController::class);

Route::resource('/company/news', NewsController::class);

Route::resource('/home', HomeController::class);

Route::resource('/order', OrderController::class);

Route::resource('/product', ProductController::class);

Route::resource('/user', UserController::class);
