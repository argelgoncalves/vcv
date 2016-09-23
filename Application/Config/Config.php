<?php

/**
 * Define as constantes e configurações para a aplicação
 * Atalhos para diretórios, dados de acesso ao banco de dados,
 * realiza auto_load para poder utilizar namespaces
 */
class Config {
    
    public function __construct(){
        
        session_start();
        
        define("AMBIENTE", "DEV");
        define("PROJECT_PATH", $_SERVER['DOCUMENT_ROOT']."vcv/");
        define("APPLICATION_PATH", PROJECT_PATH."Application/");
        define("TEMPLATE_PATH", APPLICATION_PATH."View/");
        define("LAYOUT_PATH", TEMPLATE_PATH."layout/");
        define("PAGE_URL", "http://localhost/vcv/portal/");
        define("RESOURCE_URL", PAGE_URL."res/");

        define("DATABASE_NAME", "web2");
        define("DATABASE_USER", "root");
        define("DATABASE_PASSWORD", "root");
        define("DATABASE_HOST", "localhost");

        if(AMBIENTE == "DEV"){
            ini_set("display_errors", 1); 
        }else{
            ini_set("display_errors", 0); 
        }
        
        spl_autoload_extensions(".php");
        spl_autoload_register(function ($class) {
            require_once(PROJECT_PATH.str_replace('\\', '/', $class . '.php'));
        }); 
    }
}
