<?php

class ApiController {

    private $jwt_key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L1Npc3RlbWFFbmNvbWllbmRhcyIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3QvU2lzdGVtYUVuY29taWVuZGFzIiwiaWF0IjoxNzMwOTA0MTU5LCJuYmYiOjE3MzA5MDQxNTksImRhdGEiOnsiaWRVc3VhcmlvIjo0LCJ1c3VhcmlvIjoiYWNyaXMiLCJwZXJmaWwiOiJlbXByZXNhIn19.B9cZENPvfqJV281W8-RlfRrLiLxc0H-UrepANGyzLSU'; // Reemplaza con tu clave JWT real
    private $base_url = 'https://proyecto-web.com/SistemaEncomiendas/api/';

    public function postEnvio($data) {
        $url = $this->base_url . 'envios';
        //print_r($data);
        //print_r($url);
        return $this->makeRequest('POST', $url, $data);
    }

    public function getSucursales() {
        $url = $this->base_url . 'sucursales';
        return $this->makeRequest('GET', $url);
    }

    public function getEnvios() {
        $url = $this->base_url . 'envios';
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

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new Exception('Error en cURL: ' . curl_error($ch));
            }
        
            curl_close($ch);
        
            // Limpiar la respuesta para extraer solo el JSON
            $json_start = strpos($response, '{');
            if ($json_start !== false) {
                $response = substr($response, $json_start);
            }
        
            // Decodificar la respuesta JSON
            // $decoded_response = json_decode($response, true);
        
            // Verificar si la decodificación fue exitosa
            // if (is_array($decoded_response) && isset($decoded_response['message']) && $decoded_response['message'] === 'ok') {
            //     return true;
            // }
        
            // Devolver la respuesta completa si no contiene "message: ok"
            return json_decode($response, true);
            
        } elseif ($method == 'GET') {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new Exception('Error en cURL: ' . curl_error($ch));
                print_r($response);
            }
    
            curl_close($ch);
            
        
            return json_decode($response, true);
        }

    }




}
