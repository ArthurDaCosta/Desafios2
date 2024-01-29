<?php

class Report
{
    public $id;
    public $priceUnit = 0;
    public $lastSale = 'not sold';
    public $totalQuant = 0;
    public $total = 0;

    function setId($id)
    {
        $this->id = $id;
    }

    function setPriceUnit($priceUnit)
    {
        $this->priceUnit = $priceUnit;
    }

    function setLastSale($lastSale)
    {
        $this->lastSale = $lastSale;
    }

    function setTotalQuant($totalQuant)
    {
        $this->totalQuant = $totalQuant;
    }

    function setTotal($total)
    {
        $this->total = $total;
    }



    function getId()
    {
        return $this->id;
    }

    function getPriceUnit()
    {
        return $this->priceUnit;
    }
    
    function getLastSale()
    {
        return $this->lastSale;
    }

    function getTotalQuant()
    {
        return $this->totalQuant;
    }
    
    function getTotal()
    {
        return $this->total;
    }


}