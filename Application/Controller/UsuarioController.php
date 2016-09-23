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

            $this->parseToDatabase($usuario);

            if ($this->validarForm($usuario, false)) {
                $usuario->setSenha(md5($usuario->getSenha()));
                $usuarioDAO = new UsuarioDAO();

                if ($usuarioDAO->insert($usuario)) {
                    $this->addMensagemSessaoSucesso("Usuario cadastrado com Sucesso!");
                    $this->redirect("usuario/");
                } else {
                    $this->addMensagemErro("Ocorreu um erro ao cadastrar");
                    $this->parseToForm($usuario);
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
                $usuario = $usuarioDAO->selectById($id);

                if (count($usuario) > 0) {
                    if ($this->isPost()) {
                        $usuario = $this->getUsuarioFromForm();
                        $this->parseToDatabase($usuario);

                        if ($this->validarForm($usuario, true)) {
                            $this->setSenha(md5($usuario->getSenha()));
                            $usuarioDAO = new UsuarioDAO();

                            if ($usuarioDAO->update($usuario)) {
                                $this->addMensagemSessaoSucesso("Usuario alterado com Sucesso!");
                                $this->redirect("usuarios/");
                            }
                        }
                    }
                }
            }
        }
    }

    public function deletarAction() {
        
    }
    
    private function getUsuarioFromForm(){
        
    }
    
    private function validarForm($usuario, $alterar = false){
        
    }
    
    private function parseToDatabase(){
        
    }
    
    private function parseToForm(){
        
    }

}
