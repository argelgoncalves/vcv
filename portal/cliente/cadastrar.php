<?php
require_once $_SERVER['DOCUMENT_ROOT']."vcv/Application/Config/Config.php";
new Config();

use Application\Controller\ClienteController;

$applicationController = new ClienteController();
$applicationController->cadastrarAction();

$applicationController->displayHeader();
$applicationController->displayContent("cliente/cadastrar");
$applicationController->displayFooter();

?>
