<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../model/MovEquipVisitTercDAO.class.php');
require_once('../model/MovEquipVisitTercPassagDAO.class.php');
/**
 * Description of MovVeicVisitTercCTR
 *
 * @author anderson
 */
class MovEquipVisitTercCTR {
        
    public function salvarMovVeicVisitTerc($body) {
        $idMovEquipVisitTercArray = array();
        $movEquipVisitTercArray = json_decode($body);
        foreach($movEquipVisitTercArray as $movEquipVisitTerc){
            $idMovEquipBD = $this->salvarMovEquipVisitTerc($movEquipVisitTerc);
            $this->salvarMovEquipVisitTercPassag($idMovEquipBD, $movEquipVisitTerc->movEquipVisitTercPassagList);
            $idMovEquipVisitTercArray[] = array("idMovEquipVisitTerc" => $movEquipVisitTerc->idMovEquipVisitTerc);
        }
        return $idMovEquipVisitTercArray;
    }

    private function salvarMovEquipVisitTerc($movEquipVisitTerc) {
        $movEquipVisitTercDAO = new MovEquipVisitTercDAO();
        $v = $movEquipVisitTercDAO->verifMovEquip($movEquipVisitTerc);
        if ($v == 0) {
            $movEquipVisitTercDAO->insMovEquip($movEquipVisitTerc);
        }
        return $movEquipVisitTercDAO->idMovEquip($movEquipVisitTerc);
    }
  
    private function salvarMovEquipVisitTercPassag($idMovEquipProprioBD, $dadosMovEquipVisitTercPassag) {
        $movEquipVisitTercPassagDAO = new MovEquipVisitTercPassagDAO();
        foreach ($dadosMovEquipVisitTercPassag as $movEquipVisitTercPassag) {
            $v = $movEquipVisitTercPassagDAO->verifMovEquipPassag($idMovEquipProprioBD, $movEquipVisitTercPassag);
            if ($v == 0) {
                $movEquipVisitTercPassagDAO->insMovEquipPassag($idMovEquipProprioBD, $movEquipVisitTercPassag);
            }
        }
    }
    
}
