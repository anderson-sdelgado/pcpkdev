<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of VisitanteDAO
 *
 * @author anderson
 */
class VisitanteDAO extends OCI {

    private $Conn;

    public function dados() {

        $select = " SELECT " 
                            . " V.VISITANTES_ID AS \"idVisitante\" "
                            . " , DECODE(V.CD_IDENT, NULL, PK_SF_UTIL.FKG_MASCARA_CPF(V.CPF), V.CD_IDENT) AS \"cpfVisitante\" "
                            . " , V.NOM_VIS AS \"nomeVisitante\" "
                            . " , EV.NOME AS \"empresaVisitante\" "
                        . " FROM "
                            . " VISITANTES V "
                            . " , EMPR_VISITA EV "
                        . " WHERE "
                            . " V.EMPRVISITA_ID = EV.EMPRVISITA_ID ";

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
        
    }
    
}
