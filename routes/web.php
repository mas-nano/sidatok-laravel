<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Spatie\Permission\Models\Role;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('auth.login');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register');
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');
    Route::controller(GoogleController::class)->group(function () {
        Route::get('auth/google', 'redirectGoogle')->name('auth.google');
        Route::get('auth/google/callback', 'handleCallback');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::prefix('/email/verify')->group(function () {
        Route::get('', function () {
            return view('auth.verify-email');
        })->name('verification.notice');
        Route::get('/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            return redirect()->route('dashboard.index');
        })->middleware(['signed'])->name('verification.verify');
        Route::post('/verification-notification', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();

            return back()->with('success', 'Kode verifikasi sudah terkirim. Silakan cek email Anda!');
        })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
    });
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('auth.login');
    })->name('auth.logout');
    Route::middleware(['verified'])->group(function () {
        Route::get('getting-started', function () {
            return view('dashboard.getting-started');
        })->name('getting-started')->middleware(['ensure.not.shop']);
        Route::middleware(['ensure.shop', 'teams'])->name('dashboard.')->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard.dashboard');
            })->name('index');
            Route::get('/item', function () {
                return view('dashboard.item');
            })->name('item');
        });
    });
});
