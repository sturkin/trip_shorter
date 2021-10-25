<?php

include dirname(__FILE__) . '/../vendor/autoload.php';

use App\Boarding\CartCollection;
use App\Boarding\CartFactory;
use App\Boarding\Transports\TransportFactory;
use App\CartSortStrategies\SortStrategyFactory;

$startData = [];
for($i=1;$i<100;$i++) {
    $startData[] = [
        'start' => $i,
        'end' => $i+1
    ];
}

shuffle($startData);

$cartCollection = new CartCollection();
$cartFactory = new CartFactory(new TransportFactory());

foreach ($startData as $item) {
    $cartCollection->add($cartFactory->createPlaneCart($item['start'], $item['end']));
}

$sortStrategyFactory = new SortStrategyFactory();
$sortedCartCollection = $sortStrategyFactory->getMergeStrategy()->sort($cartCollection);

foreach ($sortedCartCollection as $item) {
    echo $item->getDescription() . "\n";
}
