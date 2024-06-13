<?php

namespace App\Utils\PublishMetrics;

use Prometheus\CollectorRegistry;

class PublishMetrics
{
    /** method increment authentication */
    static public function incrementAuth()
    {
        /** @var CollectorRegistry $collectorRegistry */
        $collectorRegistry = resolve(CollectorRegistry::class);

        $counter = $collectorRegistry->getOrRegisterCounter('login', 'auth', 'Number of Authentication', ['authentication']);
        $counter->incBy(1, ['auth']);
    }
}
