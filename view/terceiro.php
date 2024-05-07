<?php

$headers = getallheaders();
header('Content-type: application/json');

if (!array_key_exists('Authorization', $headers)) {
    echo json_encode(["error" => "Authorization header is missing"]);
    exit;
}

require_once('../control/AtualAplicCTR.class.php');

$atualAplicCTR = new AtualAplicCTR();
if (!$atualAplicCTR->verToken($headers)){
    echo json_encode(["error" => "Invalid token"]);
    exit;
}

require_once('../control/DataBaseCTR.class.php');

$dataBaseCTR = new DataBaseCTR();
echo $dataBaseCTR->dadosTerceiro();