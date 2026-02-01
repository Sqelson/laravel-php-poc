<?php

namespace App\Http\Controllers;

// Imports the Service
use App\Services\CarrierService;
// Imports the "Mask" and "Bouncer"
use App\Http\Resources\CarrierResource;
use App\Http\Requests\GetShipmentRateRequest;
use App\Jobs\GenerateShippingLabel;

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
        // Validation is handled automatically before this code even runs
        // If it fails, Laravel returns a 422 error immediately
        $weight = $request->validated()['weight'];

        // Use the service instead of calling the Model directly
        // Also, if this fails, the Exception handles the response automatically
        $carrier = $this->carrierService->findCheapestCarrier($weight);

        // Dispatch the Job to generate the shipping label asynchronously
        // This puts the job in the database and keeps the user waiting time minimal
        GenerateShippingLabel::dispatch($carrier);

        // Return the resource instead of the raw model
        return new CarrierResource($carrier);
    }
}
