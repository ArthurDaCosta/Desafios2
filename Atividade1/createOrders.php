<?php

function createOrders(): array
{
    $ordersCSV = fopen(__DIR__."/csv/orders.csv", "r");

    $count=0;
    while (($orders = fgetcsv($ordersCSV, 1000, ",")) !== FALSE) {
        
        for ($Linha=0; $Linha < count($orders); $Linha++) {
            $ordersArray[$count][$Linha] = $orders[$Linha];    
        }
        
        $count++;
    }
    array_shift($ordersArray);
    fclose($ordersCSV);

    for ($orderNumber=0; $orderNumber < count($ordersArray); $orderNumber++) {
        $newOrderClass = new Order;
        $newOrderClass->setOrderId($ordersArray[$orderNumber][0]);
        $newOrderClass->setProductId($ordersArray[$orderNumber][1]);
        $newOrderClass->setDate($ordersArray[$orderNumber][2]);
        $newOrderClass->setQuantity($ordersArray[$orderNumber][3]);
        $ordersArray[$orderNumber] = $newOrderClass;
    }

    return $ordersArray;
}
