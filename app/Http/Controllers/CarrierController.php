<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;

class CarrierController extends Controller
{
    public function getShipmentRate(Request $request)
    {
        // Guard rail: Don't process anything unless we have a valid numeric weight
        $validated = $request->validate([
            'weight' => 'required|numeric|min:0.1',
        ]);

        $weight = $validated['weight'];

        // Pull the cheapest available carrier that can handle this specific weight
        // We order by price so we always return the most cost-effective hit first
        $carrier = Carrier::where('max_weight', '>=', $weight)
                    ->orderBy('price', 'asc')
                    ->first();

        // If the shipment exceeds our heaviest carrier (e.g., > 100kg), exit early
        if (!$carrier) {
            return response()->json([
                'success' => false,
                'message' => "No carriers support a weight of {$weight}kg."
            ], 404);
        }

        // Map the database record to our standard API response format
        return response()->json([
            'success' => true,
            'data' => [
                'carrier_name' => $carrier->name,
                'total_cost'   => $carrier->price,
                'max_capacity' => $carrier->max_weight,
                'currency'     => 'GBP'
            ]
        ]);
    }
}
