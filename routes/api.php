<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {

    dd($request->get('auth'));

})->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);
