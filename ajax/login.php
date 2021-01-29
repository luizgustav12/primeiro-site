<?php 
    require "../banco_de_dados/config_banco.php";

    db_conectar();

    if ($_POST["acao"] == "login"){
        $email = $_POST["email"];
        $senha = $_POST["senha"];


        $sql = "SELECT email
                FROM 
        
        ";
    }

    db_desconectar();
?>