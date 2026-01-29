<?php

namespace App\Services;

use App\Models\Carrier;

class CarrierService
{
    /**
     * Find the cheapest carrier that can handle the given weight.
     */
    public function findCheapestCarrier(float $weight): ?Carrier
    {
        return Carrier::where('max_weight', '>=', $weight)
                    ->orderBy('price', 'asc')
                    ->first();
    }
}
