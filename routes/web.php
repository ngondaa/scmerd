<?php

use App\Http\Controllers\AuthorPortalController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [AuthorPortalController::class, 'dashboard'])->name('dashboard');
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
});

require __DIR__.'/settings.php';
