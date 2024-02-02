<?php

class Report
{
    public string $id;
    public float $priceUnit = 0;
    public string $lastSale = 'not sold';
    public int $totalQuant = 0;
    public float $total = 0;

    function setId(string $id)
    {
        $this->id = $id;
    }

    function setPriceUnit(float $priceUnit)
    {
        $this->priceUnit = $priceUnit;
    }

    function setLastSale(string $lastSale)
    {
        $this->lastSale = $lastSale;
    }

    function setTotalQuant(int $totalQuant)
    {
        $this->totalQuant = $totalQuant;
    }

    function setTotal(float $total)
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