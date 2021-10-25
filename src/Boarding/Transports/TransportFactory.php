<?php

declare(strict_types=1);

namespace App\Boarding\Transports;

class TransportFactory
{
    public function buildPlane(): Plane
    {
        return new Plane();
    }

}
