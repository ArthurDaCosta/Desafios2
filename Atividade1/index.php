<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
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
    $email->AddAttachment( __DIR__."/report.csv");

    $email->Send();
    echo "\n";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$email->ErrorInfo} \n";
}




