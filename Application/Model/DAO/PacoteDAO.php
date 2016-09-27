<?php

namespace Application\Model\DAO;

use Application\Helper\ConexaoBD;
use Application\Model\Pacote;

class PacoteDAO extends AbstractDAO {

    const TABELA = "pac_pacotes";
    const ID = "pac_id";
    const NOME = "pac_nome";
    const DESCRICAO = "pac_descricao";
    const URL_FOTO = "pac_url_foto";
    const VALOR = "pac_valor";

    public function __construct() {
        parent::__construct(self::TABELA, self::ID);
    }
    
    public function insert($pacote) {

        $bd = new ConexaoBD();
        $bd->conectar();
        
        $ultimoId = 0;

        if ($bd) {
            $sql = "INSERT INTO " . self::TABELA . " VALUES ("
                    . "NULL, "
                    . "'" . $pacote->getNome() . "', "
                    . "'" . $pacote->getDescricao() . "', "
                    . "'" . $pacote->getURLFoto() . "', "
                    . $pacote->getValor()
                    . ");";

            if (mysql_query($sql)) {
                $ultimoId = mysql_insert_id();
            }
        }

        $bd->desconectar();
        return $ultimoId;
    }

    public function update($pacote) {

        $bd = new ConexaoBD();
        $bd->conectar();

        $status = 0;
        
        if ($bd) {
            $sql = "UPDATE " . self::TABELA . " SET "
                    . self::NOME . " = '" . $pacote->getNome() . "', "
                    . self::DESCRICAO . " = '" . $pacote->getDescricao() . "', "
                    . self::URL_FOTO . " = '" . $pacote->getURLFoto() . "', "
                    . self::VALOR . " = " . $pacote->getValor() . ""
                    . " WHERE " . self::ID . " = " . $pacote->getID();

            $status = mysql_query($sql);
        }

        $bd->desconectar();
        return $status;
    }

    public function select($where) {
        $pacotes = array();

        foreach(parent::select($where) as $row) {
            $pacote = new Pacote();
            $pacote->setId($row[0]);
            $pacote->setNome($row[1]);
            $pacote->setDescricao($row[2]);
            $pacote->setURLFoto($row[3]);
            $pacote->setValor($row[4]);

            array_push($pacotes, $pacote);
        }

        return $pacotes;
    }
    
    public function exists($pacote) {
        return parent::getCount(self::NOME . " LIKE '" . $pacote->getNome(). "'") > 0;
    }

}
