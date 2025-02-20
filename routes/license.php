<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SystemController;

Route::get('/themeforest.net', function() {
    return view('vendor.license.index');
})->name('license');