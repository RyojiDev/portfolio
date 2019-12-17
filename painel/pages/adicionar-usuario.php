<?php 
verificaPermissaoPagina(2);



?>
<div class="box-content">
    <h2><i class="fa fa-pen"></i> Adicionar Usuário</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                // Enviei o meu formulario.
                $login = $_POST['login'];
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $cargo = $_POST['cargo'];
                $usuario = new Usuario();

                if($login == ''){
                    Painel::alert('erro','O login está vázio!');
                }else if($nome == ''){
                    Painel::alert('erro','o campo nome está vázio');

                }else if($senha == ''){
                    Painel::alert('erro','o campo senha está vázio');
                }else if($cargo == ''){
                    Painel::alert('erro','opção cargo não selecionada');
                }else if($imagem['name'] == ''){
                    Painel::alert('erro','a imagem precisa estar selecionada!');
                }else if(Usuario::userExists($login)){
                    Painel::alert('erro','O login informado já existe, escolha outro por favor');
                }else{
                    //Podemos cadastrar!
                    if($cargo >= $_SESSION['cargo']){
                        Painel::alert('erro','você precisa selecionar um cargo menor que o seu!');
                    }else if(Painel::imagemValida($imagem) == false){
                        Painel::alert('erro','O formato especificado não está correto!');
                    }else{

                        // Apenas cadastrar no banco de dados!
                        $usuario = new Usuario();
                        $imagem = Painel::uploadFile($imagem);
                        $usuario->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
                        Painel::alert('sucesso','Usuario cadastrado com sucesso');
                    }
                }
                print_r($_POST);
            }


        ?>

        <div class="form-group">
            <label>Login:</label>
            <input type="text" name="login" >
        </div>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome"  >
        </div><!--form-group-->
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="password"  >
        </div><!--form-group-->

        <div class="form-group">
            <label>Cargo:</label>
            <select name="cargo">
                <?php 
                    foreach(Painel::$cargos as $key => $value){
                       if($key < $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div><!--form-group-->
        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="imagem" />
           
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">
        </div><!--form-group-->
    </form><!--form-->


</div><!--box-content-->