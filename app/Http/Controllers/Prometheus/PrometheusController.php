<?php

namespace App\Http\Controllers\Prometheus;

use App\Domain\Prometheus\Services\PrometheusService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrometheusController extends Controller
{
    private PrometheusService $service;

    public function __construct(PrometheusService $service)
    {
        $this->service = $service;
    }

    public function metrics(): string
    {
        return $this->service->metrics();
    }

    /**
     * @throws MetricsRegistrationException
     */
    public function createTestOrder(): JsonResponse
    {
        $this->service->incrementOrder();

        // Create Order Codes

        return $this->successResponse('The order has been successfully created.');
    }
}
