<?php 
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $noticia = Painel::select('tb_site.noticias','id = ?',array($id));
    }else{
            Painel::alert("erro","você precisa passar o parametro ID.");
            die();
    }


?>


<div class="box-content">
    <h2><i class="fa fa-pen"></i> Editar Notícia</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                // Enviei o meu formulario.
                
               
                $titulo = $_POST['titulo'];
                $imagem = $_FILES['capa'];
                $conteudo = $_POST['conteudo'];

                $imagem_atual = $_POST['imagem_atual'];
                $usuario = new Usuario();
                $verifica = Mysql::conectar()->prepare("SELECT `id` FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ? AND id != ?");
                $verifica->execute(array($titulo,$_POST['categoria_id'],$id));
               if($verifica->rowCount() == 0){
                if($imagem['name'] != ''){
                    //Existe o upload de imagem
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile($imagem_atual);
                       
                        $imagem = Painel::uploadFile($imagem);
                        $slug = Painel::generateSlug($titulo);
                        $arr = ['titulo'=>$titulo,'data'=>date(Y-m-d),'categoria_id'=>$_POST['categoria_id'],'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
                        Painel::update($arr);
                        $noticia = Painel::select('tb_site.noticias','id = ?',array($id));
                        Painel::alert('sucesso','A noticia foi editado com sucesso junto com a imagem');
                    }else{
                        Painel::alert('erro', 'O formato da imagem não é valido');
                    }
                }else{
                    $imagem = $imagem_atual;
                    $slug = Painel::generateSlug($titulo);
                    $arr = ['titulo'=>$titulo,'categoria_id'=>$_POST['categoria_id'],'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
                    Painel::update($arr);
                    $noticia = Painel::select('tb_site.noticias','id = ?',array($id));
                    Painel::alert('sucesso','A noticia foi editada com sucesso!');
                
                }
            }else{
                Painel::alert('erro','Já existe uma noticia com esse nome');
            }
            }


        ?>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="titulo" required value="<?php echo $noticia['titulo']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea class="tinymce" name="conteudo"> <?php echo $noticia['conteudo']; ?></textarea>
        </div><!--form-group-->    

        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
        <?php
        $categorias = Painel::selectAll('tb_site.categorias'); 
        foreach($categorias as $key =>$value){ 

            ?>
                <option <?php if($value['id'] == $noticia['categoria_id']) echo 'selected' ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
           <?php } ?>
            </select>
           
        </div><!--form-group-->

        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="capa" />
            <input type="hidden" name="imagem_atual" value="<?php echo $noticia['capa'] ?>"/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">
        </div><!--form-group-->
    </form><!--form-->


</div><!--box-content-->