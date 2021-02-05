<?php 
    require "../include/functions.php";
    require "../include/PHPMailer/class.phpmailer.php";
    require "../banco_de_dados/config_banco.php";

    db_conectar();

    if ($_POST["acao"] == "cadastro"){
        $nome     = $_POST["nome"];
        $email    = $_POST["email"];
        $telefone = $_POST["telefone"];
        $senha    = $_POST["senha"];

        $sql = "SELECT idUsuario
                FROM   cadastro_usuario
                WHERE  email = ? ";
            
        $arrayEmail[0] = "a";
        $arrayEmail[1] = & $_POST["email"];
        $emailCadastrado = $arrayEmail[1];

        $dados = db_lista($sql, $arrayEmail);

        if (empty($dados)){

            $senha_crip = base64_encode(base64_encode(base64_encode($senha))); // md5 calcula um hash que retorna um binario com 16 caracteres
            // base_encode 64 criptografa 

            $sql = "INSERT into cadastro_usuario ( nome, email, telefone, senha )
            value ( ?, ?, ?, ? ); ";

            db_query($sql, array( $nome, $email, $telefone, $senha_crip));

            # envia o email
            require "../include/enviar-email.php";
            header("Location: ../index.php");
              
        } else{
            echo "<script>
                alert(' Este cadastro já foi realizado ');
                window.location.href = '../index.php?';
            </script>"  ;

        } 
    }

    db_desconectar();
?>