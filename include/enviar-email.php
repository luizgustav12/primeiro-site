<?php 
    require "../include/PHPMailer/class.phpmailer.php";

    // chama as configuracoes de enviar email
    require "../include/email-config.php";

    try{
        $mail = new PHPMailer(); 

        $mail -> IsSMTP();
        
        $mail -> isHTML(true);

        $mail -> CharSet       = 'UTF-8';
        $mail -> SMTPDebug     = false;
        $mail -> SMTPAuth      = $emailSMTPAuth;    // enable SMTP authentication    
        $mail -> SMTPSecure    = $emailSMTPSecure;    // sets the prefix to the servier
        $mail -> Host          = $emailHost;   // sets GMAIL as the SMTP server

        $mail -> Username      = $usuario;  // GMAIL username
        $mail -> Password      = $senha;  // GMAIL password

        $mail -> SetFrom($usuario, 'MEU SITE');
        $mail -> AddReplyTo("no-reply@e-impresso.com.br", "Não Responder");

        $mail -> Port          = $emailPort;                // set the SMTP port for the GMAIL server

        $mail -> AddAddress("luiz.gustavo@serel.com.br", $nomeSistema);
        $mail -> Subject = 'RECUPERACAO DE SENHA';

        $mail -> Body    = "<br><br>
        <b> $nome</a>.</b>
        <br>  $email  <br>  $telefone  <br>  $mensagem  .";

        // $mail->AddAttachment('../img/logo/Now_Icone.png');    // attachment

        $mail -> MsgHTML($mail -> Body);

        if($mail -> Send()){
            header("Location: ../index.php?codigo=enviado");
        }else{
            echo "Tente novamente.";
        }

    } catch (phpmailerException $e) {

    }

?>