<?php 
    require "../include/PHPMailer/class.phpmailer.php";
    require "../banco_de_dados/config_banco.php";

    db_conectar();

    if ($_POST["acao"] == "contato"){
        $nome     = $_POST["nome"];
        $email    = $_POST["email"];
        $telefone = $_POST["telefone"];
        $mensagem = $_POST["mensagem"];

        $sql = "SELECT idUsuario
                FROM   cadastro_contato
                WHERE  email = ? ";
            
        $arrayEmail[0] = "a";
        $arrayEmail[1] = & $_POST["email"];
        $emailCadastrado = $arrayEmail[1];

        $dados = db_lista($sql, $arrayEmail);

        if (empty($dados)){


            $sql = "INSERT into cadastro_contato ( nome, email, telefone, mensagem )
            value ( ?, ?, ?, ? ); ";

            db_query($sql, array( $nome, $email, $telefone, $mensagem));

            # envia o email
            require "../include/enviar-email.php";
            header("Location: ../index.php");
              
        } else{
            echo "<script>
                alert(' Contato já foi enviado ');
                window.location.href = '../index.php?';
            </script>"  ;

        } 
    }

    db_desconectar();
?>