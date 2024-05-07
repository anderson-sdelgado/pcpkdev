<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/OCIAPEX.class.php');
/**
 * Description of MovEquipSegProprioDAO
 *
 * @author anderson
 */
class MovEquipProprioSegDAO extends OCIAPEX {

    public function verifMovEquipSeg($idMovEquipProprioBD, $movEquipSeg) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PORTARIA_MOV_EQUIP_PROPRIO_SEG "
                    . " WHERE "
                        . " MOV_EQUIP_ID = " . $idMovEquipProprioBD
                        . " AND "
                        . " EQUIP_ID = " . $movEquipSeg->idEquipMovEquipProprioSeg;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;
        
    }

    public function insMovEquipSeg($idMovEquipProprioBD, $movEquipSeg) {

        $sql = "INSERT INTO PORTARIA_MOV_EQUIP_PROPRIO_SEG ("
                        . " MOV_EQUIP_ID "
                        . " , EQUIP_ID "
                    . " ) "
                    . " VALUES ("
                        . " :idMovEquip "
                        . " , :idEquip "
                    . " )";

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_bind_by_name($result, ":idMovEquip", $idMovEquipProprioBD);
        oci_bind_by_name($result, ":idEquip", $movEquipSeg->idEquipMovEquipProprioSeg);
        oci_execute($result);
        
    }

}
