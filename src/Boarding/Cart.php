<?php

declare(strict_types=1);

namespace App\Boarding;

use App\Boarding\Transports\Transport;

class Cart
{

    public function __construct(protected string $start, protected string $end, protected Transport $transport)
    {
    }

    public function getStart(): string
    {
        return $this->start;
    }

    public function getEnd(): string
    {
        return $this->end;
    }

    public function getTransport(): Transport
    {
        return $this->transport;
    }

    public function getDescription(): string
    {
        return $this->transport->getTransportDescription($this->start,$this->end, []);
    }




}
