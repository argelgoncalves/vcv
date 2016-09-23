<?php

namespace Application\Helper;

/**
 * Contém funções para validar dados
 * Todas as funções são estáticas
 */
class Validacao {

    public static function validarCPF($cpf = null) {

        if (empty($cpf)) {
            return false;
        }

        $cpf = ereg_replace('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        } else if ($cpf == '00000000000' ||
                $cpf == '11111111111' ||
                $cpf == '22222222222' ||
                $cpf == '33333333333' ||
                $cpf == '44444444444' ||
                $cpf == '55555555555' ||
                $cpf == '66666666666' ||
                $cpf == '77777777777' ||
                $cpf == '88888888888' ||
                $cpf == '99999999999') {
            return false;
        } else {
            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    public static function validarData($data = null) {
        
        if(empty($data)){
            return false;
        }
        
        $array_data = explode("-", $data);
        
        if(count($array_data) != 3){
            return false;
        }
        
        return checkdate($array_data[1], $array_data[2], $array_data[0]);
    }

    public static function validaEmail($email) {
        $conta = "^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$";
        $pattern = $conta . $domino . $extensao;

        return ereg($pattern, $email);
    }

}
