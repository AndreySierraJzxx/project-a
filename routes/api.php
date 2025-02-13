<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('events/participants-count', [ApiController::class, 'participantsCount']);
