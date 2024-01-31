<?php

class Controller
{
    function getAllPokemons($route)
    {
        $apiInfo = new API();
        if (preg_match('/\/\?page=[0-9]+/', $route) ) {

            $message = 'Read from file.';
        
            if (!file_exists('all.txt')) {
                $message = 'Fetched from API.';
        
                $apiInfo->setEndpoint('pokemon?limit=150');
                $response = $apiInfo->getInfo();
        
                $data = array_map(function ($data) {
                    return $data["name"];
                }, $response['results']);
        
                file_put_contents('all.txt', json_encode($data));
            }
        
            $fileContent = file_get_contents('all.txt');
        
            $todos = json_decode($fileContent, true);
        
            $page = (int)$_GET['page'] ?? 1;
        
            $resultsPerPage = 15;
        
            if ($page < 1) {
                $page = 1;
            }
        
            if ($page * $resultsPerPage > count($todos)) {
                $page = ceil(count($todos) / $resultsPerPage);
            }
        
            $retorno = array_slice($todos, ($page - 1) * $resultsPerPage, $resultsPerPage);
        
            echo json_encode([
                'message' => $message,
                'page' => $page,
                'data' => $retorno
            ]);
            exit;
        }
    }

    function getPokemon($route)
    {
        $apiInfo = new API();
        if (preg_match('/\/pokemon\/.+/', $route) ) {

            $message = 'Read from file.';
        
            $searched = explode('/', substr($route, 1))[1];
        
            if (!file_exists("$searched.txt")) {
                $message = 'Fetched from API.';
        
                $apiInfo->setEndpoint("pokemon/$searched");
                $response = $apiInfo->getInfo();
        
                $formatted = [
                    'name' => $response['name'],
                    'stats' => []
                ];
        
                foreach ($response['stats'] as $stat) {
                    $formatted['stats'][$stat['stat']['name']] = $stat['base_stat'];
                }
        
                file_put_contents("$searched.txt", json_encode($formatted));
            }
            $fileContent = file_get_contents("$searched.txt");
        
            echo json_encode([
                'message' => $message,
                'pokemon' => json_decode($fileContent)
            ]);
            exit;
        }
    }
}