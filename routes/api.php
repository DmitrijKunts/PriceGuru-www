<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('lastrelease', function (){
    $r = \App\Models\Release::select(['version', 'file_inst as url'])->orderBy('version', 'desc')->first();
    $r->url = config('app.url') . Storage::url($r->url);
    return $r;
});

if (App::environment('production')) {
    URL::forceScheme('https');
}
