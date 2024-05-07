<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/OCIAPEX.class.php');
/**
 * Description of MovEquipVisitTercDAO
 *
 * @author anderson
 */
class MovEquipResidenciaDAO extends OCIAPEX {

    public function verifMovEquip($movEquip) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PORTARIA_MOV_EQUIP_RESIDENCIA "
                    . " WHERE "
                        . " DTHR_CEL = TO_DATE('" . $movEquip->dthrMovEquipResidencia . "','DD/MM/YYYY HH24:MI')"
                        . " AND "
                        . " TIPO = " . $movEquip->tipoMovEquipResidencia
                        . " AND "
                        . " CEL_ID = " . $movEquip->idMovEquipResidencia;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;
    }

    public function insMovEquip($movEquip) {

        $sql = "INSERT INTO PORTARIA_MOV_EQUIP_RESIDENCIA ("
                                        . " DTHR "
                                        . " , DTHR_CEL "
                                        . " , DTHR_TRANS "
                                        . " , TIPO "
                                        . " , LOCAL_ID "
                                        . " , MATRIC_RESP "
                                        . " , NOME_VISITANTE "
                                        . " , VEICULO "
                                        . " , PLACA "
                                        . " , OBSERVACAO "
                                        . " , CEL_ID "
                                        . " , NRO_APARELHO "
                                    . " )"
                                    . " VALUES ("
                                        . " TO_DATE(:dthr , 'DD/MM/YYYY HH24:MI')"
                                        . " , TO_DATE(:dthr , 'DD/MM/YYYY HH24:MI')"
                                        . " , SYSDATE "
                                        . " , :tipo "
                                        . " , :idLocal "
                                        . " , :matricVigia "
                                        . " , :nomeVisitante "
                                        . " , :veiculo "
                                        . " , :placa "
                                        . " , :observacao "
                                        . " , :idCel "
                                        . " , :nroAparelho "
                                    . " )";
        
        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_bind_by_name($result, ":dthr", $movEquip->dthrMovEquipResidencia);
        oci_bind_by_name($result, ":tipo", $movEquip->tipoMovEquipResidencia);
        oci_bind_by_name($result, ":idLocal", $movEquip->idLocalMovEquipResidencia);
        oci_bind_by_name($result, ":matricVigia", $movEquip->nroMatricVigiaMovEquipResidencia);
        oci_bind_by_name($result, ":nomeVisitante", $movEquip->nomeVisitanteMovEquipResidencia);
        oci_bind_by_name($result, ":veiculo", $movEquip->veiculoMovEquipResidencia);
        oci_bind_by_name($result, ":placa", $movEquip->placaMovEquipResidencia);
        oci_bind_by_name($result, ":observacao", $movEquip->observMovEquipResidencia);
        oci_bind_by_name($result, ":idCel", $movEquip->idMovEquipResidencia);
        oci_bind_by_name($result, ":nroAparelho", $movEquip->nroAparelhoMovEquipResidencia);
        oci_execute($result);
        
    }

}
