<?php

namespace Application\Model\DAO;

use Application\Helper\ConexaoBD;

abstract class AbstractDAO {

    private $tableName;
    private $identifier;

    public function __construct($_tableName, $_identifier) {
        $this->tableName = $_tableName;
        $this->identifier = $_identifier;
    }

    abstract public function insert($object);

    abstract function update($object);

    public function delete($id) {
        $bd = new ConexaoBD();
        $bd->conectar();

        $status = 0;

        if ($bd) {
            $sql = "DELETE FROM " . $this->tableName . " WHERE " . $this->identifier . " = " . $id;
            $status = mysql_query($sql);
        }

        $bd->desconectar();
        return $status;
    }

    public function selectById($id) {
        return $this->select($this->identifier . " = " . $id);
    }

    public function selectAll() {
        return $this->select("1");
    }

    public function select($where) {
        $bd = new ConexaoBD();
        $bd->conectar();

        $array_results = array();

        if ($bd) {
            $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $where;
            $results = mysql_query($sql);

            if ($results) {
                while ($row = mysql_fetch_array($results)) {
                    array_push($array_results, $row);
                }
            }
        }

        $bd->desconectar();
        return $array_results;
    }

    public function getCount($where = "1") {
        $bd = new ConexaoBD();
        $bd->conectar();

        $count = 0;

        if ($bd) {
            $sql = "SELECT COUNT(*) as total FROM " . $this->tableName . " WHERE " . $where;
            $result = mysql_query($sql);

            if ($result) {
                $count = mysql_fetch_array($result);
                $count = $count['total'];
            }
        }

        $bd->desconectar();
        return $count;
    }

}
