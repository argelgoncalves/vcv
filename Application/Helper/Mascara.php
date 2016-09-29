<?php

namespace Application\Helper;

/**
 * Contém funções para criar e remover máscaras
 * Todas as funções são estáticas
 */
class Mascara {
    
    public static function removerMascaraCPF($cpf){
        return preg_replace('/[^0-9]/i', '', $cpf);
    }
    
    public static function formatDataUSA($data){
        $DFm = explode("/",$data);
        if(count($DFm) < 3){
            return "";
        }
        return $DFm[2].'-'.$DFm[1].'-'.$DFm[0];
    }
    
    public static function adicionarMascaraCPF($cpf){
        return Mascara::mask("###.###.###-##", $cpf);
    }
    
    public static function formatDataPTBR($data){
        if($data == ""){
            return "";
        }
        return date('d/m/Y',strtotime($data));
    }
    
    public static function mask($mask,$str){

        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }

        return $mask;

    }
}
