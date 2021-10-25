<?php

declare(strict_types=1);

namespace App\CartSortStrategies;

use App\Boarding\CartCollection;

interface SortStrategy
{

    public function sort(CartCollection $collection): CartCollection;

}
