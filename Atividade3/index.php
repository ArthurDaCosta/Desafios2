<?php

$method = $_SERVER['REQUEST_METHOD'];
$route = $_SERVER['REQUEST_URI']; 

header('Content-Type: application/json');


http_response_code(200);


if ($method !== 'GET') {
    http_response_code(400);

    echo json_encode(['message' => 'Invalid method provided.']);
    exit;
}

if (preg_match('/\/\?page=[0-9]+/', $route) ) {

    $message = 'Read from file.';

    if (!file_exists('all.txt')) {
        $limit = 150;

        $message = 'Fetched from API.';

        $response = get("pokemon?limit=$limit");

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

if (preg_match('/\/pokemon\/.+/', $route) ) {

    $message = 'Read from file.';

    $searched = explode('/', substr($route, 1))[1];

    if (!file_exists("$searched.txt")) {
        $message = 'Fetched from API.';

        $response = get("pokemon/$searched");

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


function get($endpoint): array
{
    $base = 'https://pokeapi.co/api/v2';

    $ch = curl_init("$base/$endpoint");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        http_response_code(400);
        echo json_encode(['message' => 'Curl error: ' . curl_error($ch)]);
        exit;
    }

    curl_close($ch);

    $decoded = json_decode($response, true);

    if (!$decoded) {
        http_response_code(404);
        echo json_encode(['message' => 'Data not found']);
        exit;
    }

    return $decoded;
}

