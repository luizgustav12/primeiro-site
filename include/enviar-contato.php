<?php 
    require_once( "../include/PHPMailer/class.phpmailer.php");
    require_once "../ajax/contato.php";

    // chama as configuracoes de enviar email
    require "../include/email-config.php";

    try{
        $mail = new PHPMailer(); 

        $mail -> IsSMTP();
        
        $mail -> isHTML(true);

        $mail -> CharSet       = 'UTF-8';
        $mail -> SMTPDebug     = false;
        $mail -> SMTPAuth      = $emailSMTPAuth;    
        $mail -> SMTPSecure    = $emailSMTPSecure;    
        $mail -> Host          = $emailHost;  

        $mail -> Username      = $usuario;  
        $mail -> Password      = $senha;  

        $mail -> SetFrom($usuario, 'MEU SITE');
        $mail -> AddReplyTo("no-reply@e-impresso.com.br", "Não Responder");

        $mail -> Port          = $emailPort;               

        $mail -> AddAddress("luiz.gustavo@serel.com.br", $nomeSistema);
        $mail -> Subject = 'VOCE TEM UM NOVO CONTATO!';

        $mail -> Body    = '<br>
                    <p font-size="40">
                        <b> OLÁ, VOCÊ TEM UM NOVO CONTATO </b> <br> 
                        <br><br>
                        <b>'. $nome .'</b> enviou a seguinte mensagem: <br><br>'. $mensagem .' 
                        <br><br>
                        <a> Seus contatos são:</a><br>
                        <b> Email: </b> '. $email .'<br>
                        <b> Telefone: </b> '. $telefone .'<br>
                        
                    </p> ';

        $mail -> MsgHTML($mail -> Body);

        if($mail -> Send()){
            header("Location: ../index.php");
        }else{
            echo "Tente novamente.";
        }

    } catch (phpmailerException $e) {

    }

?>