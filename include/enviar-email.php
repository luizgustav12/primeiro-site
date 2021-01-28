<?php 
    require_once( "../include/PHPMailer/class.phpmailer.php");
    require_once "../html/email-cadastro.html";

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
        $mail -> Subject = 'CADASTRO MEU SITE!';

        $mail -> Body    = '<br>
                    <p font-size="40">
                        <b> SEJA BEM VINDO(A) À PLATAFORMA MEU SITE </b> <br> 
                        <br><br>
                        <b>'. $nome .'</b>, agora você ja pode acessar sua conta, para isso basta fazer login com seu email e senha.   <br>
                        Nossa equipe agradece sua participação! <br><br>
                        <tr>
                            <img src="../imagens/icones/sol2.png" height="60p" width="60px">  
                        </tr> 
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