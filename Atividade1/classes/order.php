<?php

class Order
{
    private string $orderId;
    private string $productId;
    private string $date;
    private int $quantity;

    function setOrderId(string $orderId)
    {
        $this->orderId = $orderId;
    }

    function setProductId(string $productId)
    {
        $this->productId = $productId;
    }

    function setDate(string $date)
    {
        $this->date = $date;
    }

    function setQuantity(int $quantity)
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