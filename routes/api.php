<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
Route::apiResource('addresses', AddressController::class);
Route::post('/events/{event}/presence', [EventController::class, 'confirmPresence']);


