<?php

declare(strict_types=1);

namespace App\Boarding\Transports;

class Plane implements Transport
{

    public function getTransportDescription(string $from, string $to, array $meta): string
    {
        $parts = [
            "From airport $from",
            !empty($meta['flight_number']) ? " take a flight ${meta['flight_number']}" : " take a flight",
            " to $to",
        ];

        return implode(',', $parts);
    }

}
