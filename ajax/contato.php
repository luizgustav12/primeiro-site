<?php 
    require "../include/functions.php";
    require "../include/PHPMailer/class.phpmailer.php";
    require "../banco_de_dados/config_banco.php";

    db_conectar();

    if ($_POST["acao"] == "alteracao"){

        $idUsuario = $_POST["idUsuario"];
        $mensagem = $_POST["mensagem"];

        $sql = "SELECT *
                FROM cadastro_usuario
                WHERE idUsuario = ? ";

        $arrayDados[1] = $idUsuario;

        $dados = db_lista($sql, $arrayDados);

        $nome = $dados[0]["nome"];
        $email = $dados[0]["email"];
        $telefone = $dados[0]["telefone"];

        $email_crip = criptografar_valor($email);

        # envia o email
        require "../include/enviar-contato.php";
        header("Location: ../system/perfil.php?codigo=$email_crip");

    }

    db_desconectar();
?>