<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of ColabDAO
 *
 * @author anderson
 */
class ColabDAO extends OCI {

    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " COLAB.CD AS \"matricColab\" "
                        . " , CORR.NOME AS \"nomeColab\" "
                    . " FROM "
                        . " COLAB COLAB "
                        . " , CORR CORR "
                        . " , REG_DEMIS DEM "
                    . " WHERE"
                        . " COLAB.EMPRUSU_ID = 1 "
                        . " AND "
                        . " DEM.COLAB_ID IS NULL "
                        . " AND " 
                        . " COLAB.COLAB_ID = DEM.COLAB_ID(+) "
                        . " AND "
                        . " COLAB.CORR_ID = CORR.CORR_ID "
                    . " ORDER BY COLAB.CD ASC ";

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
        
    }
    
}
