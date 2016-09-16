<?php

namespace Application\Model\DAO;

use Application\Helper\ConexaoBD;
use Application\Model\Usuario;

class UsuarioDAO extends AbstractDAO {

    const TABELA = "usr_usuarios";
    const ID = "usr_id";
    const NOME = "usr_nome";
    const SENHA = "usr_senha";

    public function __construct() {
        parent::__construct(self::TABELA, self::ID);
    }

    public function insert($usuario) {

        $bd = new ConexaoBD();
        $bd->conectar();

        $ultimoId = 0;

        if ($bd) {
            $sql = "INSERT INTO " . self::TABELA . " VALUES ("
                    . "NULL, "
                    . "'" . $usuario->getNome() . "', "
                    . "'" . $usuario->getSenha() . "'"
                    . ")";

            if (mysql_query($sql)) {
                $ultimoId = mysql_insert_id();
            }
        }

        $bd->desconectar();
        return $ultimoId;
    }

    public function update($usuario) {


        $bd = new ConexaoBD();
        $bd->conectar();

        if ($bd) {
            $sql = "UPDATE " . self::TABELA . " SET "
                    . self::NOME . " = '" . $usuario->getNome() . "', "
                    . self::SENHA . " = '" . $usuario->getSenha() . "'"
                    . " WHERE " . self::ID . " = " . $usuario->getID();

            if (mysql_query($sql)) {
                $bd->desconectar();
                return 1;
            }
        }

        $bd->desconectar();
        return 0;
    }

    public function select($where) {
        $usuarios = array();

        foreach (parent::select($where) as $row) {
            $usuario = new Usuario();
            $usuario->setId($row[0]);
            $usuario->setNome($row[1]);
            $usuario->setSenha($row[2]);
            array_push($usuarios, $usuario);
        }

        return $usuario;
    }

    public function exists($usuario) {
        return parent::getCount(self::NOME . " LIKE '" . $usuario->getNome() . "' AND " . self::SENHA . " LIKE '" . md5($usuario->getSenha()) . "'") == 1;
    }

}
