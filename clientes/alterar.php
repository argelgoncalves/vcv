<?php
require_once $_SERVER['DOCUMENT_ROOT']."vcv/Application/Config/Config.php";
new Config();

use Application\Controller\ClienteController;

$applicationController = new ClienteController();
$applicationController->alterarAction();

$cliente = $applicationController->cliente;

include LAYOUT_PATH."_header.php";

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Alterar Cliente</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulário do cliente <?=$cliente->getNome()?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                            <form class='form-horizontal' method="POST" action="alterar.php?id=<?=$cliente->getId()?>">
                                
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
                                    
                                <div class="form-group">
                                    
                                    <label for='nome' class="col-md-3 control-label">Nome Completo</label>
                                    <div class='col-md-9 col-sm-12'>
                                        <input class="form-control" id="nome" name="nome" type="text" value="<?=$cliente->getNome()?>">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    
                                    <label for='cpf' class="col-md-3 control-label">CPF</label>
                                    <div class='col-md-9 col-sm-12'>
                                        <input class="form-control" id="cpf" name="cpf" type="text" value="<?=$cliente->getCpf()?>">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    
                                    <label for='nascimento' class="col-md-3 control-label">Data de Nascimento</label>
                                    <div class='col-md-9 col-sm-12'>
                                        <input class="form-control" id="nascimento" name="nascimento" type="text" value="<?=$cliente->getNascimento()?>">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for='sexo' class="col-md-3 control-label">Sexo</label>
                                    <div class='col-md-9 col-sm-12'>
                                        <label class="radio-inline">
                                            <input type="radio" name="sexo" id="masculino" value="M" <?=$cliente->getSexo() == 'M'?"checked":""?>>&nbsp;Masculino
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="sexo" id="feminino" value="F" <?=$cliente->getSexo() == 'F'?"checked":""?>>&nbsp;Feminino
                                        </label>
                                    </div>
                                </div>
                                    
         
                                <div class="form-group">
                                    
                                    <label for='email' class="col-md-3 control-label">Email</label>
                                    <div class='col-md-9 col-sm-12'>
                                        <input class="form-control" id="email" name="email" type="text" value="<?=$cliente->getEmail()?>">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    
                                    <label for='senha' class="col-md-3 control-label">Senha</label>
                                    <div class='col-md-9 col-sm-12'>
                                        <input class="form-control" id="senha" name="senha" type="password">
                                    </div>
                                </div>
                                                                                  
                                <div class='clear'>&nbsp;</div>
                                <div class='form-group'>
                                    <div class='col-md-offset-2 col-md-10 col-sm-offset-0 col-sm-12'>
                                        <button type="submit" class="btn btn-success">Cadastrar</button>
                                        <button type="reset" class="btn btn-info">Limpar os Dados</button>
                                     </div>
                                </div>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->


    <?php include '../layout/_footer.php'; ?>


