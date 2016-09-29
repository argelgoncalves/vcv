<?php

namespace Application\Controller;

use Application\Model\Auth;
use Application\Model\Usuario;

class LoginController extends ApplicationController {

    public function __construct() {
        parent::__construct();
    }

    public function indexAction() {

        $auth = new Auth();

        if ($auth->isLogged()) {
            $this->redirect("dashboard/");
        }

        if ($this->isPost()) {
            $usuario = $this->getUsuarioFromForm();

            if ($this->validarForm($usuario)) {

                if ($auth->authenticate($usuario)) {
                    $this->redirect("dashboard/");
                } else {
                    $this->addMensagemErro("Usuario ou senha incorretos!");
                }
            }
        }
    }

    public function logoutAction() {
        $auth = new Auth();
        $auth->logout();
        $this->addMensagemSessaoSucesso("Logout realizado com sucesso!");
        $this->redirect("login/");
    }

    private function validarForm($usuario) {

        $sucesso = true;

        if (strlen($usuario->getNome()) < 3) {
            $this->addMensagemErro("Usuario Invalido");
            $sucesso = false;
        }

        if (strlen($usuario->getSenha()) < 6) {
            $this->addMensagemErro("Senha Invalida");
            $sucesso = false;
        }

        return $sucesso;
    }

    private function getUsuarioFromForm() {
        $form = $this->getForm();
        $usuario = new Usuario();
        $usuario->setNome($form['login']);
        $usuario->setSenha($form['senha']);
        return $usuario;
    }

}
