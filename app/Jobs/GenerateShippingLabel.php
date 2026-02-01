<?php

namespace App\Jobs;

use App\Models\Carrier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateShippingLabel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $carrier;

    public function __construct(Carrier $carrier)
    {
        $this->carrier = $carrier;
    }

    public function handle(): void
    {
        // 1. Log the start
        Log::info("--- STARTING LABEL GEN FOR: {$this->carrier->name} ---");

        // 2. Simulate "Heavy" work (API calls, PDF rendering)
        sleep(5);

        // 3. Log the finish
        Log::info("--- LABEL READY FOR: {$this->carrier->name} ---");
    }
}
