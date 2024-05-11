<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SocialmediaController;
use App\Http\Controllers\VoucherController;
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
Route::middleware('apikey')->group(function () {
    Route::get('/find',[BannerController::class,'find']);
    Route::resource('banners', BannerController::class);
    Route::resource('members', MemberController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('socialmedia', SocialmediaController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('address', AddressController::class);
    Route::resource('brands', brandController::class);
    Route::resource('faqs', FaqsController::class);
    Route::resource('logo', LogoController::class);
    Route::resource('order-tracking', SocialmediaController::class);
});
