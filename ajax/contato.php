<?php 
    require "../include/header.php"; 
    require "../include/PHPMailer/class.phpmailer.php";

    if ($_POST["acao"] == "contato"){
        $nome     = $_POST["nome"];
        $email    = $_POST["email"];
        $telefone = $_POST["telefone"];
        $mensagem = $_POST["mensagem"];

        $sql = "SELECT idUsuario
                FROM   usuario
                WHERE  email = ? ";
            
        $arrayEmail[0] = "a";
        $arrayEmail[1] = &$_POST["email"];
        $email = $arrayEmail[1];

        $dados = db_lista($sql, $arrayEmail);

        if (empty($dados)){
            header("Location: ../index.php");
        } else {
            $email = utf8_encode($email);

            


            # envia o email
            require "../include/enviar-email.php";
        }

    }

  
    require "../include/footer.php"; 
?>