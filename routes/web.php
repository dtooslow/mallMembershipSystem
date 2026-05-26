<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

use App\Models\Shop;
use App\Models\Reward;

Route::get('/', function () {
    $shops = Shop::latest()->take(6)->get();
    $rewards = Reward::latest()->take(6)->get();
    $events = \App\Models\Event::where('event_date', '>=', now()->toDateString())
                    ->orderBy('event_date', 'asc')
                    ->take(6)
                    ->get();
    return view('welcome', compact('shops', 'rewards', 'events'));
});

Route::get('/public-shops/{shop}', [ShopController::class, 'showPublic'])->name('shops.public.show');


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
    Route::patch('memberships/{membership}/approve', [MembershipController::class, 'approve'])->name('memberships.approve');
    Route::patch('memberships/{membership}/reject', [MembershipController::class, 'reject'])->name('memberships.reject');
    Route::resource('rewards', RewardController::class);
    Route::resource('shops', ShopController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    Route::patch('products/{product}/toggle', [ProductController::class, 'toggle'])->name('products.toggle');
    Route::patch('products/{product}/toggle-discount', [ProductController::class, 'toggleDiscount'])->name('products.toggle_discount');
    Route::resource('events', EventController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/user/dashboard', function () {
        $user = auth()->user();
        $transactions = \App\Models\Transaction::where('user_id', $user->id)
                            ->with(['product', 'shop'])
                            ->latest()
                            ->get();
        $redemptions = \App\Models\RewardRedemption::where('user_id', $user->id)
                            ->with('reward')
                            ->latest()
                            ->get();
        $notifications = \App\Models\Notification::where('user_id', $user->id)
                            ->latest()
                            ->get();

        $events = \App\Models\Event::where('event_date', '>=', now()->toDateString())
                            ->orderBy('event_date', 'asc')
                            ->get();

        return view('user.dashboard', compact('transactions', 'redemptions', 'notifications', 'events'));
    })->name('user.dashboard');

    Route::post('/notifications/{notification}/read', function (\App\Models\Notification $notification) {
        if ($notification->user_id === auth()->id()) {
            $notification->update(['is_read' => true]);
        }
        return back()->with('success', 'Notification marked as read.');
    })->name('notifications.read');

    Route::delete('/notifications/{notification}', function (\App\Models\Notification $notification) {
        if ($notification->user_id === auth()->id()) {
            $notification->delete();
        }
        return back()->with('success', 'Notification deleted.');
    })->name('notifications.destroy');

    Route::get('/membership/apply', [\App\Http\Controllers\UserMembershipController::class, 'create'])->name('membership.apply');
    Route::post('/membership/apply', [\App\Http\Controllers\UserMembershipController::class, 'store'])->name('membership.apply.store');

    // Reward Claim
    Route::post('/rewards/{reward}/claim', [RewardController::class, 'claim'])->name('rewards.claim');

    // Product Purchase
    Route::get('/products/{product}/confirm',  [PurchaseController::class, 'confirm'])->name('purchase.confirm');
    Route::post('/products/{product}/buy',     [PurchaseController::class, 'buy'])->name('purchase.buy');
    Route::get('/products/{product}/receipt',  [PurchaseController::class, 'receipt'])->name('purchase.receipt');
});

require __DIR__.'/auth.php';
