<?php

namespace Application\Controller;

use Application\Model\Auth;
use Application\Model\MensagemSessao;

/**
 * Classe que contém todas as funções e variavéis necessárias a qualquer 
 * Controller da aplicação, como validação de Autenticação, Mensagens, 
 * Exibição de Layout, redirecionamento, etc.
 * 
 * Classe abstrata, ou seja não pode ser declarada
 */
abstract class ApplicationController {

    private $mensagemSessao;
    private $mensagensErro;
    private $mensagensSucesso;
    private $mensagensInfo;
    protected $atributos = array();

    /**
     * Inicializa as mensagens de Sessao, mensagens vindas de outras
     * páginas e registra as mensagens de cada tipo na classe 
     */
    public function __construct() {
        $this->mensagemSessao = new MensagemSessao();
        $this->mensagensErro = $this->mensagemSessao->getMensagensErro();
        $this->mensagensInfo = $this->mensagemSessao->getMensagensInfo();
        $this->mensagensSucesso = $this->mensagemSessao->getMensagensSucesso();
    }

    /**
     * É utilizado para ler dados de propriedades inacessíveis. 
     * 
     *  Sobrecarga em PHP provê recursos para "criar" dinamicamente propriedades
     *  e métodos. Estas entidades dinâmicas são processadas por métodos mágicos
     *  fornecendo a uma classe vários tipos de ações.
     *  Os métodos de sobrecarga são invocados ao interagir com 
     *  propriedades ou métodos que não foram declarados ou não são visíveis no 
     *  escopo corrente. O resto desta seção usará os termos 
     * "propriedades inacessíveis" e "métodos inacessíveis" para referir-se a 
     * esta combinação de declaração e visibilidade. 
     * 
     * 
     * @param string $key propriedade a ser lida
     * @return string
     */
    public function __get($key) {
        return $this->atributos[$key];
    }

    /**
     *  É executado ao escrever dados em propriedades inacessíveis. 
     * 
     *  Sobrecarga em PHP provê recursos para "criar" dinamicamente propriedades
     *  e métodos. Estas entidades dinâmicas são processadas por métodos mágicos
     *  fornecendo a uma classe vários tipos de ações.
     *  Os métodos de sobrecarga são invocados ao interagir com 
     *  propriedades ou métodos que não foram declarados ou não são visíveis no 
     *  escopo corrente. O resto desta seção usará os termos 
     * "propriedades inacessíveis" e "métodos inacessíveis" para referir-se a 
     *  esta combinação de declaração e visibilidade. 
     * 
     * 
     * @param string $key Propriedade a ser lida
     * @param string $value Valor da propriedade
     */
    public function __set($key, $value) {
        $this->atributos[$key] = $value;
    }

    /**
     * Verificado se um formulário foi enviado à pagina
     * @return boolean
     */
    public function isPost() {
        return count($this->getForm()) > 0;
    }

    /**
     * Retorna um array com os campos enviados pelo formulário, 
     * sendo o índice do array é o nome do campo do formulario
     * @return array
     */
    public function getForm() {
        $form = array();
        foreach ($_POST as $key => $value) {
            $form[$key] = $value;
        }

        return $form;
    }

    /**
     * Verifica se existe um indice enviado pela URL com o método GET
     * @param string $index índice a ser testado
     * @return boolean
     */
    public function hasIndex($index) {
        return isset($_GET[$index]);
    }

    /**
     * Retorna o valor de um indice enviado pela URL com o método GET
     * @param string index indice a ser obtido
     * @return string valor do indice obtido
     */
    public function getIndex($index) {
        return addslashes($_GET[$index]);
    }

    /**
     * Verifica se a sessão corrente está autenticada,
     * caso não estiver, redireciona para a página de login
     */
    public function validarSessao() {
        $auth = new Auth();

        if (!$auth->isLogado()) {
            $this->redirect("login/");
        }
    }

    /**
     * Redireciona a aplicação
     * @param string $destino caminho do arquivo a ser redirecionado   
     */
    public function redirect($destino) {
        header("location: /" . VIEW_PATH . $destino);
    }

    /**
     * Adiciona uma mensagem de erro para ser exibida na
     * página atual
     * @param string $mensagem Mensagem a ser registrada 
     */
    public function addMensagemErro($mensagem) {
        array_push($this->mensagensErro, $mensagem);
    }

    /**
     * Adiciona uma mensagem de informação para ser exibida na
     * página atual
     * @param string $mensagem Mensagem a ser registrada 
     */
    public function addMensagemInfo($mensagem) {
        array_push($this->mensagensInfo, $mensagem);
    }

    /**
     * Adiciona uma mensagem de sucesso para ser exibida na
     * página atual
     * @param string $mensagem Mensagem a ser registrada 
     */
    public function addMensagemSucesso($mensagem) {
        array_push($this->mensagensSucesso, $mensagem);
    }

    /**
     * Adiciona uma mensagem de erro para ser exibida na
     * próxima página
     * @param string $mensagem Mensagem a ser registrada 
     */
    public function addMensagemSessaoErro($mensagem) {
        $this->mensagemSessao->addMensagemErro($mensagem);
    }

    /**
     * Adiciona uma mensagem de informação para ser exibida na
     * próxima página
     * @param string $mensagem Mensagem a ser registrada 
     */
    public function addMensagemSessaoInfo($mensagem) {
        $this->mensagemSessao->addMensagemInfo($mensagem);
    }

    /**
     * Adiciona uma mensagem de sucesso para ser exibida na
     * próxima página
     * @param string $mensagem Mensagem a ser registrada 
     */
    public function addMensagemSessaoSucesso($mensagem) {
        $this->mensagemSessao->addMensagemSucesso($mensagem);
    }

    /**
     * Retorna as mensagens de erro da aplicação, caso
     * não houver, retorna um array vazio
     * @return array
     */
    public function getMensagensErro() {
        return $this->mensagensErro;
    }

    /**
     * Retorna as mensagens de informação da aplicação, caso
     * não houver, retorna um array vazio
     * @return array mensagensInfo Mensagens de Informação
     */
    public function getMensagensInfo() {
        return $this->mensagensInfo;
    }

    /**
     * Retorna as mensagens de sucesso da aplicação, caso
     * não houver, retorna um array vazio
     * @return array mensagensSucesso Mensagens de Sucesso
     */
    public function getMensagensSucesso() {
        return $this->mensagensSucesso;
    }

    /**
     * Verifica se existem mensagens de erro registradas
     * na aplicação
     * @return boolean hasMensagensErro 
     */
    public function hasMensagensErro() {
        return count($this->mensagensErro) > 0;
    }

    /**
     * Verifica se existem mensagens de informação registradas
     * na aplicação
     * @return boolean
     */
    public function hasMensagensInfo() {
        return count($this->mensagensInfo) > 0;
    }

    /**
     * Verifica se existem mensagens de sucesso registradas
     * na aplicação
     * @return boolean
     */
    public function hasMensagensSucesso() {
        return count($this->mensagensSucesso) > 0;
    }

    /**
     * Inclui e exibe o arquivo de cabeçalho do layout padrão da
     * aplicação
     */
    public function displayHeader() {
        include LAYOUT_PATH . "_header.php";
    }

    /**
     * Inclui e exibe o arquivo de rodapé do layout padrão da
     * aplicação
     */
    public function displayFooter() {
        include LAYOUT_PATH . "_footer.php";
    }

}
