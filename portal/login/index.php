<?php

require_once($_SERVER['DOCUMENT_ROOT']."vcv/Application/Config/Config.php");

new Config();
use Application\Controller\LoginController;

global $applicationController;
$applicationController = new LoginController();
$applicationController->indexAction();
$applicationController->displayContent("login/index");

?>