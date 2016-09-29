<?php
require_once $_SERVER['DOCUMENT_ROOT']."vcv/Application/Config/Config.php";
new Config();

use Application\Controller\DashboardController;

$applicationController = new DashboardController();
$applicationController->indexAction();

$applicationController->displayHeader();
$applicationController->displayContent("dashboard/index");
$applicationController->displayFooter();

?>