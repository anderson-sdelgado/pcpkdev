<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/OCIAPEX.class.php');
/**
 * Description of MovEquipProprioDAO
 *
 * @author anderson
 */
class MovEquipProprioDAO extends OCIAPEX {

    public function verifMovEquip($movEquip) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PORTARIA_MOV_EQUIP_PROPRIO "
                    . " WHERE "
                        . " DTHR_CEL = TO_DATE('" . $movEquip->dthrMovEquipProprio . "','DD/MM/YYYY HH24:MI')"
                        . " AND "
                        . " EQUIP_ID = " . $movEquip->idEquipMovEquipProprio
                        . " AND "
                        . " CEL_ID = " . $movEquip->idMovEquipProprio;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;
        
    }

    public function idMovEquip($movEquip) {

        $select = " SELECT "
                        . " ID AS ID "
                    . " FROM "
                        . " PORTARIA_MOV_EQUIP_PROPRIO "
                    . " WHERE "
                        . " DTHR_CEL = TO_DATE('" . $movEquip->dthrMovEquipProprio . "' , 'DD/MM/YYYY HH24:MI')"
                        . " AND "
                        . " EQUIP_ID = " . $movEquip->idEquipMovEquipProprio
                        . " AND "
                        . " CEL_ID = " . $movEquip->idMovEquipProprio;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'ID');
        }

        oci_free_statement($stid);
        return $v;
        
    }

    public function insMovEquip($movEquip) {

        $sql = "INSERT INTO PORTARIA_MOV_EQUIP_PROPRIO ("
                            . " DTHR "
                            . " , DTHR_CEL "
                            . " , DTHR_TRANS "
                            . " , TIPO "
                            . " , EQUIP_ID "
                            . " , LOCAL_ID "
                            . " , MATRIC_RESP "
                            . " , MATRIC_COLAB "
                            . " , DESTINO "
                            . " , NOTA_FISCAL "
                            . " , OBSERVACAO "
                            . " , CEL_ID "
                            . " , NRO_APARELHO "
                        . " ) "
                        . " VALUES ("
                            . " TO_DATE(:dthr , 'DD/MM/YYYY HH24:MI')"
                            . " , TO_DATE(:dthr , 'DD/MM/YYYY HH24:MI')"
                            . " , SYSDATE "
                            . " , :tipo "
                            . " , :idEquip "
                            . " , :idLocal "
                            . " , :matricVigia "
                            . " , :matricColab "
                            . " , :destino "
                            . " , :nroNF "
                            . " , :observacao "
                            . " , :idCel "
                            . " , :nroAparelho "
                        . " )";

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_bind_by_name($result, ":dthr", $movEquip->dthrMovEquipProprio);
        oci_bind_by_name($result, ":tipo", $movEquip->tipoMovEquipProprio);
        oci_bind_by_name($result, ":idLocal", $movEquip->idLocalMovEquipProprio);
        oci_bind_by_name($result, ":idEquip", $movEquip->idEquipMovEquipProprio);
        oci_bind_by_name($result, ":matricVigia", $movEquip->nroMatricVigiaMovEquipProprio);
        oci_bind_by_name($result, ":matricColab", $movEquip->nroMatricColabMovEquipProprio);
        oci_bind_by_name($result, ":destino", $movEquip->destinoMovEquipProprio);
        oci_bind_by_name($result, ":nroNF", $movEquip->nroNotaFiscalMovEquipProprio);
        oci_bind_by_name($result, ":observacao", $movEquip->observMovEquipProprio);
        oci_bind_by_name($result, ":idCel", $movEquip->idMovEquipProprio);
        oci_bind_by_name($result, ":nroAparelho", $movEquip->nroAparelhoMovEquipProprio);
        oci_execute($result);
        
    }

}
