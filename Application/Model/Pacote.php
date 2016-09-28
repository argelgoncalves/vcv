<?php

namespace Application\Model;

class Pacote {

    private $id;
    private $nome;
    private $descricao;
    private $url_foto;
    private $valor;
    
    public function Pacote(){
        $this->valor = 0.0;
    }

    public function setId($_id) {
        $this->id = $_id;
    }

    public function setNome($_nome) {
        $this->nome = addslashes($_nome);
    }

    public function setDescricao($_descricao) {
        $this->descricao = addslashes($_descricao);
    }

    public function setURLFoto($_url_foto) {
        $this->url_foto = addslashes($_url_foto);
    }

    public function setValor($_valor) {
        $this->valor = $_valor;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getURLFoto() {
        return $this->url_foto;
    }

    public function getValor() {
        return $this->valor;
    }

}
