<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NoCarrierFoundException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => 'NO_CARRIER_AVAILABLE',
            'message' => 'No carrier matches your parcel weight requirements.'
        ], 404); // We use 404 because the resource (a valid carrier) wasn't found
    }
}
