<?php

class Config {
    
    public function __construct(){
        
        session_start();
        
        define("AMBIENTE", "DEV");
        define("PROJECT_PATH", $_SERVER['DOCUMENT_ROOT']."vcv/");
        define("APPLICATION_PATH", PROJECT_PATH."Application/");
        define("LAYOUT_PATH", PROJECT_PATH."layout/");
        define("VIEW_PATH", "vcv/");

        define("DATABASE_NAME", "web2");
        define("DATABASE_USER", "root");
        define("DATABASE_PASSWORD", "root");
        define("DATABASE_HOST", "localhost");

        if(AMBIENTE == "DEV"){
            ini_set("display_errors", 1); 
        }
        
        spl_autoload_extensions(".php");
        spl_autoload_register(function ($class) {
            require_once(PROJECT_PATH.str_replace('\\', '/', $class . '.php'));
        }); 
    }
}
