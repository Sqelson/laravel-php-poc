<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarrierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
{
    return [
        'carrier_name' => $this->name,
        'shipping_cost' => [
            'amount' => (float) $this->price,
            'currency' => 'GBP',
            'formatted' => '£' . number_format($this->price, 2),
        ],
        'max_weight_capacity' => $this->max_weight . 'kg',
    ];
}
}
