<?php

class Router
{
    private $method;
    private $route;

    function getMethod()
    {
        return $this->method;
    }

    function setMethod($method)
    {
        $this->method = $method;
    }

    function getRoute()
    {
        return $this->route;
    }

    function setRoute($route)
    {
        $this->route = $route;
    }

    function verifyMethod()
    {
        if ($this->getMethod() !== 'GET') {
            http_response_code(400);
        
            echo json_encode(['message' => 'Invalid method provided.']);
            exit;
        } else {
            header('Content-Type: application/json');
            if (preg_match('/\/\?page=[0-9]+/', $this->getRoute()) ) {
                Controller::getAllPokemons();
                exit;
            }
            if (preg_match('/\/pokemon\/.+/', $this->getRoute()) ) {
                Controller::getPokemon($this->getRoute());
                exit;
            }
        }       
    }
    
    
}