<?php

use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\DestinationController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MyTourController;
use App\Http\Controllers\User\PaypalController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\TourBookedController;
use App\Http\Controllers\User\TourController;
use App\Http\Controllers\User\TourDetailController;
use App\Http\Controllers\User\TourGuideController;
use App\Http\Controllers\User\UserProfileController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/redirect', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.home');
        }
        return redirect()->route('home.index');
    })->name('redirect');

    // Trang admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin.home');
        Route::get('/admin', [AdminAdminController::class, 'index'])->name('admin.admin');
        Route::post('/update-admin', [AdminAdminController::class, 'updateAdmin'])->name('admin.update-admin');
        Route::post('/update-avatar', [AdminAdminController::class, 'updateAvatar'])->name('admin.update-avatar');
    });

    // Trang user
    Route::middleware('role:user')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home.index');
        Route::get('/about', [AboutController::class, 'index'])->name('about.index');
        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/destination', [DestinationController::class, 'index'])->name('destination.index');
        Route::get('/tour', [TourController::class, 'index'])->name('tour.index');
        Route::get('/tour_guide', [TourGuideController::class, 'index'])->name('tour_guide.index');
        //Route::get('/tour_detail/{id}', [TourController::class, 'tour_detail'])->name('tour_detail');


        Route::get('/filter-tours', [TourController::class, 'filterTours'])->name('filter-tours');
        Route::get('/user-profile', [UserProfileController::class, 'index'])->name('user-profile');
        Route::post('/user-profile', [UserProfileController::class, 'update'])->name('update-user-profile');
        Route::post('/change_password_profile', [UserProfileController::class, 'changePassword'])->name('change-password');
        Route::post('/change_avatar_profile', [UserProfileController::class, 'changeAvatar'])->name('change-avatar');

        Route::post('/booking/{id?}', [BookingController::class, 'index'])->name('booking');
        Route::post('/submit-booking', [BookingController::class, 'createBooking'])->name('create-booking');

        //Payment with paypal
        Route::get('create-transaction', [PaypalController::class, 'createTransaction'])->name('createTransaction');
        Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
        Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
        Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

        //Payment with Momo
        Route::post('/create-momo-payment', [BookingController::class, 'createMomoPayment'])->name('createMomoPayment');

        Route::get('/tour-booked', [TourBookedController::class, 'index'])->name('tour-booked');
        Route::post('/cancel-booking', [TourBookedController::class, 'cancelBooking'])->name('cancel-booking');

        Route::get('/my-tours', [MyTourController::class, 'index'])->name('my-tours');

        Route::get('/tour_detail/{id?}', [TourDetailController::class, 'index'])->name('tour_detail');
        Route::post('/checkBooking', [BookingController::class, 'checkBooking'])->name('checkBooking');
        Route::post('/reviews', [TourDetailController::class, 'reviews'])->name('reviews');

        Route::get('/search', [SearchController::class, 'index'])->name('search');
    });

    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('login-google')->withoutMiddleware('auth');
    Route::get('auth/callback/google', [GoogleController::class, 'handleGoogleCallback'])->withoutMiddleware('auth');
});

require __DIR__ . '/auth.php';
