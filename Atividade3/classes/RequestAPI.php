<?php

class RequestAPI
{
    function request(string $url, string $endpoint)
    {
        $ch = curl_init("$url$endpoint");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            http_response_code(400);
            echo json_encode(['message' => 'Curl error: ' . curl_error($ch)]);
            exit;
        }

        curl_close($ch);

        return $response;
    }

}
