<?php

namespace Application\Model;

class Cliente {

    private $id;
    private $nome;
    private $cpf;
    private $nascimento;
    private $sexo;
    private $email;
    private $senha;

    public function __construct() {
        $this->nome = "";
        $this->cpf = "";
        $this->nascimento = "";
        $this->sexo = "";
        $this->email = "";
        $this->senha = "";
    }
    public function setId($_id){
        $this->id = $_id;
    }

    public function setNome($_nome) {
        $this->nome = addslashes($_nome);
    }

    public function setCpf($_cpf) {
        $this->cpf = addslashes($_cpf);
    }

    public function setNascimento($_nascimento) {
        $this->nascimento = addslashes($_nascimento);
    }

    public function setSexo($_sexo) {
        $this->sexo = addslashes($_sexo);
    }

    public function setEmail($_email) {
        $this->email = addslashes($_email);
    }

    public function setSenha($_senha) {
        $this->senha = addslashes($_senha);
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getNascimento() {
        return $this->nascimento;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }
    
    public function __toString() {
        return $this->nome."->".$this->cpf."->".$this->nascimento."->".$this->sexo."->".$this->email."->".$this->senha;
    }

}
