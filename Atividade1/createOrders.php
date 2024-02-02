<?php

function createOrders(): array
{
    $ordersCSV = fopen(__DIR__."/csv/orders.csv", "r");

    $count=0;
    while (($orders = fgetcsv($ordersCSV, null, ",")) !== FALSE) {
        
        $newOrderClass = new Order;
        $newOrderClass->setOrderId($orders[0]);
        $newOrderClass->setProductId($orders[1]);
        $newOrderClass->setDate($orders[2]);
        $newOrderClass->setQuantity($orders[3]);
        $ordersArray[$count] = $newOrderClass;
        
        $count++;
    }
    array_shift($ordersArray);
    fclose($ordersCSV);
    
    return $ordersArray;
}
