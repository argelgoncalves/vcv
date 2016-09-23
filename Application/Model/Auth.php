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
            $username = $auth['username'];
        }
    }

    public function isLogado() {
        return isset($_SESSION[$this->nomeSessao]);
    }

    public function isValidLogin($usuario) {

        $usuarioDAO = new UsuarioDAO();
        if ($usuarioDAO->exists($usuario)) {
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
