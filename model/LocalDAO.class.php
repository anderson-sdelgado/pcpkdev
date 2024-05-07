<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/OCIAPEX.class.php');
/**
 * Description of LocalDAO
 *
 * @author anderson
 */
class LocalDAO extends OCIAPEX {

    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " ID AS \"idLocal\" "
                        . " , DESCR AS \"descrLocal\" "
                    . " FROM "
                        . " PORTARIA_LOCAL"
                    . " WHERE"
                        . " ID <> 0 "
                    . " ORDER BY DESCR ASC ";

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
        
    }
    
}
