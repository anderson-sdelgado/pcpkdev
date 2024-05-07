<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of AtualizaAplicDAO
 *
 * @author anderson
 */
class AtualAplicDAO extends OCI {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function verAtual($nroAparelho) {

        $select = "SELECT "
                    . " COUNT(*) AS QTDE "
                . " FROM "
                    . " PCP_ATUAL "
                . " WHERE "
                    . " NRO_APARELHO = " . $nroAparelho;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;

    }
    
    public function idAtual($nroAparelho) {

        $select = "SELECT "
                    . " ID AS ID "
                . " FROM "
                    . " PCP_ATUAL "
                . " WHERE "
                    . " NRO_APARELHO = " . $nroAparelho;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'ID');
        }

        oci_free_statement($stid);
        return $v;

    }
    
    public function verToken($token) {

        $select = "SELECT "
                    . " COUNT(*) AS QTDE "
                . " FROM "
                    . " PCP_ATUAL "
                . " WHERE "
                    . " TOKEN = '" . $token . "'";

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;
    }

    public function insAtual($nroAparelho, $versao) {

        $sql = "INSERT INTO PCP_ATUAL ("
                        . " NRO_APARELHO "
                        . " , VERSAO "
                        . " , DTHR_ULT_ACESSO "
                        . " , TOKEN "
                    . " ) "
                    . " VALUES ("
                        . " :nroAparelho "
                        . " , :versao "
                        . " , SYSDATE "
                        . " , :token "
                    . " )";

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        $token = strtoupper(md5('PCP-VERSAO_' . $versao . '-' . $nroAparelho));
        oci_bind_by_name($result, ":token", $token);
        oci_bind_by_name($result, ":versao", $versao);
        oci_bind_by_name($result, ":nroAparelho", $nroAparelho);
        oci_execute($result);
    }

    public function updAtual($nroAparelho, $versao) {

        $sql = "UPDATE PCP_ATUAL SET "
                    . " VERSAO = :versao"
                    . " , DTHR_ULT_ACESSO = SYSDATE "
                    . " , TOKEN = :token"
                . " WHERE "
                    . " NRO_APARELHO = :nroAparelho";

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        $token = strtoupper(md5('PCP-VERSAO_' . $versao . '-' . $nroAparelho));
        oci_bind_by_name($result, ":token", $token);
        oci_bind_by_name($result, ":versao", $versao);
        oci_bind_by_name($result, ":nroAparelho", $nroAparelho);
        oci_execute($result);
    }

}
