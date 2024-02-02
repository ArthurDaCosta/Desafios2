<?php

function createProducts(): array
{
    $productsCSV = fopen(__DIR__."/csv/products.csv", "r");

    $count=0;
    while (($products = fgetcsv($productsCSV, null, ",")) !== FALSE) {
        
        $newProductClass = new Product;
        $newProductClass->setId($products[0]);
        $newProductClass->setName($products[1]);
        $newProductClass->setPrice($products[2]);
        $productsArray[$count] = $newProductClass;

        $count++;
    }
    array_shift($productsArray);
    fclose($productsCSV);

    return $productsArray;
}