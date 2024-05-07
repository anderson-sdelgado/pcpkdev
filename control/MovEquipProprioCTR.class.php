<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../model/MovEquipProprioDAO.class.php');
require_once('../model/MovEquipProprioSegDAO.class.php');
require_once('../model/MovEquipProprioPassagDAO.class.php');
/**
 * Description of MovVeicProprioCTR
 *
 * @author anderson
 */
class MovEquipProprioCTR {
    
    public function salvarMovEquipProprio($body) {
        $idMovEquipProprioArray = array();
        $movEquipProprioArray = json_decode($body);
        foreach($movEquipProprioArray as $movEquipProprio){
            $idMovEquipBD = $this->salvarMovEquip($movEquipProprio);
            $this->salvarMovEquipSeg($idMovEquipBD, $movEquipProprio->movEquipProprioSegList);
            $this->salvarMovEquipPassag($idMovEquipBD, $movEquipProprio->movEquipProprioPassagList);
            $idMovEquipProprioArray[] = array("idMovEquipProprio" => $movEquipProprio->idMovEquipProprio);
        }
        return json_encode($idMovEquipProprioArray, JSON_NUMERIC_CHECK);
    }
    
    private function salvarMovEquip($movEquipProprio) {
        $movEquipProprioDAO = new MovEquipProprioDAO();
        $v = $movEquipProprioDAO->verifMovEquip($movEquipProprio);
        if ($v == 0) {
            $movEquipProprioDAO->insMovEquip($movEquipProprio);
        }
        return $movEquipProprioDAO->idMovEquip($movEquipProprio);
    }

    private function salvarMovEquipSeg($idMovEquipProprioBD, $dadosMovEquipProprioSeg) {
        $movEquipProprioSegDAO = new MovEquipProprioSegDAO();
        foreach ($dadosMovEquipProprioSeg as $movEquipProprioSeg) {
            $v = $movEquipProprioSegDAO->verifMovEquipSeg($idMovEquipProprioBD, $movEquipProprioSeg);
            if ($v == 0) {
                $movEquipProprioSegDAO->insMovEquipSeg($idMovEquipProprioBD, $movEquipProprioSeg);
            }
        }
    }
 
    private function salvarMovEquipPassag($idMovEquipProprioBD, $dadosMovEquipProprioPassag) {
        $movEquipProprioPassagDAO = new MovEquipProprioPassagDAO();
        foreach ($dadosMovEquipProprioPassag as $movEquipProprioPassag) {
            $v = $movEquipProprioPassagDAO->verifMovEquipPassag($idMovEquipProprioBD, $movEquipProprioPassag);
            if ($v == 0) {
                $movEquipProprioPassagDAO->insMovEquipPassag($idMovEquipProprioBD, $movEquipProprioPassag);
            }
        }
    }
    
}
