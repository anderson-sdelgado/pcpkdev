<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/AtualAplicDAO.class.php');
/**
 * Description of AtualAplicativoCTR
 *
 * @author anderson
 */
class AtualAplicCTR {
    
    public function inserirDados($body){
        
        $config = json_decode($body);
        return $this->inserirAtualVersao($config->nroAparelho, $config->version);
        
    }
    
    public function inserirAtualVersao($nroAparelho, $versao) {
        $atualAplicDAO = new AtualAplicDAO();
        $v = $atualAplicDAO->verAtual($nroAparelho);
        if ($v == 0) {
            $atualAplicDAO->insAtual($nroAparelho, $versao);
        } else {
            $atualAplicDAO->updAtual($nroAparelho, $versao);
        }
        $id = $atualAplicDAO->idAtual($nroAparelho);
        return array("idBD" => $id);
    }

    public function verifToken($info){
        
        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $token = $d->token;
        }
        
        $atualAplicDAO = new AtualAplicDAO();
        $v = $atualAplicDAO->verToken($token);
        
        if ($v > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function verToken($headers){
        
        $token = trim(substr($headers['Authorization'], 6));
        $atualAplicDAO = new AtualAplicDAO();
        $v = $atualAplicDAO->verToken($token);
        if ($v > 0) {
            return true;
        } else {
            return false;
        }
        
    }
}
