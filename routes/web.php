<?php

use App\Http\Controllers\ReleaseCommentController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\LicenseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $release = \App\Models\Release::orderBy('created_at', 'desc')->first();
    return view('welcome', compact('release'));
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/get-fee-license', [LicenseController::class, 'make_free'])->name('lic_make_free');


Route::resource('releases', ReleaseController::class)->only([
    'index', 'create', 'store', 'show', 'destroy', 'edit'
]);

Route::middleware(['auth:sanctum', 'verified'])->get('releases/{release}/comments/create', [ReleaseCommentController::class, 'create'])->name('releases.comments.create');
Route::resource('releases.comments', ReleaseCommentController::class)->only([
    'store', 'edit', 'update', 'destroy',
])->shallow();
