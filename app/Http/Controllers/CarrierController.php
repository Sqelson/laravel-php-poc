<?php

namespace App\Http\Controllers;

// Imports the Service
use App\Services\CarrierService;
// Imports the "Mask" and "Bouncer"
use App\Http\Resources\CarrierResource;
use App\Http\Requests\GetShipmentRateRequest;

class CarrierController extends Controller
{
    protected $carrierService;

    // The Constructor "injects" the service into this class
    public function __construct(CarrierService $carrierService)
    {
        $this->carrierService = $carrierService;
    }

    public function getShipmentRate(GetShipmentRateRequest $request)
    {
        // Validation is handled automatically before this code even runs.
        // If it fails, Laravel returns a 422 error immediately.
        $weight = $request->validated()['weight'];

        // Use the service instead of calling the Model directly
        $carrier = $this->carrierService->findCheapestCarrier($weight);

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
