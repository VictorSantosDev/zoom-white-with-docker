<?php

namespace App\Domain\Prometheus\Services;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

class PrometheusService
{
    private string $orderCategory = 'orderCategory';

    public function __construct(
        private CollectorRegistry $collectorRegistry
    ) {
    }

    public function metrics(): string
    {

        $renderer = new RenderTextFormat();
        $result = $renderer->render($this->collectorRegistry->getMetricFamilySamples());

        header('Content-type: ' . RenderTextFormat::MIME_TYPE);

        return $result;
    }

    /**
     * @throws MetricsRegistrationException
     */
    public function createTestOrder($count = 1): void
    {
        $counter = $this->collectorRegistry->getOrRegisterCounter('orders', 'count', 'Number of Orders', ['category']);

        $counter->incBy($count, [$this->orderCategory]);
    }

    public function incrementOrder($count = 1)
    {
        $counter = $this->collectorRegistry->getOrRegisterCounter('orders', 'count', 'Number of Orders', ['category']);
        $counter->incBy($count, [$this->orderCategory]);
    }
}
