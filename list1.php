<?php
require_once('RESTClient.php');

// Récupérer les données de l'API
$dataGetAll = $client->get("getAll");

// Débogage : afficher la réponse brute de l'API
echo "<pre>";
var_dump($dataGetAll);
echo "</pre>";
?>
