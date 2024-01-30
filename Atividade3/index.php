<?php

require_once __DIR__.'/classes/controller.php';
require_once __DIR__.'/classes/apiInfo.php';
require_once __DIR__.'/classes/router.php';
require_once __DIR__.'/classes/requestInfo.php';

$router = new Router();
$router->setMethod($_SERVER['REQUEST_METHOD']);
$router->setRoute($_SERVER['REQUEST_URI']); 

header('Content-Type: application/json');

http_response_code(200);

$router->verifyMethod();

$controller = new controller();
$controller->getAllPokemons($router->getRoute());
$controller->getPokemon($router->getRoute());








