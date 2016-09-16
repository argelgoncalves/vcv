<?php

require_once $_SERVER['DOCUMENT_ROOT']."vcv/Application/Config/Config.php";
new Config();

use Application\Controller\ClienteController;

$applicationController = new ClienteController();
$applicationController->indexAction();

include LAYOUT_PATH.'/_header.php';

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Clientes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            
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
            
            
            <a href ="cadastrar.php" class ="btn btn-success">Novo Cliente</a>
            
            <div class="clearfix"/><br /></div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-users fa-fw"></i>&nbsp;Clientes
                    
                    

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class='center'>#</th>
                                    <th class='center'>Nome</th>
                                    <th class='center'>CPF</th>
                                    <th class='center'>Nascimento</th>
                                    <th class='center'>Sexo</th>
                                    <th class="center">Email</th>
                                    <th class="center">Ação</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (count($applicationController->clientes)): ?>
                                    <?php foreach($applicationController->clientes as $cliente): ?>
                                        <tr>
                                            <td class='center'><?=$cliente->getId()?></td>
                                            <td><?=$cliente->getNome()?></td>
                                            <td><?=$cliente->getCpf()?></td>
                                            <td class='center'><?=$cliente->getNascimento()?></td>
                                            <td class='center'><?=$cliente->getSexo()?></td>
                                            <td class="center"><?=$cliente->getEmail()?></td>
                                            <td>
                                                <a href ="alterar.php?id=<?=$cliente->getId()?>" class ="btn btn-info">
                                                    <i class ="fa fa-edit"></i>&nbsp;Editar
                                                </a>
                                            
                                                <a href ="deletar.php?id=<?=$cliente->getId()?>" class ="btn btn-danger">
                                                    <i class ="fa fa-trash"></i>&nbsp;Apagar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7">Sem clientes cadastrados</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    <?php include LAYOUT_PATH.'/_footer.php'; ?>