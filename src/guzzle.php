<?php 

// Receber CEP
$cep = filter_input(INPUT_GET, 'cep', FILTER_SANITIZE_NUMBER_INT);

// Validar CEP
if (!$cep) {
    echo json_encode(array('error' => 'CEP não informado'));
    exit;
}

// Validar formatação do CEP
if (!preg_match("/^[0-9]{8}$/", $cep)) {
    echo json_encode(array('error' => 'CEP inválido'));
    exit;
}

$url = "https://viacep.com.br/ws/{$cep}/json/";

// Guzzlehttp
require_once('vendor/autoload.php');
use GuzzleHttp\Client;

$client = new Client();
$response = $client->request('GET', $url, [
    'headers' => [
        'Accept' => 'application/json',
        'Content-type' => 'application/json'
    ]
]);

echo $response->getBody();