<?php

namespace Application\Model;

class Usuario {

    private $id;
    private $nome;
    private $senha;

    public function setId($_id) {
        $this->id = $_id;
    }

    public function setNome($_nome) {
        $this->nome = addslashes($_nome);
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

    public function getSenha() {
        return $this->senha;
    }

}
