<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

use App\Models\Shop;
use App\Models\Reward;

Route::get('/', function () {
    $shops = Shop::latest()->take(6)->get();
    $rewards = Reward::latest()->take(6)->get();
    return view('welcome', compact('shops', 'rewards'));
});

use App\Http\Controllers\AdminAuthController;

Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'store']);
Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('admins', AdminController::class);
    Route::resource('memberships', MembershipController::class);
    Route::resource('rewards', RewardController::class);
    Route::resource('shops', ShopController::class);
    Route::resource('transactions', TransactionController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
