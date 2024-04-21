<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::middleware(\App\Http\Middleware\EnsureTokenIsValid::class)->group(function () {

    Route::apiResources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
    ]);

});
