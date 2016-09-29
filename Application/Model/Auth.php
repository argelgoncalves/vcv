<?php

namespace Application\Model;

use Application\Model\DAO\UsuarioDAO;

/**
 * Gerencia a autenticação do sistema, trabalhando com sessao
 */
class Auth {

    private $nomeSessao = "auth";
    private $username;

    public function __construct() {
        if (isset($_SESSION[$this->nomeSessao])) {
            $auth = $_SESSION[$this->nomeSessao];
            $this->username = $auth['username'];
        }
    }

    public function isLogged() {
        return isset($_SESSION[$this->nomeSessao]);
    }
    
    public function getUsername(){
        
        if($this->username != null){
            return $this->username;
        }
        
        return "Convidado";
    }

    public function authenticate($usuario) {

        $usuarioDAO = new UsuarioDAO();
        if ($usuarioDAO->authenticate($usuario)) {
            $_SESSION[$this->nomeSessao] = array(
                "username" => $usuario->getNome()
            );
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        unset($_SESSION[$this->nomeSessao]);
    }

}
