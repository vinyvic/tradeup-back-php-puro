<?php
/**
 * PHP Pure API CEP
 */

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

// PHP Curl
$url = "https://viacep.com.br/ws/{$cep}/json/";

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Accept:application/json, Content-Type:application/json"]);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resource = curl_exec($ch);


if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
    echo json_encode(array('error' => 'CEP inválido'));
}
else {
    echo $resource;
}

curl_close($ch);
