<?php

use App\Http\Controllers\AuthorPortalController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewerController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [AuthorPortalController::class, 'dashboard'])->name('dashboard');
    Route::post('package/update', [AuthorPortalController::class, 'updatePackage'])->name('update-package');
    Route::post('checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
    Route::get('submit', [AuthorPortalController::class, 'showSubmit'])->name('submit');
    Route::post('submit', [AuthorPortalController::class, 'storeSubmit'])->name('submit.store');
    Route::get('abstracts', [AuthorPortalController::class, 'abstracts'])->name('abstracts');
    Route::get('tracks', [AuthorPortalController::class, 'tracks'])->name('tracks');
    Route::get('instructions', [AuthorPortalController::class, 'instructions'])->name('instructions');
    Route::get('rebuttals', [AuthorPortalController::class, 'rebuttals'])->name('rebuttals');
    Route::post('rebuttals/{id}', [AuthorPortalController::class, 'storeRebuttal'])->name('rebuttals.store');
    Route::get('notifications', [AuthorPortalController::class, 'notifications'])->name('notifications');
    Route::get('downloads', [AuthorPortalController::class, 'downloads'])->name('downloads');
    Route::get('downloads/{id}', [AuthorPortalController::class, 'downloadAttachment'])->name('downloads.attachment');
    Route::get('exports/submissions', [AuthorPortalController::class, 'exportCsv'])->name('exports.submissions');
    Route::get('reviewer/dashboard', [ReviewerController::class, 'dashboard'])->name('reviewer.dashboard');
    Route::post('reviewer/submissions/{submission}/comment', [ReviewerController::class, 'storeComment'])->name('reviewer.comment');
});

Route::post('stripe/webhook', [CheckoutController::class, 'webhook'])->name('stripe.webhook');

require __DIR__.'/settings.php';
