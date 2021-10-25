<?php

declare(strict_types=1);

namespace App\CartSortStrategies;

use App\Boarding\CartCollectionFactory;
use App\CartSortStrategies\Merge\PathSorter;
use App\CartSortStrategies\Merge\Strategy;

class SortStrategyFactory
{

    public function getMergeStrategy(): Strategy
    {
        return new Strategy(new CartCollectionFactory());
    }

}
