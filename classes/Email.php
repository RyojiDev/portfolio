<?php

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
    class Email
    {
        

        private $mailer;

        public function __construct($host,$username,$senha,$name)
        {

           

            
            require '../vendor/autoload.php';
            
            
            $this->mailer = new PHPMailer(true);

            
               
                                                    
                $this->mailer->isSMTP();                                           
                $this->mailer->Host       = $host;   
                $this->mailer->SMTPAuth   = true;                                   
                $this->mailer->Username   = $username;       
                $this->mailer->Password   = $senha;                              
                $this->mailer->SMTPSecure = 'tls';                                
                $this->mailer->Port       = 587;                                 

        
                $this->mailer->setFrom($username, $name);
           
                $this->mailer->isHTML(true);                                  
                $this->mailer->Subject = 'Assunto email';
                $this->mailer->Body    = 'Corpo do meu <b>E-MAIL</b>';
                $this->mailer->AltBody = 'Corpo do meu e-mail';

          
        }

        public function addAdress($email,$nome){
            $this->mailer->addAddress($email,$nome);  
        }

        public function formatarEmail($info){
            $this->mailer->Subject = $info['assunto'];
            $this->mailer->Body    = $info['corpo'];
            $this->mailer->AltBody = strip_tags($info['corpo']);

        }

        public function enviarEmail(){
            if($this->mailer->send()){
                return true;
            }else{
                return false;
            }
        }
    }




?>