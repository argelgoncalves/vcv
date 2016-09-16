<?php

require_once $_SERVER['DOCUMENT_ROOT']."vcv/Application/Config/Config.php";
new Config();

use Application\Controller\LoginController;

$ApplicationController = new LoginController();
$ApplicationController->logoutAction();

?>

