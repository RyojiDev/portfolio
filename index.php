<?php include("config.php");?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>

<?php 
    $infoSite = Mysql::conectar()->prepare("SELECT * FROM `tb_site.config`");
    $infoSite->execute();
    $infoSite = $infoSite->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?php echo $infoSite['titulo']; ?></title>
    <link href="<?php echo INCLUDE_PATH; ?>estilo/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo INCLUDE_PATH; ?>estilo/all.css" rel="stylesheet" type="text/css">

    <link href="<?php echo INCLUDE_PATH; ?>estilo/fontawesome.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ryoji kitano" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name = "keywords" content="palavras-chave,do,meu web,site">
    <meta name="description" content="Descrição do meu website">
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon">
   
</head>
<body>




<base base="<?php echo INCLUDE_PATH ?>">

    <?php
          $url = isset($_GET['url']) ? $_GET['url'] : 'home';

        switch($url){
            case 'Depoimentos':
                echo '<target target='.$url.'>';
                 break;
            case 'servicos':     
                echo '<target target='.$url.'>';
                break;
           
        }

    ?>

        <div class="sucesso">
            Formulário enviado com sucesso!
        </div>

        <div class="error-message">
            Erro ao enviar mensagem, verifique os dados...
        </div><!--error-message-->

        <div class="overlay-loading">
            <img src="<?php echo INCLUDE_PATH; ?>imagens/ajax-loader.gif"/>
        </div><!-- overlay-loading-->

    <header>
        <div class="center">
            <div class="logo left"><a href="<?php INCLUDE_PATH; ?>/dankicode/projeto01">Logomarca</a></div><!--LOgo-->
            <nav class="desktop right">
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>Depoimentos">Depoimentos</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH ?>noticias">Noticias</a></li>
                    <li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                    
                </ul>
            </nav>

            <nav class="mobile right">
                <div class="botao-menu-mobile">
                <i class="fas fa-bars"></i>
                </div><!--menu-mobile-botao-->
                <ul>
                <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>Depoimentos">Depoimentos</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>noticias">
                    Noticias</a></li>
                    <li><a realtime = "contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                    
                </ul>
            
            
            </nav>
            <div class="clear"></div><!--clear-->
        </div><!--center-->
    </header>

    <div class="container-principal">
<?php

  

    if(file_exists('pages/'.$url.'.php')){
        include('pages/'.$url.'.php');

    }else{
        // podemos fazer oque quiser, pois a pagina não existe.
        if($url != 'Depoimentos' && $url != 'servicos' ){
        $urlPar = explode('/',$url)[0]; 
        if($urlPar != 'noticias'){   
        $pagina404 = true;
        include('pages/404.php');
    }else{
        include('pages/noticias.php');
    }
    }else{
  
            include("pages/home.php");
           
        }
    }

?>
    </div><!-- div container principal-->
    
    <footer <?php if( $url == "contato" || isset($pagina404) && $pagina404 && $url == true) echo 'class="fixed"'; ?>>
        <div class="center">
            <p>Todos os direitos reservados</p>
        </div><!---center-->
    </footer>
    <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
    <script type='text/javascript' src='https://maps.google.com/maps/api/js?key=AIzaSyCcvyLb1jXDkbrtIiE39vsKF3GpQfp5yQ4&#038;ver=4.9.11'></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/map.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script> 
    <?php 
        if($url == 'home' || $url == ''){
    ?>
    <script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>
    <?php } ?>

    <?php 

        if(is_array($url) && strstr($url[0],'noticias') !== false){
    ?>
     <script>
        $(function(){
            $('select').change(function(){
					location.href=include_path+"noticias/"+$(this).val();
				})
        });
     </script>
    <?php  } ?>
    <?php 
        if($url == 'contato'){
    ?>
    
        <?php }?>
    <script src="<?php echo INCLUDE_PATH ?>js/exemplo.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/formulario.js"></script>
</body>
</html>