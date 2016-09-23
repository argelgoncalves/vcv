<?php

namespace Application\Controller;

use Application\Model\Pacote;
use Application\Model\DAO\PacoteDAO;

class PacoteController extends PacoteController{
    
    public function __construct() {
        parent::__construct();
        $this->validarSessao();
    }

    public function cadastrarAction() {

        $pacote = new Pacote();

        $pacote->setNome("Porto Seguro");
        $pacote->setDescricao("A puta que pariuowowow");
        $pacote->setURLFoto("o caralho a quatro");
        $pacote->setValor(400.45);

        if (PacoteDAO::cadastrar($pacote)) {
            echo "cadastrou<br />";
        } else {
            echo "nao foi<br />";
        }
    }

    public function indexAction() {
        
    }

    public function alterarAction() {
        
    }

    public function deletarAction() {
        
    }

}
