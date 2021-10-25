<?php

declare(strict_types=1);

namespace App\Boarding;

use ArrayAccess;
use Iterator;
use LogicException;

class CartCollection implements Iterator
{
    protected int $position = 0;
    protected array $carts = [];

    public function add(Cart $cart): void
    {
        $this->carts[] = $cart;
    }

    public function getCarts(): array
    {
        return $this->carts;
    }

    public function current(): Cart
    {
        return $this->carts[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->carts[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

}
