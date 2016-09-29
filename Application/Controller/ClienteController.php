<?php

namespace Application\Controller;

use Application\Model\Cliente;
use Application\Model\DAO\ClienteDAO;
use Application\Helper\Validacao;
use Application\Helper\Mascara;

class ClienteController extends ApplicationController {

    public function __construct() {
        parent::__construct();
        $this->validarSessao();
    }

    public function cadastrarAction() {

        $cliente = new Cliente();
        
        if ($this->isPost()) {

            $cliente = $this->getClienteFromForm();

            $this->parseToDatabase($cliente);

            if ($this->validarForm($cliente, false)) {
                $cliente->setSenha(md5($cliente->getSenha()));
                $clienteDAO = new ClienteDAO();

                if ($clienteDAO->insert($cliente)) {
                    $this->addMensagemSessaoSucesso("Cliente cadastrado com Sucesso!");
                    $this->redirect("cliente/");
                } else {
                    $this->addMensagemErro("Ocorreu um erro ao cadastrar");
                }
            }
        }
        $this->parseToForm($cliente);
        $this->cliente = $cliente;
    }

    public function indexAction() {
        $clienteDAO = new ClienteDAO();
        $this->clientes = $clienteDAO->selectAll();
    }

    public function alterarAction() {
        if ($this->hasIndex("id")) {
            $id = intval($this->getIndex("id"));

            if ($id > 0) {
                $clienteDAO = new ClienteDAO();
                $clientes = $clienteDAO->selectById($id);

                if (count($clientes) > 0) {
                    if ($this->isPost()) {

                        $cliente = $this->getClienteFromForm();
                        $cliente->setId($id);
                        if($cliente->getCpf() == $clientes[0]->getCpf()){
                        
                            if($cliente->getEmail() == $clientes[0]->getEmail() &&
                                    md5($cliente->getSenha()) == $clientes[0]->getSenha()){

                                $this->parseToDatabase($cliente);

                                if ($this->validarForm($cliente, true)) {
                                    $cliente->setId($id);
                                    $cliente->setSenha(md5($cliente->getSenha()));
                                    $clienteDAO = new ClienteDAO();

                                    if ($clienteDAO->update($cliente)) {
                                        $this->addMensagemSessaoSucesso("Cliente alterado com Sucesso!");
                                        $this->redirect("cliente/");
                                    } else {
                                        $this->addMensagemErro("Ocorreu um erro ao alterar");
                                        $this->parseToForm($cliente);
                                        $this->cliente = $cliente;
                                    }
                                }
                            }else{
                                $this->addMensagemErro("Email ou senha inválidos");
                                $cliente->setEmail($clientes[0]->getEmail());
                                $this->cliente = $cliente;
                            }
                        }else{
                            $this->addMensagemErro("CPF não pode ser alterado");
                            $cliente->setEmail($clientes[0]->getEmail());
                            $cliente->setCpf($clientes[0]->getCpf());
                            $this->cliente = $cliente;
                        }
                    } else {
                        $this->cliente = $clientes[0];
                    }
                } else {
                    $this->addMensagemSessaoErro("Cliente nao encontrado");
                    $this->redirect("cliente/");
                }
            } else {
                $this->addMensagemSessaoErro("Id invalido para cliente");
                $this->redirect("cliente/");
            }
        } else {
            $this->addMensagemSessaoErro("Id nao informado para remover o cliente");
            $this->redirect("cliente/");
        }
    }

    public function deletarAction() {

        if ($this->hasIndex("id")) {
            $id = intval($this->getIndex("id"));

            if ($id > 0) {
                $clienteDAO = new ClienteDAO();

                if ($clienteDAO->delete($id)) {
                    $this->addMensagemSessaoSucesso("Cliente removido com sucesso!");
                } else {
                    $this->addMensagemSessaoErro("Nao foi possivel remover o cliente!");
                }
            } else {
                $this->addMensagemSessaoInfo("ID para cliente invalido!");
            }
        } else {
            $this->addMensagemSessaoInfo("ID Nao informado para remover Cliente!");
        }

        $this->redirect("cliente/");
    }

    private function getClienteFromForm() {
        $form = $this->getForm();

        $cliente = new Cliente();

        $cliente->setNome($form['nome']);
        $cliente->setCpf($form['cpf']);
        $cliente->setNascimento($form['nascimento']);
        $cliente->setSexo($form['sexo']);
        $cliente->setEmail($form['email']);
        $cliente->setSenha($form['senha']);

        return $cliente;
    }

    private function validarForm($cliente, $atualizar = false) {

        $sucesso = true;

        if (strlen($cliente->getNome()) < 3) {
            $sucesso = false;
            $this->addMensagemErro("Nome do Cliente deve ter pelo menos 3 caracteres!");
        }

        if (!Validacao::validarCPF($cliente->getCpf())) {
            $sucesso = false;
            $this->addMensagemErro("CPF invalido!");
        } else if (!$atualizar) {
            $clienteDAO = new ClienteDAO();
            if ($clienteDAO->hasCPF($cliente->getCpf())) {
                $sucesso = false;
                $this->addMensagemErro("CPF ja cadastrado");
            }
        }

        if (!Validacao::validarData($cliente->getNascimento())) {
            $sucesso = false;
            $this->addMensagemErro("Data de Nascimento Invalida!");
        }

        if ($cliente->getSexo() != 'F' && $cliente->getSexo() != 'M') {
            $sucesso = false;
            $this->addMensagemErro("Sexo invalido!");
        }

        if (!Validacao::validaEmail($cliente->getEmail())) {
            $sucesso = false;
            $this->addMensagemErro("Email invalido!");
        } else if (!$atualizar) {
            $clienteDAO = new ClienteDAO();
            if ($clienteDAO->hasEmail($cliente->getEmail())) {
                $sucesso = false;
                $this->addMensagemErro("Email ja cadastrado");
            }
        }

        if (strlen($cliente->getSenha()) < 6) {
            $sucesso = false;
            $this->addMensagemErro("Senha muito curta");
        }

        return $sucesso;
    }

    private function parseToDatabase($cliente) {
        $cliente->setCpf(Mascara::removerMascaraCPF($cliente->getCpf()));
        $cliente->setNascimento(Mascara::formatDataUSA($cliente->getNascimento()));
    }
    
    private function parseToForm($cliente){
        $cliente->setCpf(Mascara::adicionarMascaraCPF($cliente->getCpf()));
        $cliente->setNascimento(Mascara::formatDataPTBR($cliente->getNascimento()));
    }

}
