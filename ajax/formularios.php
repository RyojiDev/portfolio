<?php
    include('../config.php');

    $data = array();
    $assunto = 'nova mensagem do site';
    $corpo = '';
    foreach ($_POST as $key => $value) {
        $corpo.=ucfirst($key).": =".$value;
        $corpo.="<hr>";
    }
    $info = array('assunto'=>$assunto, 'corpo'=>$corpo);
    $mail= new Email('smtp.gmail.com','ryojikitanodevteste@gmail.com
    ','7Teste7@','Ryoji kitano');
    $mail->addAdress('uchiharyoji@gmail.com','Ryoji');
    $mail->formatarEmail($info);
    if($mail->enviarEmail()){
        $data['sucesso'] = true;
    }else{
        $data['erro'] = true;
        $data['sucesso'] = false;
    }

      

    die(json_encode($data));




?>