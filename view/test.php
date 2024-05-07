<?php

require_once('../control/AtualAplicCTR.class.php');

$headers = getallheaders();
header('Content-type: application/json');
$body = file_get_contents('php://input');

if (isset($body)):

    $atualAplicCTR = new AtualAplicCTR();
    $configArray = $atualAplicCTR->inserirDados($body);
    echo json_encode($configArray);

endif;
