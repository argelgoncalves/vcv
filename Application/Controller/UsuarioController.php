<?php

namespace Application\Controller;

use Application\Model\Usuario;
use Application\Model\DAO\UsuarioDAO;

class UsuarioController {
    
    public function __construct() {
        parent::__construct();
        $this->validarSessao();
    }

    public function cadastrarAction() {

        $usuario = new Usuario();

        $usuario->setNome("lucas");
        $usuario->setSenha(md5("123456"));


        if (UsuarioDAO::cadastrar($usuario)) {
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
