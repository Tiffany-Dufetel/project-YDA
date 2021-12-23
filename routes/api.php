<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'getRole']);
Route::get('/info/{id}', [AuthController::class, 'getUserInfo']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/calendar', CalendarController::class);
    Route::resource('/company', CompanyController::class);
    Route::resource('/news', NewsController::class);
    Route::resource('/home', HomeController::class);
    Route::resource('/order', OrderController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/user', UserController::class);
});

route::get('/news/by-company/{companyId}', [NewsController::class, 'findByCompanyId']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/user/edit-firstPassword/{id}', [UserController::class, "resetPassword"]);
