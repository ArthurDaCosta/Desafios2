<?php

function createProducts(): array
{
    $productsCSV = fopen("products.csv", "r");

    $count=0;
    while (($products = fgetcsv($productsCSV, 1000, ",")) !== FALSE) {
        
        for ($Linha=0; $Linha < count($products); $Linha++) {
            $productsArray[$count][$Linha] = $products[$Linha];    
        }

        $count++;
    }
    array_shift($productsArray);
    fclose($productsCSV);

    for ($productNumber=0; $productNumber < count($productsArray); $productNumber++) {
        $newOrderClass = new Product;
        $newOrderClass->setId($productsArray[$productNumber][0]);
        $newOrderClass->setName($productsArray[$productNumber][1]);
        $newOrderClass->setPrice($productsArray[$productNumber][2]);
        $productsArray[$productNumber] = $newOrderClass;
    }

    return $productsArray;
}