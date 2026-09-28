<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Customer\ProfileController as CustomerProfile;
use App\Http\Controllers\Customer\FavoriteController as CustomerFavorite;
use App\Http\Controllers\Customer\CustomerReviewController;
use App\Http\Controllers\Customer\CustomerNotificationController;
use App\Http\Controllers\Farmer\DashboardController as FarmerDashboard;
use App\Http\Controllers\Farmer\ProductController as FarmerProductController;
use App\Http\Controllers\Farmer\OrderController as FarmerOrderController;
use App\Http\Controllers\Farmer\PickupSlotController;
use App\Http\Controllers\Farmer\StockTemplateController;
use App\Http\Controllers\Farmer\ReviewController as FarmerReviewController;
use App\Http\Controllers\Farmer\ProfileController as FarmerProfile;
use App\Http\Controllers\Farmer\FarmerInsightController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\FarmerController as AdminFarmer;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\MarketController as AdminMarket;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\ReviewController as AdminReview;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncement;
use App\Http\Controllers\Admin\ReportController as AdminReport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', fn() => view('pages.about'))->name('about');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');
Route::get('/how-it-works', fn() => view('pages.about'))->name('how-it-works');
Route::get('/map', [MapController::class, 'index'])->name('map');
Route::post('/assistant/query', [AssistantController::class, 'query'])->name('assistant.query');

Route::get('/markets', [MarketController::class, 'index'])->name('markets.index');
Route::get('/markets/{market}', [MarketController::class, 'show'])->name('markets.show');

Route::get('/farmers', [FarmerController::class, 'index'])->name('farmers.index');
Route::get('/farmers/{farmer}', [FarmerController::class, 'show'])->name('farmers.show');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register/customer', [RegisterController::class, 'showCustomerForm'])->name('register.customer');
    Route::post('/register/customer', [RegisterController::class, 'registerCustomer'])->name('register.customer.submit');
    Route::get('/register/farmer', [RegisterController::class, 'showFarmerForm'])->name('register.farmer');
    Route::post('/register/farmer', [RegisterController::class, 'registerFarmer'])->name('register.farmer.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('dashboard');
    Route::get('/profile', [CustomerProfile::class, 'show'])->name('profile');
    Route::put('/profile', [CustomerProfile::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [CustomerProfile::class, 'updatePassword'])->name('profile.password');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/orders', [OrderController::class, 'customerIndex'])->name('orders');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'customerShow'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{order}/reorder', [OrderController::class, 'reorder'])->name('orders.reorder');

    Route::get('/favorites', [CustomerFavorite::class, 'index'])->name('favorites');
    Route::post('/favorites/farmers/{farmer}', [CustomerFavorite::class, 'toggleFarmer'])->name('favorites.farmer');
    Route::post('/favorites/products/{product}', [CustomerFavorite::class, 'toggleProduct'])->name('favorites.product');

    Route::get('/reviews', [CustomerReviewController::class, 'index'])->name('reviews');
    Route::get('/orders/{order}/review', [CustomerReviewController::class, 'create'])->name('reviews.create');
    Route::post('/orders/{order}/review', [CustomerReviewController::class, 'store'])->name('reviews.store');

    Route::get('/notifications', [CustomerNotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{id}/read', [CustomerNotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [CustomerNotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
});

Route::middleware(['auth', 'role:farmer'])->prefix('farmer')->name('farmer.')->group(function () {
    Route::get('/dashboard', [FarmerDashboard::class, 'index'])->name('dashboard');
    Route::get('/profile', [FarmerProfile::class, 'show'])->name('profile');
    Route::put('/profile', [FarmerProfile::class, 'update'])->name('profile.update');
    Route::get('/insights', [FarmerInsightController::class, 'index'])->name('insights');

    Route::middleware('farmer.approved')->group(function () {
        Route::resource('products', FarmerProductController::class);
        Route::post('/products/{product}/toggle-status', [FarmerProductController::class, 'toggleStatus'])->name('products.toggle');
    });

    Route::get('/orders', [FarmerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [FarmerOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/accept', [FarmerOrderController::class, 'accept'])->name('orders.accept');
    Route::post('/orders/{order}/decline', [FarmerOrderController::class, 'decline'])->name('orders.decline');
    Route::post('/orders/{order}/ready', [FarmerOrderController::class, 'ready'])->name('orders.ready');
    Route::post('/orders/{order}/complete', [FarmerOrderController::class, 'complete'])->name('orders.complete');

    Route::resource('pickup-slots', PickupSlotController::class);

    Route::resource('stock-templates', StockTemplateController::class);

    Route::get('/reviews', [FarmerReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{review}/reply', [FarmerReviewController::class, 'reply'])->name('reviews.reply');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::get('/farmers', [AdminFarmer::class, 'index'])->name('farmers.index');
    Route::get('/farmers/pending', [AdminFarmer::class, 'pending'])->name('farmers.pending');
    Route::get('/farmers/{farmer}', [AdminFarmer::class, 'show'])->name('farmers.show');
    Route::post('/farmers/{farmer}/approve', [AdminFarmer::class, 'approve'])->name('farmers.approve');
    Route::post('/farmers/{farmer}/suspend', [AdminFarmer::class, 'suspend'])->name('farmers.suspend');
    Route::post('/farmers/{farmer}/activate', [AdminFarmer::class, 'activate'])->name('farmers.activate');

    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{customer}', [AdminCustomerController::class, 'show'])->name('customers.show');
    Route::post('/customers/{customer}/toggle', [AdminCustomerController::class, 'toggleStatus'])->name('customers.toggle');

    Route::resource('users', AdminUser::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::post('/users/{user}/toggle-status', [AdminUser::class, 'toggleStatus'])->name('users.toggle');

    Route::resource('markets', AdminMarket::class);
    Route::post('/markets/{market}/toggle', [AdminMarket::class, 'toggle'])->name('markets.toggle');

    Route::resource('categories', AdminCategory::class);

    Route::get('/products', [AdminProduct::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [AdminProduct::class, 'show'])->name('products.show');
    Route::post('/products/{product}/toggle', [AdminProduct::class, 'toggle'])->name('products.toggle');

    Route::get('/orders', [AdminOrder::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrder::class, 'show'])->name('orders.show');

    Route::get('/reviews', [AdminReview::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{review}/approve', [AdminReview::class, 'approve'])->name('reviews.approve');
    Route::post('/reviews/{review}/reject', [AdminReview::class, 'reject'])->name('reviews.reject');
    Route::delete('/reviews/{review}', [AdminReview::class, 'destroy'])->name('reviews.destroy');

    Route::resource('announcements', AdminAnnouncement::class);

    Route::get('/reports', [AdminReport::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [AdminReport::class, 'export'])->name('reports.export');
});
