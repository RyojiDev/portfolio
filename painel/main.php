<?php 

if(isset($_GET['loggout'])){
    Painel::loggout();
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo INCLUDE_PATH; ?>estilo/fontawesome.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>estilo/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css" rel="stylesheet"/>
    <title>Painel de Controle</title>
</head>
<body>

    <div class="menu">
        <div class="menu-wraper">  
      <div class="box-usuario">
          <?php
            if($_SESSION['img'] == ''){
          ?>
        <div class="avatar-usuario">
            <i class="fa fa-user"></i>
        </div><!--avatar-usuario-->
        <?php }else{ ?>
             <div class="imagem-usuario">
                 <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $_SESSION['img']; ?>"/>
            
            </div><!--imagem-usuario-->
        <?php  } ?>
            <div class="nome-usuario">
                <p><?php echo $_SESSION['nome']; ?></p>
                <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
            </div><!--nome-usuario-->
      </div><!--box-usuario-->
      <div class="items-menu">
            <h2>Cadastro</h2>
            <a <?php selecionadoMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">Cadastrar Depoimento</a>
            <a <?php selecionadoMenu('cadastrar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servicos">Cadastrar Serviço</a>
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slides">Cadastrar Slides</a>
            <h2>Gestão</h2>
            <a <?php selecionadoMenu('listar-depoimentos'); ?>href="<?php echo INCLUDE_PATH_PAINEL  ?>listar-depoimentos">Listar Depoimentos</a>
            <a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Serviços</a>
            <a href="<?php  echo INCLUDE_PATH_PAINEL?>listar-slides">Listar Slides</a>
            <h2>Administração do painel</h2>
            <a <?php selecionadoMenu('editar-usuario') ?>  href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar Usuários</a>
            <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL; ?>adicionar-usuario">Adicionar Usúarios</a>
            <h2>Configuração Geral</h2>
            <a <?php selecionadoMenu('Editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar Site</a>
            <h2>Gestão de Noticias</h2>
            <a <?php selecionadoMenu('cadastrar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-categorias">Cadastrar Categorias</a>
            <a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias">Gerenciar Categorias</a>
            <a <?php selecionadoMenu('cadastrar-noticia'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-noticia">Cadastrar Noticias</a>

            <a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias">Gerenciar Notícias</a>
      </div><!--items-menu-->
        </div><!--menu-wraper-->        
    </div><!--menu-->
        <header>
            <div class="center">
                <div class="menu-btn">
                <i class="fa fa-bars"></i>
                </div><!--menu-btn-->
               
                <div class="loggout">
        <a <?php if(@$_GET['url'] == ''){?> style="background: #60727a; padding: 15px;" <?php } ?>href="<?php echo INCLUDE_PATH_PAINEL;?> "><i class=" fa fa-home "></i> <span>Página Inicial</span></a>
                
                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>?loggout">  <i class="fa fa-window-close"></i> <span>Sair</span></a>
                </div><!--loggout-->
              
            <div class="clear"></div>
            </div><!-- center-->
        </header>
        
        <div class="content">
        
        <?php Painel::carregarPagina(); ?>
           
        
        </div><!--content-->

<script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>        
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea',plugins: "image",height: "300"
  });
  </script>
     

</body>

</html>