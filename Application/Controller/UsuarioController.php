<?php

namespace Application\Controller;

use Application\Model\Usuario;
use Application\Model\DAO\UsuarioDAO;

class UsuarioController extends ApplicationController {

    public function __construct() {
        parent::__construct();
        $this->validarSessao();
    }

    public function cadastrarAction() {

        $usuario = new Usuario();

        if ($this->isPost()) {
            $usuario = $this->getUsuarioFromForm();

            if ($this->validarForm($usuario, false)) {
                $usuario->setSenha(md5($usuario->getSenha()));
                $usuarioDAO = new UsuarioDAO();

                if ($usuarioDAO->insert($usuario)) {
                    $this->addMensagemSessaoSucesso("Usuario cadastrado com Sucesso!");
                    $this->redirect("usuario/");
                } else {
                    $this->addMensagemErro("Ocorreu um erro ao cadastrar");
                }
            }
        }

        $this->usuario = $usuario;
    }

    public function indexAction() {
        $usuarioDAO = new UsuarioDAO();
        $this->usuarios = $usuarioDAO->selectAll();
    }

    public function alterarAction() {
        if ($this->hasIndex("id")) {
            $id = intval($this->getIndex("id"));

            if ($id > 0) {
                $usuarioDAO = new UsuarioDAO();
                $usuarios = $usuarioDAO->selectById($id);

                if (count($usuarios) > 0) {
                    if ($this->isPost()) {
                        $usuario = $this->getUsuarioFromForm();
                        $usuario->setId($id);

                        if ($this->validarForm($usuario, true)) {
                            $usuario->setSenha(md5($usuario->getSenha()));
                            $usuarioDAO = new UsuarioDAO();

                            if ($usuarioDAO->update($usuario)) {
                                $this->addMensagemSessaoSucesso("Usuario alterado com sucesso!");
                                $this->redirect("usuario/");
                            }else{
                                $this->addMensagemErro("Não foi possível alterar o usuário");
                                 $this->usuario = $usuario;
                            }
                        }else{
                            $this->usuario = $usuario;
                        }
                    } else {
                        $this->usuario = $usuarios[0];
                    }
                } else {
                    $this->addMensagemSessaoErro("Usuário nao encontrado");
                    $this->redirect("usuario/");
                }
            } else {
                $this->addMensagemSessaoErro("Id invalido para usuário");
                $this->redirect("usuario/");
            }
        } else {
            $this->addMensagemSessaoErro("Id nao informado para alterar o usuário");
            $this->redirect("usuario/");
        }
    }

    public function deletarAction() {
        if ($this->hasIndex("id")) {
            $id = intval($this->getIndex("id"));

            if ($id > 0) {
                $usuarioDAO = new UsuarioDAO();

                if ($usuarioDAO->delete($id)) {
                    $this->addMensagemSessaoSucesso("Usuario removido com sucesso!");
                } else {
                    $this->addMensagemSessaoErro("Nao foi possivel remover o usuário!");
                }
            } else {
                $this->addMensagemSessaoInfo("ID para usuário invalido!");
            }
        } else {
            $this->addMensagemSessaoInfo("ID Nao informado para remover usuário!");
        }

        $this->redirect("usuario/");
    }

    private function getUsuarioFromForm() {
        $form = $this->getForm();
        $usuario = new Usuario();
        $usuario->setNome($form['nome']);
        $usuario->setSenha($form['senha']);
        return $usuario;
    }

    private function validarForm($usuario, $alterando = false) {

        $sucesso = true;

        if (strlen($usuario->getNome()) < 3) {
            $sucesso = false;
            $this->addMensagemErro("Nome do Usuário deve ter pelo menos 3 caracteres!");
        } else if(!$alterando){
            $usuarioDAO = new UsuarioDAO();
            if ($usuarioDAO->exists($usuario)) {
                $sucesso = false;
                $this->addMensagemErro("Nome do Usuário já existe!");
            }
        }

        if (strlen($usuario->getSenha()) < 6) {
            $sucesso = false;
            $this->addMensagemErro("Senha inválida");
        }

        return $sucesso;
    }

}
