<?php

declare(strict_types=1);

namespace App\Boarding;

class CartCollectionFactory
{

    public function fromArray(array $carts): CartCollection
    {
        $collection = new CartCollection();
        foreach ($carts as $cart) {
            $collection->add($cart);
        }

        return $collection;
    }

}
