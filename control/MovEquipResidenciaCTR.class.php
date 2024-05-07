<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../model/MovEquipResidenciaDAO.class.php');
/**
 * Description of MovVeicResidenciaCTR
 *
 * @author anderson
 */
class MovEquipResidenciaCTR {
    
    public function salvarMovEquipResidencia($body) {
        $idMovEquipResidenciaArray = array();
        $movEquipResidenciaArray = json_decode($body);
        foreach($movEquipResidenciaArray as $movEquipResidencia){
            $this->salvarMovEquip($movEquipResidencia);
            $idMovEquipResidenciaArray[] = array("idMovEquipResidencia" => $movEquipResidencia->idMovEquipResidencia);
        }
        return $idMovEquipResidenciaArray;
    }
    
    private function salvarMovEquip($movEquipResidencia) {
        $movEquipResidenciaDAO = new MovEquipResidenciaDAO();
        $v = $movEquipResidenciaDAO->verifMovEquip($movEquipResidencia);
        if ($v == 0) {
            $movEquipResidenciaDAO->insMovEquip($movEquipResidencia);
        }
    }
 
}
