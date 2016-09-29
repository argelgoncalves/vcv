<?php

namespace Application\Model;

/**
 * Gerencia mensagens de sessão, que são mensagens passadas de 
 * uma página para outra, evitando assim ter que trabalhar com indices no
 * URL para exibir uma mensagem em um redirecionamento
 */
class MensagemSessao {

    private $nomeSessao = "messages";
    private $sucesso = 0;
    private $erro = 1;
    private $info = 2;
    private $mensagens;

    public function __construct() {

        if (isset($_SESSION[$this->nomeSessao])) {
            $this->mensagens = $_SESSION[$this->nomeSessao];
        } else {
            $this->mensagens = array(
                $this->sucesso => array(),
                $this->erro => array(),
                $this->info => array()
            );
        }
    }

    public function addMensagemErro($mensagem) {
        $this->addMensagem($this->erro, $mensagem);
    }

    public function addMensagemInfo($mensagem) {
        $this->addMensagem($this->info, $mensagem);
    }

    public function addMensagemSucesso($mensagem) {
        $this->addMensagem($this->sucesso, $mensagem);
    }

    public function getMensagensErro() {
        return $this->getMensagens($this->erro);
    }

    public function getMensagensSucesso() {
        return $this->getMensagens($this->sucesso);
    }

    public function getMensagensInfo() {
        return $this->getMensagens($this->info);
    }

    private function addMensagem($tipo, $mensagem) {
        array_push($this->mensagens[$tipo], $mensagem);
        $_SESSION[$this->nomeSessao] = $this->mensagens;
    }

    private function getMensagens($tipo) {
        $msgs = $this->mensagens[$tipo];
        $this->mensagens[$tipo] = array();
        $_SESSION[$this->nomeSessao] = $this->mensagens;
        return $msgs;
    }

}
