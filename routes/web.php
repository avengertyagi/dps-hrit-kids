<?php

use Illuminate\Support\Facades\{Route, Artisan, Session};

Route::get('/clearapp', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('app:tmp-files');
    Session::flush();
    return redirect('/');
});
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';