<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::redirect('/', '/pages');
Route::resource('pages', PageController::class);