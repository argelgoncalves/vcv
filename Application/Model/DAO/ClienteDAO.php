<?php

namespace Application\Model\DAO;

use Application\Helper\ConexaoBD;
use Application\Helper\Mascara;
use Application\Model\Cliente;


class ClienteDAO extends AbstractDAO {

    const TABELA = "cli_clientes";
    const ID = "cli_id";
    const NOME = "cli_nome";
    const CPF = "cli_cpf";
    const NASCIMENTO = "cli_nascimento";
    const SEXO = "cli_sexo";
    const EMAIL = "cli_email";
    const SENHA = "cli_senha";

    public function __construct() {
        parent::__construct(self::TABELA, self::ID);
    }

    public function insert($cliente) {

        $bd = new ConexaoBD();
        $bd->conectar();
        
        $ultimoId = 0;

        if ($bd) {
            $sql = "INSERT INTO " . self::TABELA . " VALUES ("
                    . "NULL, "
                    . "'" . $cliente->getNome() . "', "
                    . "'" . $cliente->getCpf() . "', "
                    . "'" . $cliente->getNascimento() . "', "
                    . "'" . $cliente->getSexo() . "', "
                    . "'" . $cliente->getEmail() . "', "
                    . "'" . $cliente->getSenha() . "'"
                    . ");";
            
            if (mysqli_query($bd->getConexao(), $sql)) {
                $ultimoId = mysqli_insert_id($bd->getConexao());
            }
        }

        $bd->desconectar();
        return $ultimoId;
    }

    public function update($cliente) {

        $bd = new ConexaoBD();
        $bd->conectar();
        
        $status = 0;

        if ($bd) {
            $sql = "UPDATE " .self::TABELA. " SET "
                    .self::NOME. " = '" . $cliente->getNome() . "', "
                    .self::CPF. " = '" . $cliente->getCpf() . "', "
                    .self::NASCIMENTO. " = '" . $cliente->getNascimento() . "', "
                    .self::SEXO. " = '" . $cliente->getSexo() . "', "
                    .self::EMAIL. " = '" . $cliente->getEmail() . "', "
                    .self::SENHA. " = '" . $cliente->getSenha() . "'"
                    . " WHERE " .self::ID. " = " . $cliente->getID();

            $status = mysqli_query($bd->getConexao(), $sql);
        }

        $bd->desconectar();
        return $status;
    }

    public function select($where = "1") {
        
        $clientes = array();

        foreach (parent::select($where) as $row) {
            $cliente = new Cliente();
            $cliente->setId($row[0]);
            $cliente->setNome($row[1]);
            $cliente->setCpf(Mascara::adicionarMascaraCPF($row[2]));
            $cliente->setNascimento(Mascara::formatDataPTBR($row[3]));
            $cliente->setSexo($row[4]);
            $cliente->setEmail($row[5]);
            $cliente->setSenha($row[6]);

            array_push($clientes, $cliente);
        }

        return $clientes;
    }

    public function hasCPF($cpf) {
        return parent::getCount(ClienteDAO::CPF. " LIKE '" . $cpf . "'") > 0;
    }
    
    public function hasEmail($email){
        return parent::getCount(ClienteDAO::EMAIL. " LIKE '" . $email . "'") > 0;
    }
}
