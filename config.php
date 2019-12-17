<?php


  
session_start();
date_default_timezone_set('America/Sao_Paulo');
   
    // define('INCLUDE_PATH','http://localhost/dankicode/projeto01/');

    $autoload = function($class){
        if($class == 'Email'){
           
        }
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoload);

    define('INCLUDE_PATH','http://ryoji.ryojikitanodev-portfolio.com/');
    define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');
    define ('BASE_DIR_PAINEL',__DIR__.'/painel');
    
    // Conectar com banco de dados
    define('HOST','localhost');
    define('USER','ryojik22_admin');
    define('PASSWORD','7Jacqueline7');
    define('DATABASE','ryojik22_sistemas-portfolio');

    //Constante para o painel de controle

    define('NOME_EMPRESA','Ryou-TI');




   

    //Funções do painel

    function pegaCargo($indice){
       
        return Painel::$cargos[$indice];
    }

    function selecionadoMenu($par){
        $url = explode('/',@$_GET['url'])[0];
        if($url == $par){
            echo 'class="menu-active"';
        }
    }

    function verificaPermissaoMenu($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
            echo 'style="display:none;"';
        }
    }

    function verificaPermissaoPagina($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
            include('painel/pages/permissao_negada.php');
            die();
        }
    }

    function recoverPost($post){
        if(isset($_POST[$post])){
            echo $_POST[$post];
        }
    }





?>