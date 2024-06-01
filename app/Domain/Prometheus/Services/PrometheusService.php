<?php

namespace App\Domain\Prometheus\Services;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;

class PrometheusService
{
    private string $orderCategory = 'orderCategory';

    public function metrics(): string
    {
        /** @var CollectorRegistry $collectorRegistry */
        $collectorRegistry = resolve(CollectorRegistry::class);

        $renderer = new RenderTextFormat();

        $result = $renderer->render($collectorRegistry->getMetricFamilySamples());

        header('Content-type: ' . RenderTextFormat::MIME_TYPE);

        return $result;
    }

    /**
     * @throws MetricsRegistrationException
     */
    public function createTestOrder($count = 1): void
    {
        /** @var CollectorRegistry $collectorRegistry */
        $collectorRegistry = resolve(CollectorRegistry::class);

        $counter = $collectorRegistry->getOrRegisterCounter('orders', 'count', 'Number of Orders', ['category']);

        $counter->incBy($count, [$this->orderCategory]);
    }

    public function incrementOrder($count = 1)
    {
        /** @var CollectorRegistry $collectorRegistry */
        $collectorRegistry = resolve(CollectorRegistry::class);

        $counter = $collectorRegistry->getOrRegisterCounter('orders', 'count', 'Number of Orders', ['category']);
        $counter->incBy($count + 1, [$this->orderCategory]);
    }
}
