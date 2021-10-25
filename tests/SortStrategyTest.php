<?php

declare(strict_types=1);

namespace Test;

use App\Boarding\CartCollection;
use App\Boarding\CartFactory;
use App\Boarding\Transports\TransportFactory;
use App\CartSortStrategies\SortStrategyFactory;
use PHPUnit\Framework\TestCase;

class SortStrategyTest extends TestCase
{

    public function test_merge_sort(): void
    {
        $cartCollection = new CartCollection();
        $cartFactory = new CartFactory(new TransportFactory());

        $cartCollection->add($cartFactory->createPlaneCart('4','5'));
        $cartCollection->add($cartFactory->createPlaneCart('1','2'));
        $cartCollection->add($cartFactory->createPlaneCart('3','4'));
        $cartCollection->add($cartFactory->createPlaneCart('2','3'));


        $sortStrategyFactory = new SortStrategyFactory();
        $sortedCartCollection = $sortStrategyFactory->getMergeStrategy()->sort($cartCollection);

        $carts = $sortedCartCollection->getCarts();

        static::assertSame('1', $carts[0]->getStart());
        static::assertSame('2', $carts[0]->getEnd());

        static::assertSame('2', $carts[1]->getStart());
        static::assertSame('3', $carts[1]->getEnd());

        static::assertSame('3', $carts[2]->getStart());
        static::assertSame('4', $carts[2]->getEnd());

        static::assertSame('4', $carts[3]->getStart());
        static::assertSame('5', $carts[3]->getEnd());

    }

}
