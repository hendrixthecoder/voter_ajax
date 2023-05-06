<?php

use App\Http\Controllers\AccessController;
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

Route::get('/', [AccessController::class, 'front'])->name('front');

Route::post('vote', [AccessController::class, 'vote'])->name('postVote');

Route::get('get-candidates', [AccessController::class, 'getCandidates'])->name('getCandidates');

Route::get('test', function () {
    return view('test');
});