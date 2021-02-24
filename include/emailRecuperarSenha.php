<?php

    // require "../include/PHPMailer/PHPMailerAutoload.php";

    # O ARQUIVO DO PHPMAILER
    require_once( "../include/PHPMailer/class.phpmailer.php");

    # INCLUI AS CONFIGURAÇÕES DO E-MAIL
    require_once( "../include/emailConfig.php");
    
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

        $mail -> SetFrom($usuario, 'E-IMPRESSO');
        $mail -> AddReplyTo("no-reply@e-impresso.com.br", "Não Responder");

        $mail -> Port          = $emailPort;                // set the SMTP port for the GMAIL server

        $mail -> AddAddress($email, $nomeSistema);
        $mail -> Subject = 'RECUPERACAO DE SENHA';

        $mail -> Body    = "<br><br>
        <b> Para recuperar sua senha  
            <a href='../system/redefinir_senha.php?codigo=$codigo'> clique aqui</a>.
        </b>
        <br><br>
            Esta é uma mensagem automática. Por favor, não responda.";

        // $mail->AddAttachment('../img/logo/Now_Icone.png');    // attachment

        $mail -> MsgHTML($mail -> Body);

        if($mail -> Send()){
            header("Location: ../index.php?codigo=enviado");
        }else{
            echo "Tente novamente.";
        }

        
    }
    catch(phpmailerException $e){}
	
?>