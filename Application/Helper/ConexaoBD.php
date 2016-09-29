<?php

namespace Application\Helper;

/**
 * Gerencia a conexão com o banco de dados
 */
class ConexaoBD {

    private $conexao;

    public function conectar() {
        if ($this->conexao == null) {
            $this->conexao = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD) or print (mysql_error());
            mysqli_select_db($this->conexao, DATABASE_NAME) or print(mysql_error());
        }
    }

    public function desconectar() {
        mysqli_close($this->conexao);
    }
    
    public function getConexao(){
        if($this->conexao == null){
            $this->conectar();
        }
        
        return $this->conexao;
    }

}
