<?php

declare(strict_types=1);

namespace App\Boarding\Transports;

interface Transport
{

    public function getTransportDescription(string $from, string $to, array $meta): string;

}
