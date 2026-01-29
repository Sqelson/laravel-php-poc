<?php

use App\Http\Controllers\CarrierController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/quote', [CarrierController::class, 'getShipmentRate']);
