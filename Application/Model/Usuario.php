<?php

namespace Application\Model;

class Usuario {

    private $id;
    private $nome;
    private $senha;

    public function setId($_id) {

        if (is_int($id)) {
            $this->id = $_id;
        } else {
            $this->id = 0;
        }
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
