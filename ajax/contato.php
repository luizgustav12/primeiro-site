<?php 
    require "../include/functions.php";
    require "../include/PHPMailer/class.phpmailer.php";
    require "../banco_de_dados/config_banco.php";

    db_conectar();

    if ($_POST["acao"] == "alteracao"){

        $idUsuaio = $_POST["idUsuario"];

        $sql = "SELECT *
                FROM cadastro_usuario
                WHERE idUsuario = ? ";

        $arrayDados = $idUsuario;

        $dados = db_lista($sql, $arrayDados);

        $nome = $dados[0]["nome"];
        $email = $dados[0]["email"];
        $telefone = $dados[0]["telefone"];

        $email_crip = criptografar_valor($email);

        
        

    }

    db_desconectar();
?>