<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/OCIAPEX.class.php');
/**
 * Description of MovEquipProprioPassagDAO
 *
 * @author anderson
 */
class MovEquipProprioPassagDAO extends OCIAPEX {
    
    public function verifMovEquipPassag($idMovEquipProprioBD, $movEquipPassag) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PORTARIA_MOV_EQUIP_PROPRIO_PASSAG "
                    . " WHERE "
                        . " MOV_EQUIP_ID = " . $idMovEquipProprioBD
                        . " AND "
                        . " NRO_MATRIC_PASSAG = " . $movEquipPassag->nroMatricMovEquipProprioPassag;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;
        
    }

    public function insMovEquipPassag($idMovEquipProprioBD, $movEquipPassag) {

        $sql = "INSERT INTO PORTARIA_MOV_EQUIP_PROPRIO_PASSAG ("
                        . " MOV_EQUIP_ID "
                        . " , NRO_MATRIC_PASSAG "
                    . " ) "
                    . " VALUES ("
                        . " :idMovEquip "
                        . " , :nroMatric "
                    . " )";

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_bind_by_name($result, ":idMovEquip", $idMovEquipProprioBD);
        oci_bind_by_name($result, ":nroMatric", $movEquipPassag->nroMatricMovEquipProprioPassag);
        oci_execute($result);
        
    }

}
