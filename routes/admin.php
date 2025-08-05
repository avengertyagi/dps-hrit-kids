<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AuthController,
    DashboardController,
    AdmissionController,
    PhotoController,
    VideoController,
    BannerController,
    PageController,
    SettingController,
    PageSectionController,
    MediaController
};
use App\Http\Controllers\MasterController;
//authenticate admin
Route::get('/admin', [AuthController::class, 'login'])->name('admin');
Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('submit-logout');

//Master routes

Route::get('/states/list', [MasterController::class, 'fetchState'])->name('states.list'); //fetch state

Route::get('/cities/list', [MasterController::class, 'fetchCity'])->name('cities.list'); //fetch city

Route::get('/pages/list', [MasterController::class, 'fetchPages'])->name('pages.list'); //fetch page

Route::get('/page-sections/list', [MasterController::class, 'fetchPageSections'])->name('page-sections.list'); //fetch page

// Group for admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'admin-auth'], function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //change password
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('show.change-password');
    Route::post('/submit-chanage-password', [AuthController::class, 'submitChangePassword'])->name('submit-change-password');

    //Profile update
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('show.profile');
    Route::post('/update/profile', [AuthController::class, 'profileUpdate'])->name('profile.update');

    //Admission routes
    Route::get('/admission/ajax/table', [AdmissionController::class, 'ajaxTable'])->name('admission.ajax.table');
    Route::resource('/admission', AdmissionController::class);

    //Photo routes
    Route::post('/photos/unique', [PhotoController::class, 'checkUnique'])->name('photos.checkUnique');
    Route::post('/photos/status-change', [PhotoController::class, 'status'])->name('photos.status.change');
    Route::get('/photos/ajax/table', [PhotoController::class, 'ajaxTable'])->name('photos.ajax.table');
    Route::post('/photos/upload/tmp', [PhotoController::class, 'uploadTmp'])->name('photos.upload.tmp');
    Route::resource('/photos', PhotoController::class);

    //Video routes
    Route::post('/videos/status-change', [VideoController::class, 'status'])->name('videos.status.change');
    Route::get('/videos/ajax/table', [VideoController::class, 'ajaxTable'])->name('videos.ajax.table');
    Route::resource('/videos', VideoController::class);

    //Banner routes
    Route::post('/banners/status-change', [BannerController::class, 'status'])->name('banners.status.change');
    Route::get('/banners/ajax/table', [BannerController::class, 'ajaxTable'])->name('banners.ajax.table');
    Route::resource('/banners', BannerController::class);
   
    //Page routes
    Route::get('/pages/ajax/table', [PageController::class, 'ajaxTable'])->name('pages.ajax.table');
    Route::post('/pages/check-unique', [PageController::class, 'checkUnique'])->name('pages.check-unique');
    Route::resource('/pages', PageController::class);

    //Page section routes
    Route::get('/page-sections/ajax/table', [PageSectionController::class, 'ajaxTable'])->name('page-sections.ajax.table');
    Route::post('/page-sections/check-unique', [PageSectionController::class, 'checkUnique'])->name('page-sections.check-unique');
    Route::resource('/page-sections', PageSectionController::class);

    //Media routes
    Route::get('/media/ajax/table', [MediaController::class, 'ajaxTable'])->name('media.ajax.table');
    Route::post('/media/status-change', [MediaController::class, 'status'])->name('media.status-change');
    Route::resource('/media', MediaController::class);
    //Settings routes
    Route::resource('/settings', SettingController::class);
});
