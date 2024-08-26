<?php

class ApiController {

    private $jwt_key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L1Byb3llY3RvLXdlYi1FbmNvbWllbmRhcyIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3QvUHJveWVjdG8td2ViLUVuY29taWVuZGFzIiwiaWF0IjoxNzI0MTk4Nzg0LCJuYmYiOjE3MjQxOTg3ODQsImRhdGEiOnsiaWRVc3VhcmlvIjo2LCJ1c3VhcmlvIjoiYWNyaXMiLCJwZXJmaWwiOiJlbXByZXNhIn19.4q28eHicNDjw9tH53OJ1qOpu84CHtjKvS4fQEDS8Plo'; // Debes colocar tu clave JWT aquí
    private $base_url = 'https://proyecto-web.com/Proyecto-web-Encomiendas/api/';

    public function postEnvio($data) {
        $url = $this->base_url . 'envios';
        return $this->makeRequest('POST', $url, $data);
    }

    public function getSucursales() {
        $url = $this->base_url . 'sucursales';
        return $this->makeRequest('GET', $url);
    }

    private function makeRequest($method, $url, $data = null) {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->jwt_key,
            'Content-Type: application/json'
        ]);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method == 'GET') {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Error en cURL: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
