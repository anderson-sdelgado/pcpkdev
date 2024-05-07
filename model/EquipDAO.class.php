<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of EquipDAO
 *
 * @author anderson
 */
class EquipDAO extends OCI {

    private $Conn;

    public function dados() {

        $select = " SELECT " 
                        . " E.EQUIP_ID AS \"idEquip\" "
                        . " , E.NRO_EQUIP AS \"nroEquip\" "
                    . " FROM "
                        . " EQUIP E "
                        . " , MODELO_EQUIP ME "
                        . " , CLASSE_OPER CO "
                    . " WHERE "
                        . " ME.MODELEQUIP_ID = E.MODELEQUIP_ID "
                        . " AND " 
                        . " CO.CLASSOPER_ID = E.CLASSOPER_ID "
                    . " ORDER BY E.NRO_EQUIP ASC ";

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
        
    }
    
}
