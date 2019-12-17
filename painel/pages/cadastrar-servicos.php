<div class="box-content">
    <h2><i class="fa fa-pen"></i> Adicionar Serviço</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php 
        if(isset($_POST['acao'])){
            if(Painel::insert($_POST)){
                Painel::alert('sucesso', 'O cadastro do serviço foi realizado com sucesso!');

            }else{
                Painel::alert('erro','Campos Vazios não são permitidos');
            }
        }
        
        ?>
       

        <div class="form-group">
            <label>Descreva o serviço:</label>
            <textarea name="servico"></textarea>
        </div><!--form-group-->

       

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!--form-group-->

    </form><!--form-->



</div><!--box-content-->