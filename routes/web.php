<?php

use App\Http\Controllers\MejaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('meja.index'));

Route::resource('meja', MejaController::class)->except('show');