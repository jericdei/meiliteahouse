<?php

use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\FranchiseController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\InvestController;
use App\Http\Controllers\Site\ProductsController;
use App\Http\Controllers\Site\StoresController;
use App\Http\Controllers\System\Franchise\SubmissionController as FranchiseSubmissionController;
use App\Http\Controllers\System\Investments\DashboardController;
use App\Http\Controllers\System\Investments\InvestmentController;
use App\Http\Controllers\System\Investments\InvestorController;
use App\Http\Controllers\System\Investments\ProfileController;
use App\Http\Controllers\System\Investments\SettingsController;
use App\Http\Controllers\System\Investments\SubmissionController;
use App\Http\Controllers\System\Investments\UserController;
use App\Http\Controllers\System\Investments\WithdrawalController;
use Illuminate\Support\Facades\Route;

// WEBSITE ROUTES
Route::name('site.')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('about', AboutController::class)->name('about');
    Route::get('products', ProductsController::class)->name('products');
    Route::get('stores', StoresController::class)->name('stores');

    // Franchising
    Route::get('franchise', [FranchiseController::class, 'index'])->name('franchise');
    Route::post('franchise/submit', [FranchiseController::class, 'store'])->name('franchise.store');

    // Investment
    Route::get('investments/form', [InvestController::class, 'form'])->name('investments.form');
    Route::post('investments/{submission}', [InvestController::class, 'update'])->name('investments.update');
    Route::resource('investments', InvestController::class)->except(['create', 'edit', 'update', 'show', 'destroy']);
});

// SYSTEM ROUTES
Route::middleware(['auth', 'role:admin|investor'])
    ->name('system.')
    ->prefix('system')
    ->group(function () {
        // Franchising
        Route::name('franchise.')
            ->prefix('franchise')
            ->group(function () {
                Route::resource('submissions', FranchiseSubmissionController::class);
            });

        // Investments
        Route::name('invest.')
            ->prefix('invest')
            ->group(function () {
                // Admin only
                Route::middleware('role:admin')
                    ->group(function () {
                        Route::resource('submissions', SubmissionController::class);
                        Route::resource('users', UserController::class)->except([
                            'create, edit',
                        ]);
                        Route::resource('investors', InvestorController::class)->except([
                            'create, edit',
                        ]);
                    });

                Route::get('dashboard', DashboardController::class)->name('dashboard');
                Route::get('profile', ProfileController::class)->name('profile');
                Route::get('settings', SettingsController::class)->name('settings');

                Route::resource('investments', InvestmentController::class)->except([
                    'create, edit',
                ]);
                Route::resource('withdrawals', WithdrawalController::class)->except([
                    'create, edit',
                ]);
            });
    });

require __DIR__.'/auth.php';
