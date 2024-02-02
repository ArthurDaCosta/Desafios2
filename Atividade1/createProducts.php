<?php

function createProducts(): array
{
    $productsCSV = fopen(__DIR__."/csv/products.csv", "r");

    $count=0;
    while (($products = fgetcsv($productsCSV, null, ",")) !== FALSE) {
        
        $newOrderClass = new Product;
        $newOrderClass->setId($products[0]);
        $newOrderClass->setName($products[1]);
        $newOrderClass->setPrice($products[2]);
        $productsArray[$count] = $newOrderClass;

        $count++;
    }
    array_shift($productsArray);
    fclose($productsCSV);

    return $productsArray;
}