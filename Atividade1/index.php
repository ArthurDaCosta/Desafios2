<?php

require_once "createOrders.php";
require_once "createProducts.php";
require_once __DIR__ ."/classes/order.php";
require_once __DIR__ ."/classes/product.php";
require_once __DIR__ ."/classes/report.php";


$orders = createOrders();
$products = createProducts();

$count=0;
foreach ($products as $product)
{   

    $report[$count] = new Report;
    $report[$count]->id = $product->getId(); 
    $report[$count]->priceUnit = $product->getPrice();

    foreach ($orders as $order)
    {
        if($order->getProductId() == $report[$count]->id)
        {
            if(strtotime($order->getDate()) >= strtotime($report[$count]->lastSale))
            {
                $report[$count]->lastSale = $order->getDate();
            }

            $report[$count]->totalQuant += $order->getQuantity();
            print_r($report[$count]->totalQuant);
        }

    }
    $report[$count]->total = $report[$count]->totalQuant * $report[$count]->priceUnit;


    $count++;
}

$reportCSV=fopen("report.csv", "w");
fputcsv($reportCSV, ["ID do produto", "preço unitário", "data da última venda", "quantidade total vendida", "valor total vendido"]);
fputcsv($reportCSV, []);
foreach ($report as $linha)
{
    fputcsv($reportCSV, (array) $linha);
}
fclose($reportCSV);

print_r($orders);




    