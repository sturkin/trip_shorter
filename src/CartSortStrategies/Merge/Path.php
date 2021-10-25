<?php

declare(strict_types=1);

namespace App\CartSortStrategies\Merge;

class Path
{
    protected ?string $id = null;

    public function __construct(
        protected string $start,
        protected string $end,
        protected array $carts
    )
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

    public function getCarts(): array
    {
        return $this->carts;
    }

    public function addToEnd(Path $path): void
    {
        $this->end = $path->getEnd();
        $this->carts = array_merge($this->carts, $path->getCarts());
    }

    public function addToStart(Path $path): void
    {
        $this->start = $path->getStart();
        $this->carts = array_merge($path->getCarts(), $this->carts);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }


}
