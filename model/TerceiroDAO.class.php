<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of TerceiroDAO
 *
 * @author anderson
 */
class TerceiroDAO extends OCI {

    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                                . " CO.CORR_ID AS \"idBDTerceiro\" "
                                . " , PK_SF_UTIL.FKG_MASCARA_CPF(PF.NRO_CPF) AS \"cpfTerceiro\" "
                                . " , CO.NOME AS \"nomeTerceiro\" "
                                . " , CO2.NOME AS \"empresaTerceiro\" "
                            . " FROM "
                                . " CONTRATO_DIVERSO  CD "
                                . " , CONTR_DIV_PESSOAS CDP "
                                . " , PESSOAS           PE "
                                . " , CORR              CO "
                                . " , REG_DEM_PESSOA    RD "
                                . " , CORR_PF           CP "
                                . " , PF                PF "
                                . " , FORN              FO "
                                . " , CORR              CO2 "
                            . " WHERE "
                                . " SYSDATE BETWEEN CD.DATA_INICIAL AND CD.DATA_FINAL "
                                . " AND "
                                . " CDP.CONTRDIVER_ID = CD.CONTRDIVER_ID "
                                . " AND "
                                . " PE.PESSOAS_ID     = CDP.PESSOAS_ID "
                                . " AND "
                                . " CO.CORR_ID        = PE.CORR_ID "
                                . " AND "
                                . " CP.CORR_ID        = CO.CORR_ID "
                                . " AND "
                                . " PF.PF_ID          = CP.PF_ID "
                                . " AND "
                                . " CD.FORN_ID        = FO.FORN_ID "
                                . " AND "
                                . " FO.CORR_ID        = CO2.CORR_ID "
                                . " AND "
                                . " RD.PESSOAS_ID(+)  = PE.PESSOAS_ID "
                                . " AND "
                                . " RD.DT IS NULL "
                                . " ORDER BY CO.NOME ASC ";

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
        
    }
    
}
