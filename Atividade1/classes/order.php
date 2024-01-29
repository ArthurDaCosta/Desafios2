<?php

class Order
{
    private $orderId;
    private $productId;
    private $date;
    private $quantity;

    function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    function setProductId($productId)
    {
        $this->productId = $productId;
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    function getOrderId()
    {
        return $this->orderId;
    }

    function getProductId()
    {
        return $this->productId;
    }

    function getDate()
    {
        return $this->date;
    }

    function getQuantity()
    {
        return $this->quantity;
    }


}