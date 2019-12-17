<?php 
    if(isset($_GET['id'])){
        echo '<pre>';
        print_r($_POST);

        echo '</pre>';
      $id = (int)$_GET['id'];
      $depoimento = Painel::select('tb_site.depoimentos','id =?',array($id));
      
    }else{
        Painel::alert('erro','Você precisa passar o parametro ID.');
        die();
    }

?>

<div class="box-content">
    <h2><i class="fa fa-pen"></i> Editar Depoimento</h2>
    <form method="POST" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                echo '<pre>';
                print_r($_POST);
        
                echo '</pre>';
                if(Painel::update($_POST)){
               Painel::alert('sucesso','O depoimento foi editado com sucesso');
               $depoimento = Painel::select('tb_site.depoimentos','id =?',array($id));
            }else{
                Painel::alert('erro','Campo vazios não são permitidos.');
            }
        
            }
        
        ?>

        <div class="form-group">
                <label>Nome da pessoa:</label>
                <input type="text" name="nome" value="<?php echo $depoimento['nome']; ?>">
        </div><!--form-group-->

        <div class="form-group">
        <label>Depoimento:</label>
        <textarea name="depoimento"> <?php echo $depoimento['depoimento']; ?></textarea> 
        </div><!--form-group--> 

        <div class="form-group">
        <label>Data:</label>
        <input formato="data" type="text" name="data" value="<?php echo $depoimento['data']; ?>">
        </div><!--form-group-->   

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.depoimentos">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->    
    </form><!--form-->




</div><!--box-content-->