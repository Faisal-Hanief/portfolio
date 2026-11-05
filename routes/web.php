
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

// Latihan 4a: setup check page
Route::view('/welcome', 'welcome');
