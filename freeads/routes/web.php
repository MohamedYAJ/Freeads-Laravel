<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnonceController;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', [IndexController::class, 'showIndex'])->name('index');

// Routes pour la page regiter 
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// Routes pour la page login
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);

// Routes pour la page home
Route::get('/home', [AnnonceController::class, 'home']);
Route::post('/home', [AnnonceController::class, 'annonce'])->name('annonce');

// Routes pour la page profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
});

// Route pour la page annonces/ads
Route::get('/ads', [AnnonceController::class, 'DisplayAds'])->name('DisplayAds');
Route::delete('/ads/{id}', [AnnonceController::class, 'destroy'])->name('ads.destroy');



Route::get('/edit/{id}', [AnnonceController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [AnnonceController::class, 'update'])->name('update');



Route::post('/logout', [UserController::class, 'logout'])->name('logout');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');        