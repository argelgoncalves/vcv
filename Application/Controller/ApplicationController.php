<?php

namespace Application\Controller;

use Application\Model\Auth;
use Application\Model\MensagemSessao;

abstract class ApplicationController {

    private $mensagemSessao;
    private $mensagensErro;
    private $mensagensSucesso;
    private $mensagensInfo;
    protected $atributos = array();

    public function __construct() {
        $this->mensagemSessao = new MensagemSessao();
        $this->mensagensErro = $this->mensagemSessao->getMensagensErro();
        $this->mensagensInfo = $this->mensagemSessao->getMensagensInfo();
        $this->mensagensSucesso = $this->mensagemSessao->getMensagensSucesso();
    }

    public function __get($key) {
        return $this->atributos[$key];
    }

    public function __set($key, $value) {
        $this->atributos[$key] = $value;
    }

    public function isPost() {
        return count($this->getForm());
    }

    public function getForm() {
        $form = array();
        foreach ($_POST as $key => $value) {
            $form[$key] = $value;
        }

        return $form;
    }

    public function hasIndex($index) {
        return isset($_GET[$index]);
    }

    public function getIndex($index) {
        return addslashes($_GET[$index]);
    }

    public function validarSessao() {
        $auth = new Auth();

        if (!$auth->isLogado()) {
            $this->redirect("login/");
        }

        return true;
    }

    public function redirect($destino) {
        header("location: /" . VIEW_PATH . $destino);
    }

    public function addMensagemErro($mensagem) {
        array_push($this->mensagensErro, $mensagem);
    }

    public function addMensagemInfo($mensagem) {
        array_push($this->mensagensInfo, $mensagem);
    }

    public function addMensagemSucesso($mensagem) {
        array_push($this->mensagensSucesso, $mensagem);
    }

    public function addMensagemSessaoErro($mensagem) {
        $this->mensagemSessao->addMensagemErro($mensagem);
    }

    public function addMensagemSessaoInfo($mensagem) {
        $this->mensagemSessao->addMensagemInfo($mensagem);
    }

    public function addMensagemSessaoSucesso($mensagem) {
        $this->mensagemSessao->addMensagemSucesso($mensagem);
    }

    public function getMensagensErro() {
        return $this->mensagensErro;
    }

    public function getMensagensInfo() {
        return $this->mensagensInfo;
    }

    public function getMensagensSucesso() {
        return $this->mensagensSucesso;
    }

    public function hasMensagensErro() {
        return count($this->mensagensErro);
    }

    public function hasMensagensInfo() {
        return count($this->mensagensInfo);
    }

    public function hasMensagensSucesso() {
        return count($this->mensagensSucesso);
    }
    
    public function displayHeader(){
        include LAYOUT_PATH."_header.php";
    }
    
    public function displayFooter(){
        include LAYOUT_PATH."_footer.php";
    }

}
