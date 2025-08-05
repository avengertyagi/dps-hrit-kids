<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\{
    HomeController
};

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', [HomeController::class, 'about'])->name('about-us');

Route::get('/photos', [HomeController::class, 'photos'])->name('photos');

Route::get('/photos/details/{slug}', [HomeController::class, 'photoDetails'])->name('photos.details');

Route::get('/videos', [HomeController::class, 'videos'])->name('videos');

Route::get('/media', [HomeController::class, 'media'])->name('media');

Route::post('/admission/store', [HomeController::class, 'admissionSubmit'])->name('admission.store');
