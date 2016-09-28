<?php

namespace Application\Model\DAO;

use Application\Helper\ConexaoBD;

/**
 * Manipula os dados do banco de dados
 * Tem as funções para manipulação de um modo geral, sendo necessária 
 * implementar as funções de insert e update 
 */
abstract class AbstractDAO {

    private $tableName;
    private $identifier;

    /**
     * Registra o nome e o identificador da tabela
     * @param string $_tableName Nome da tabela
     * @param string $_identifier Identificador da tabela
     */    
    public function __construct($_tableName, $_identifier) {
        $this->tableName = $_tableName;
        $this->identifier = $_identifier;
    }

    /**
     * Insere um novo registro na tabela
     * Necessário implementar
     */
    abstract public function insert($object);

    /**
     * Realiza uma alteração em um registro na tabela
     * Necessário implementar
     */
    abstract public function update($object);

    /**
     * Deleta um registro da tabela
     * @param int $id valor do identificador do registro
     */
    public function delete($id) {
        $bd = new ConexaoBD();
        $bd->conectar();

        $status = 0;

        if ($bd) {
            $sql = "DELETE FROM " . $this->tableName . " WHERE " . $this->identifier . " = " . $id;
            $status = mysqli_query($bd->getConexao(), $sql);
        }

        $bd->desconectar();
        return $status;
    }

    /**
     * Retorna o registro da tabela com o id desejado
     * @param int $id valor do identificador do registro
     * @return array
     */
    public function selectById($id) {
        return $this->select($this->identifier . " = " . $id);
    }

    /**
     * Retorna todos os registros da tabela
     * @return array
     */
    public function selectAll() {
        return $this->select("1");
    }

    /**
     * Retorna todos os registros da tabela com a condiçao desejada
     * @param string $where condicional da consulta
     * @return array
     */
    public function select($where) {
        $bd = new ConexaoBD();
        $bd->conectar();

        $array_results = array();

        if ($bd) {
            $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $where;
            $results = mysqli_query($bd->getConexao(), $sql);

            if ($results) {
                while ($row = mysqli_fetch_array($results)) {
                    array_push($array_results, $row);
                }
            }
        }

        $bd->desconectar();
        return $array_results;
    }

    /**
     * Retorna q quantidade de registro da tabela
     * @param string condicional da consulta
     * @return int
     */
    public function getCount($where = "1") {
        $bd = new ConexaoBD();
        $bd->conectar();

        $count = 0;

        if ($bd) {
            $sql = "SELECT COUNT(*) as total FROM " . $this->tableName . " WHERE " . $where;
            $result = mysqli_query($bd->getConexao(), $sql);

            if ($result) {
                $count = mysqli_fetch_array($result);
                $count = $count['total'];
            }
        }

        $bd->desconectar();
        return $count;
    }

}
