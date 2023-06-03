<?php

use App\Http\Controllers\Investments\DashboardController;
use App\Http\Controllers\Investments\InvestmentController;
use App\Http\Controllers\Investments\InvestorController;
use App\Http\Controllers\Investments\ProfileController;
use App\Http\Controllers\Investments\SettingsController;
use App\Http\Controllers\Investments\SubmissionController;
use App\Http\Controllers\Investments\UserController;
use App\Http\Controllers\Investments\WithdrawalController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\FranchiseController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\InvestController;
use App\Http\Controllers\Site\ProductsController;
use App\Http\Controllers\Site\StoresController;
use Illuminate\Support\Facades\Route;

# WEBSITE ROUTES
Route::name('site.')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('about', AboutController::class)->name('about');
    Route::get('products', ProductsController::class)->name('products');
    Route::get('stores', StoresController::class)->name('stores');
    Route::get('franchise', FranchiseController::class)->name('franchise');
    Route::get('investments/form', [InvestController::class, 'form'])->name('investments.form');
    Route::resource('investments', InvestController::class)->except(['create', 'show', 'destroy']);
});

# INVESTMENT SYSTEM ROUTES
Route::middleware(['auth'])
    ->name('invest.')
    ->prefix('invest')
    ->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::get('profile', ProfileController::class)->name('profile');
        Route::get('settings', SettingsController::class)->name('settings');

        Route::resource('investments', InvestmentController::class)->except([
            'create, edit',
        ]);
        Route::resource('withdrawals', WithdrawalController::class)->except([
            'create, edit',
        ]);

        # ADMIN ONLY
        Route::middleware('role:admin')->group(function () {
            Route::resource('submissions', SubmissionController::class);
            Route::resource('users', UserController::class)->except([
                'create, edit',
            ]);
            Route::resource('investors', InvestorController::class)->except([
                'create, edit',
            ]);
        });
    });

require __DIR__ . '/auth.php';
