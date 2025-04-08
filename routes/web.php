<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
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

Route::get('/login', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/redirect', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.home');
        }
        return redirect()->route('user.home');
    })->name('redirect');

    // Trang admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
    });

    // Trang user
    Route::middleware('role:user')->group(function () {
        Route::get('/user/home', [UserController::class, 'index'])->name('user.home');
    });
});

require __DIR__.'/auth.php';
