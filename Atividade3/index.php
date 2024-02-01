<?php

require_once __DIR__.'/classes/Controller.php';
require_once __DIR__.'/classes/API.php';
require_once __DIR__.'/classes/Router.php';
require_once __DIR__.'/classes/RequestAPI.php';

$router = new Router();
$router->setMethod($_SERVER['REQUEST_METHOD']);
$router->setRoute($_SERVER['REQUEST_URI']); 
http_response_code(200);

$router->verifyMethod();








