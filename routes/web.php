<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\UserController;
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
        Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
    });

    // Trang user
    Route::middleware('role:user')->group(function () {
        Route::get('/user/home', [UserController::class, 'index'])->name('user.home');
        Route::get('/home', [HomeController::class, 'index'])->name('home.index');
        Route::get('/about', [HomeController::class, 'about'])->name('about.index');
        Route::get('/contact', [HomeController::class, 'contact'])->name('contact.index');
        Route::get('/destination', [HomeController::class, 'destination'])->name('destination.index');
        Route::get('/tour', [HomeController::class, 'tour'])->name('tour.index');
        Route::get('/tour_guide', [HomeController::class, 'tour_guide'])->name('tour_guide.index');
    });
});

require __DIR__.'/auth.php';
