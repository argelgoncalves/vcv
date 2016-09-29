<?php

namespace Application\Controller;

use Application\Model\DAO\UsuarioDAO;
use Application\Model\DAO\ClienteDAO;
use Application\Model\DAO\PacoteDAO;

class DashboardController extends ApplicationController {

    public function __construct() {
        parent::__construct();
        $this->validarSessao();
    }

    public function indexAction() {
        $clienteDAO = new ClienteDAO();
        $usuarioDAO = new UsuarioDAO();
        $pacoteDAO = new PacoteDAO();

        $this->numClientes = $clienteDAO->getCount();
        $this->numUsuarios = $usuarioDAO->getCount();
        $this->numPacotes = $pacoteDAO->getCount();
    }
}
