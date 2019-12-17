
<div class="box-content">
    <h2><i class="fa fa-pen"></i> Cadastrar Notícia</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php 
        
            if(isset($_POST['acao'])){
                // Enviei o meu formulario.
                $categoria_id = $_POST['categoria_id'];
                
                $titulo = $_POST['titulo'];
                echo '<pre>';
                print_r($titulo);
                echo '</pre>';
                $conteudo = $_POST['conteudo'];
                $capa = $_FILES['capa'];
                
                if($titulo == '' || $conteudo == ''){
                    Painel::alert('erro','Campos Vázios não são permitidos!');
                }else if($capa['tmp_name'] == ''){
                    Painel::alert('erro','A imagem de capa precisa ser selecionada ');
                }else{
                    if(Painel::imagemValida($capa)){
                        echo '<pre>';
                print_r($titulo);
                echo '</pre>';
                        $verifica = Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ?");
                        $verifica->execute(array($titulo,$categoria_id));
                        print_r($titulo);
                        print_r($verifica);
                        if($verifica->rowCount() == 0){
                        $imagem = Painel::uploadFile($capa);
                        $slug = Painel::generateSlug($titulo);
                        $arr = ['categoria_id'=>$categoria_id,'data'=>date('Y-m-d'),'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'order_id'=>'0',
                        'nome_tabela'=>'tb_site.noticias'
                        
                    ];
                    print_r($arr);
                    if(Painel::insert($arr)){
                        Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-noticia?sucesso');
                    }
                            
                    
                    //Painel::alert('sucesso','O cadastro da notícia foi realizado com sucesso!');
                    
                    }else{
                        Painel::alert('erro','o nome dessa notícia já está cadastrado');
                    }
                    }else{
                        Painel::alert('erro','Selecione uma imagem válida');

                   
                }

            }
               
        }
        if(isset($_GET['sucesso']) && !isset($POST['acao'])){
            Painel::alert('sucesso','O cadastro foi realizado com sucesso');
        }
        
            
            


        ?>
        <div class="form-group">
           <label>Categoria:</label> 
            <select name="categoria_id">
            <?php 
                $categorias = Painel::selectAll('tb_site.categorias');
                foreach($categorias as $key=>$value){

            
            ?>
                    <option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected';  ?> value="<?php echo $value['id']; ?>"> <?php echo $value['nome']; ?></option>
            <?php  } ?>
            </select>
        </div><!--form-group-->

        <div class="form-group">
            <label>Titulo:</label>
            <input type="text" name="titulo" value="<?php recoverPost('titulo'); ?>" >
        </div><!--form-group-->
    
        <div class="form-group">
                <label>Conteudo:</label>
                <textarea class="tinymce" name="conteudo"><?php recoverPost('conteudo'); ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="capa" />
           
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0" />
            <input type="hidden" name="nome_tabela" value="tb_site.noticias">       
            <input type="submit" name="acao" value="Cadastrar"/>
        </div><!--form-group-->
    </form><!--form-->


</div><!--box-content-->