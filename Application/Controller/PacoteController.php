<?php

namespace Application\Controller;

use Application\Helper\Validacao;
use Application\Model\Pacote;
use Application\Model\DAO\PacoteDAO;

class PacoteController extends ApplicationController{
    
    public function __construct() {
        parent::__construct();
        $this->validarSessao();
    }

    public function cadastrarAction() {

        $pacote = new Pacote();
        
        if ($this->isPost()) {

            $pacote = $this->getPacoteFromForm();

            if ($this->validarForm($pacote, false)) {
                $pacoteDAO = new PacoteDAO();

                if ($newId = $pacoteDAO->insert($pacote)) {
                    
                    if($this->isImageUploaded("foto")){
                        $urlImagem = $this->uploadImage("foto");
                        
                        if($urlImagem){
                            $pacote->setId($newId);
                            $pacote->setURLFoto($urlImagem);
                            $pacoteDAO->update($pacote);
                        }
                    }
                    $this->addMensagemSessaoSucesso("Pacote cadastrado com Sucesso!");
                    $this->redirect("pacote/");
                } else {
                    $this->addMensagemErro("Ocorreu um erro ao cadastrar");
                }
            }
        }
        
        $this->pacote = $pacote;
    }

    public function indexAction() {
        $pacoteDAO = new PacoteDAO();
        $this->pacotes = $pacoteDAO->selectAll();
    }

    public function alterarAction() {
        if ($this->hasIndex("id")) {
            $id = intval($this->getIndex("id"));

            if ($id > 0) {
                $pacoteDAO = new PacoteDAO();
                $pacotes = $pacoteDAO->selectById($id);

                if (count($pacotes) > 0) {
                    $pacote = $pacotes[0];
                    
                    if ($this->isPost()) {

                        $auxPacote = $pacote;
                        $pacote = $this->getPacoteFromForm();
                        
                        if($pacote->getNome() == $pacotes[0]->getNome()){
                            $pacote->setId($auxPacote->getId());
                            $pacote->setURLFoto($auxPacote->getURLFoto());

                            if ($this->validarForm($pacote, true)) {
                                $pacoteDAO = new PacoteDAO();

                                if($this->isImageUploaded("foto")){
                                    $urlImagem = $this->uploadImage("foto");

                                    if($urlImagem){
                                        $pacote->setURLFoto($urlImagem);
                                    }
                                }

                                if ($pacoteDAO->update($pacote)) {
                                    $this->addMensagemSessaoSucesso("Pacote alterado com Sucesso!");
                                    $this->redirect("pacote/");
                                } else {
                                    $this->addMensagemErro("Ocorreu um erro ao alterar o pacote");
                                    $this->pacote = $pacote;
                                }
                            }
                        }else{
                            $this->addMensagemErro("Não é possível alterar o nome do pacote");
                            $pacote->setNome($pacotes[0]->getNome());
                            $this->pacote = $pacote;
                        }
                    }
                    
                    $this->pacote = $pacote;
                    
                } else {
                    $this->addMensagemSessaoErro("Pacote nao encontrado");
                    $this->redirect("pacote/");
                }
            } else {
                $this->addMensagemSessaoErro("Id invalido para pacote");
                $this->redirect("pacote/");
            }
        } else {
            $this->addMensagemSessaoErro("Id nao informado para alterar o pacote");
            $this->redirect("pacote/");
        }
    }

    public function deletarAction() {

        if ($this->hasIndex("id")) {
            $id = intval($this->getIndex("id"));

            if ($id > 0) {
                $pacoteDAO = new PacoteDAO();

                if ($pacoteDAO->delete($id)) {
                    $this->addMensagemSessaoSucesso("Pacote removido com sucesso!");
                } else {
                    $this->addMensagemSessaoErro("Nao foi possivel remover o pacote!");
                }
            } else {
                $this->addMensagemSessaoInfo("ID para pacote invalido!");
            }
        } else {
            $this->addMensagemSessaoInfo("ID não informado para remover pacote!");
        }

        $this->redirect("pacote/");
    }

    private function getPacoteFromForm() {
        $form = $this->getForm();
        
        $pacote = new Pacote();

        $pacote->setNome($form['nome']);
        $pacote->setDescricao($form['descricao']);
        $pacote->setValor(str_replace("R$ ", "", $form['valor']));
        
        return $pacote;
    }

    private function validarForm($pacote, $atualizar = false) {

        $sucesso = true;

        if (strlen($pacote->getNome()) < 3) {
            $sucesso = false;
            $this->addMensagemErro("Nome do Pacote deve ter pelo menos 3 caracteres!");
        }else if (!$atualizar) {
            $pacoteDAO = new PacoteDAO();
            if ($pacoteDAO->exists($pacote)) {
                $sucesso = false;
                $this->addMensagemErro("Nome de pacote ja cadastrado");
            }
        }

        if(strlen($pacote->getDescricao()) < 10){
            $sucesso = false;
            $this->addMensagemErro("Descrição muito curta");
        }

        return $sucesso;
    }

}
