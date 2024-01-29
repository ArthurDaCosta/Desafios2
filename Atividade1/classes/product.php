<?php 

class Product 
{
    private $id;
    private $name;
    private $price;

    function setId($id)
    {
        $this->id = $id;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }

    function setName($name)
    {
        $this->name = $name;
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