<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthCheckController extends Controller
{
    /**
     * Check if the application is healthy
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        // Check database connection
        try {
            DB::connection()->getPdo();
            $databaseStatus = true;
        } catch (\Exception $e) {
            $databaseStatus = false;
        }

        $status = $databaseStatus ? 200 : 503;
        
        return response()->json([
            'status' => $status === 200 ? 'ok' : 'error',
            'database' => $databaseStatus ? 'connected' : 'disconnected',
            'timestamp' => now()->toIso8601String()
        ], $status);
    }
}
