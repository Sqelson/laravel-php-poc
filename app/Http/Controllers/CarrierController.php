<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;
// Import the new "Mask" and "Bouncer"
use App\Http\Resources\CarrierResource;
use App\Http\Requests\GetShipmentRateRequest;

class CarrierController extends Controller
{
    public function getShipmentRate(GetShipmentRateRequest $request)
    {
        // Validation is handled automatically before this code even runs.
        // If it fails, Laravel returns a 422 error immediately.
        $weight = $request->validated()['weight'];

        $carrier = Carrier::where('max_weight', '>=', $weight)
                    ->orderBy('price', 'asc')
                    ->first();

        if (!$carrier) {
            return response()->json([
                'success' => false,
                'message' => "No carrier found for {$weight}kg."
            ], 404);
        }

        // Return the resource instead of the raw model
        return new CarrierResource($carrier);
    }
}
