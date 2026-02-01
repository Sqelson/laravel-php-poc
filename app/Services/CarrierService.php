<?php

namespace App\Services;

use App\Models\Carrier;
use App\Exceptions\NoCarrierFoundException;

class CarrierService
{
    /**
     * Find the cheapest carrier that can handle the given weight.
     */
    public function findCheapestCarrier(float $weight): ?Carrier
    {
        $carrier = \App\Models\Carrier::where('max_weight', '>=', $weight)
                    ->orderBy('price', 'asc')        // First priority: Lowest price
                    ->orderBy('max_weight', 'desc')  // Tie-breaker: Highest capacity
                    ->first();

        if (!$carrier) {
            throw new NoCarrierFoundException();
        }

        return $carrier;
    }
}
