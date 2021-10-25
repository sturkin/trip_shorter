<?php

declare(strict_types=1);

namespace App\Boarding;

use App\Boarding\Transports\TransportFactory;

class CartFactory
{
    public function __construct(protected TransportFactory $factory)
    {
    }

    public function createPlaneCart(string $start, string $end): Cart
    {
        return new Cart($start,$end, $this->factory->buildPlane());
    }
}
