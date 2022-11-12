<?php

use App\Http\Controllers\WordedTimeController;
use Illuminate\Support\Facades\Route;

Route::get('/project/worded-time', [WordedTimeController::class, 'view']);
