<?php

class ApiInfo
{
    private string $url = 'https://pokeapi.co/api/v2';
    private string $endpoint;

    function setUrl($url)
    {
        $this->url = $url;
    }

    function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    function getUrl()
    {
        return $this->url;
    }

    function getEndpoint()
    {
        return $this->endpoint;
    }

    function getInfo(): array
    {
        $request = new RequestInfo();
        $response = $request->request($this->getUrl(), $this->getEndpoint());

        $decoded = json_decode($response, true);

        if (!$decoded) {
            http_response_code(404);
            echo json_encode(['message' => 'Data not found']);
            exit;
        }

        return $decoded;
    }
    
}