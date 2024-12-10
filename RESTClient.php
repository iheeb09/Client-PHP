<?php

//classe pour la consommation d'une API REST utilisant  "curl"
class RestClient {
    private $apiUrl;
    public function __construct($apiUrl) {
        $this->apiUrl = rtrim($apiUrl, '/');
    }

    private function sendRequest($method, $endpoint, $data = null) {
        $url = $this->apiUrl . '/' . $endpoint;        
        $ch = curl_init($url);

        // Configuration de l'option pour chaque type de requête
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        // Pour POST et PUT,  encoder et envoyer les données
        if ($data) {
            
            $jsonData = json_encode($data);      
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        }

        //exécuter l'url
        $response = curl_exec($ch);
        
        // Gestion des erreurs cURL
        if (curl_errno($ch)) {
            echo 'Erreur cURL : ' . curl_error($ch);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        //convertir la réponse JSON de l'API en un tableau associatif PHP
        return  json_decode($response, true);      
        
    }

    // Méthode GET
  /*  public function get($endpoint) {
        return $this->sendRequest('GET', $endpoint);
    }
*/
public function get($endpoint) {
    $result[] = [];
    $response = $this->sendRequest('GET', $endpoint);
    $result['person'] = $response;

    return $result;
}

    // Méthode POST
    public function post($endpoint, $data) {
        return $this->sendRequest('POST', $endpoint, $data);
    }

    // Méthode PUT
    public function put($endpoint, $data) {
        return $this->sendRequest('PUT', $endpoint, $data);
    }

    // Méthode DELETE
    public function delete($endpoint) {
        return $this->sendRequest('DELETE', $endpoint);
    }
}

// référence l'endpoint de l'API de gestion des personnes du tp8
$client = new RestClient("http://localhost:8085/person/");

?>