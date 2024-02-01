<?php 

class Product 
{
    private string $id;
    private string $name;
    private float $price;

    function setId(string $id)
    {
        $this->id = $id;
    }

    function setName(string $name)
    {
        $this->name = $name;
    }

    function setPrice(float $price)
    {
        $this->price = $price;
    }


    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function getPrice()
    {
        return $this->price;
    }

    
}