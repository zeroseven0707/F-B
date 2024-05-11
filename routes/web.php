<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\Internal\BannerController as InternalBannerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Livewire\AddressManagement;
use App\Livewire\ArticleManagement;
use App\Livewire\BannerManagement;
use App\Livewire\ClientManagement;
use App\Livewire\DashboardManagement;
use App\Livewire\FaqManagement;
use App\Livewire\HomeWrite;
use App\Livewire\LogoManagement;
use App\Livewire\ManageBrands;
use App\Livewire\MemberManagement;
use App\Livewire\SetWebsite;
use App\Livewire\SocialMediaManagement;
use App\Livewire\Theme;
use App\Livewire\ThemeDetail;
use App\Livewire\ThemeViewUsers;
use App\Livewire\VoucherManager;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
});
Route::middleware('superadmin')->group(function () {
    Route::get('/client', ClientManagement::class)->name('client.index');
    Route::get('/theme', Theme::class)->name('set.index');
    Route::get('/theme/{code}', ThemeDetail::class);
    Route::get('/home-write/{code}', HomeWrite::class);
    Route::get('/detail-product-write/{code}', HomeWrite::class);
    Route::get('/faqs-write/{code}', HomeWrite::class);
    Route::get('/cart-write/{code}', HomeWrite::class);
    Route::get('/wishlist-write/{code}', HomeWrite::class);
    Route::get('/catalog-write/{code}', HomeWrite::class);
    Route::get('/about-write/{code}', HomeWrite::class);
});
Route::middleware('admin')->group(function () {
    // NEW
    Route::get('/theme-website', ThemeViewUsers::class);


    Route::get('/dashboard', DashboardManagement::class);
    Route::get('/brands', ManageBrands::class);
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::get('/banners', BannerManagement::class);
    Route::get('/articles', ArticleManagement::class);
    Route::get('/social-media', SocialMediaManagement::class);
    Route::get('/address', AddressManagement::class);
    Route::get('/faqs', FaqManagement::class);
    Route::get('/logo', LogoManagement::class);
    Route::get('/members', MemberManagement::class);
    Route::get('/vouchers', VoucherManager::class);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
});

require __DIR__.'/auth.php';
