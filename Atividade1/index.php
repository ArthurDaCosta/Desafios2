<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once "createOrders.php";
require_once "createProducts.php";
require_once "classes/Order.php";
require_once "classes/Product.php";
require_once "classes/Report.php";



$orders = createOrders();
$products = createProducts();


foreach ($products as $key=>$product)
{   
    $report[$key] = new Report;
    $report[$key]->id = $product->getId(); 
    $report[$key]->priceUnit = (float) $product->getPrice();

    foreach ($orders as $order)
    {
        if($order->getProductId() == $report[$key]->id)
        {
            if(strtotime($order->getDate()) >= strtotime($report[$key]->lastSale))
            {
                $report[$key]->lastSale = $order->getDate();
            }

            $report[$key]->totalQuant += (int) $order->getQuantity();
        }

    }
    $report[$key]->total = $report[$key]->totalQuant * $report[$key]->priceUnit;
}

$reportCSV=fopen("csv/report.csv", "w");
fputcsv($reportCSV, ["ID do produto", "preço unitário", "data da última venda", "quantidade total vendida", "valor total vendido"]);
fputcsv($reportCSV, []);
foreach ($report as $linha)
{
    fputcsv($reportCSV, (array) $linha);
}
fclose($reportCSV);

$email = new PHPMailer(true);
try {
    $email->isSMTP();
    $email->Host = 'sandbox.smtp.mailtrap.io';
    $email->SMTPAuth = true;
    $email->Port = 2525;
    $email->Username = '7dba6e0582d7e2';
    $email->Password = '54502c2c6aa609';

    $email->SetFrom('from@example.com', 'Arthur');
    $email->Subject   = 'Desafio 2 - Atividade 1';
    $email->Body   = 'Arquivo CSV em anexo.';
    $email->AddAddress( 'AddAddress@example.com' );
    $email->AddAttachment( "csv/report.csv");

    $email->Send();
    echo "\n";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$email->ErrorInfo} \n";
}




