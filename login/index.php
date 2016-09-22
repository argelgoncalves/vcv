<?php

require_once($_SERVER['DOCUMENT_ROOT']."/vcv/Application/Config/Config.php");

new Config();
use Application\Controller\LoginController;

$applicationController = new LoginController();
$applicationController->indexAction();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WEB CMS - Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="../res/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../res/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../res/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../res/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Painel de Login</h3>
                    </div>
                    <div class="panel-body">
                        
                        <?php if($applicationController->hasMensagensErro()):?>
                            <?php foreach($applicationController->getMensagensErro() as $message):?>
                                <div class="alert alert-danger"><?=$message?></div>
                            <?php endforeach;?>
                        <?php endif;?>

                        <?php if($applicationController->hasMensagensInfo()):?>
                            <?php foreach($applicationController->getMensagensInfo() as $message):?>
                                <div class="alert alert-info"><?=$message?></div>
                            <?php endforeach;?>
                        <?php endif;?>

                        <?php if($applicationController->hasMensagensSucesso()):?>
                            <?php foreach($applicationController->getMensagensSucesso() as $message):?>
                                <div class="alert alert-success"><?=$message?></div>
                            <?php endforeach;?>
                        <?php endif;?>
                                
                        <form role="form" action="index.php" method="POST">
                            <fieldset>
                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="Login" name="login" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type = "submit" class="btn btn-lg btn-success" value="Login"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../res/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../res/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../res/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../res/dist/js/sb-admin-2.js"></script>

</body>

</html>
