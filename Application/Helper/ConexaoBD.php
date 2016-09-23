<?php

namespace Application\Helper;

/**
 * Gerencia a conexão com o banco de dados
 */
class ConexaoBD {

    private $conexao;

    public function conectar() {
        if ($this->conexao == null) {
            $this->conexao = mysql_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD) or print (mysql_error());
            mysql_select_db(DATABASE_NAME, $this->conexao) or print(mysql_error());
        }
    }

    public function desconectar() {
        mysql_close($this->conexao);
    }

}
