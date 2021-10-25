<?php

declare(strict_types=1);

namespace App\CartSortStrategies\Merge;

use App\Boarding\CartCollection;
use App\Boarding\CartCollectionFactory;
use App\CartSortStrategies\SortStrategy;

class Strategy implements SortStrategy
{

    public function __construct(protected CartCollectionFactory $cartCollectionFactory)
    {
    }

    public function sort(CartCollection $collection): CartCollection
    {
        $pathSorter = new PathSorter();
        foreach ($collection as $cart) {
            $pathSorter->add(new Path($cart->getStart(), $cart->getEnd(), [$cart]));
        }

        $shortedPath = $pathSorter->getShortedPath();

        return $this->cartCollectionFactory->fromArray($shortedPath->getCarts());
    }


}
