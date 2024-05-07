<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/ColabDAO.class.php');
require_once('../model/EquipDAO.class.php');
require_once('../model/LocalDAO.class.php');
require_once('../model/TerceiroDAO.class.php');
require_once('../model/VisitanteDAO.class.php');

class DataBaseCTR {

    public function dadosColab() {
        $colabDAO = new ColabDAO();
        return json_encode($colabDAO->dados(), JSON_NUMERIC_CHECK);
    }
    
    public function dadosEquip() {
        $equipDAO = new EquipDAO();
        return json_encode($equipDAO->dados(), JSON_NUMERIC_CHECK);
    }
        
    public function dadosLocal() {
        $localDAO = new LocalDAO();
        return json_encode($localDAO->dados(), JSON_NUMERIC_CHECK);
    }

    public function dadosTerceiro() {
        $terceiroDAO = new TerceiroDAO();
        return json_encode($terceiroDAO->dados(), JSON_NUMERIC_CHECK);
    }
    
    public function dadosVisitante() {
        $visitanteDAO = new VisitanteDAO();
        return json_encode($visitanteDAO->dados(), JSON_NUMERIC_CHECK);
    }
    
}
