<?php 
    if(isset($_GET['id'])){
        echo '<pre>';
        print_r($_POST);

        echo '</pre>';
      $id = (int)$_GET['id'];
      $servicos = Painel::select('tb_site.servicos','id =?',array($id));
      
    }else{
        Painel::alert('erro','Você precisa passar o parametro ID.');
        die();
    }

?>

<div class="box-content">
    <h2><i class="fa fa-pen"></i> Editar serviços</h2>
    <form method="POST" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                echo '<pre>';
                print_r($_POST);
        
                echo '</pre>';
                if(Painel::update($_POST)){
               Painel::alert('sucesso','O Serviço foi editado com sucesso');
               $servicos = Painel::select('tb_site.servicos','id =?',array($id));
            }else{
                Painel::alert('erro','Campo vazios não são permitidos.');
            }
        
            }
        
        ?>

        <div class="form-group">
                <label>Serviço:</label>
                <textarea  name="servico"><?php echo $servicos['servico']; ?></textarea>
        </div><!--form-group-->

       

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->    
    </form><!--form-->




</div><!--box-content-->