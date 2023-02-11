<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TextController;
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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'updateStarred'])->name('profile.edit.starred');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroyText'])->name('profile.delete.text');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/home', [TextController::class, 'index'])->name('home');
Route::post('/home', [TextController::class, 'summarizeText'])->name('home.summarizeText');

// Route::get('/profile', [ProfileController::class, 'sortCreatedTime'])->name('sort.create.time');

Route::fallback(function () {
    return redirect()->route('welcome');
});