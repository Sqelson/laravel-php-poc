<?php

namespace App\Http\Controllers;

// Imports the Service
use App\Services\CarrierService;
// Imports the "Mask" and "Bouncer"
use App\Http\Resources\CarrierResource;
use App\Http\Requests\GetShipmentRateRequest;
use App\Jobs\GenerateShippingLabel;

/**
 * @group Carrier Shipping
 *
 * APIs for managing and calculating shipping rates.
 */
class CarrierController extends Controller
{
    protected $carrierService;

    // The Constructor "injects" the service into this class
    public function __construct(CarrierService $carrierService)
    {
        $this->carrierService = $carrierService;
    }

    /**
     * Get Shipment Rate
     *
     * Calculate the cheapest carrier for a given shipment weight.
     *
     * @bodyParam weight float required The weight of the shipment. Example: 2.5
     */
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
