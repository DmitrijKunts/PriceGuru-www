<?php

use App\Http\Controllers\ReleaseCommentController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VideoController;
use App\Http\Livewire\Contact;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $release = \App\Models\Release::orderBy('created_at', 'desc')->first();
    return view('welcome', compact('release'));
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/get-fee-license', [LicenseController::class, 'gen'])->name('lic_make_free');
    Route::get('/users', UsersController::class)->name('users');
});

Route::resource('releases', ReleaseController::class)
    ->scoped(['release' => 'version']);

Route::get('/videos', VideoController::class)->name('videos');
Route::get('/contact', Contact::class)->name('contact');

Route::middleware(['auth:sanctum', 'verified'])
    ->resource('releases.comments', ReleaseCommentController::class)
    ->only(['create', 'store', 'destroy',])
    ->shallow();
