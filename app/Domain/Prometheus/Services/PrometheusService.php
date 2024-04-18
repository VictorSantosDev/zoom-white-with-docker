<?php

namespace App\Domain\Prometheus\Services;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;

class PrometheusService
{
    private string $orderCategory = 'orderCategory';

    private CollectorRegistry $collectorRegistry;

    public function __construct(CollectorRegistry $registry)
    {
        $this->collectorRegistry = $registry->getDefault();
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
        $counter->incBy($count + 1, [$this->orderCategory]);
    }
}
