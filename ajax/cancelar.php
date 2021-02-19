<?php

    require "../include/functions.php";
    require "../banco_de_dados/config_banco.php";

    db_conectar();

    if ($_POST["acao"] == "cancelar"){
        
        $idUsuario = $_POST["idUsuario"];
        $senha = base64_encode(base64_encode(base64_encode($_POST["senha"])));

        $sql = "SELECT senha 
                FROM   cadastro_usuario
                WHERE  idUsuario = ?";

        $dados[1] = $idUsuario;

        $passe = db_lista($sql, $dados);

        if($senha == $passe[0]["senha"]){
            
            $sql = "DELETE 
                    FROM cadastro_usuario
                    WHERE idUsuario = ? ";

            $array_dados[0] = $idUsuario;

            db_query($sql, $array_dados);

            echo "<script>
                alert(' Conta cancelada com sucesso, esperamos seu retorno! ');
                window.location.href = '../index.php';
            </script>"  ;

        } else{
            echo "<script>
                alert(' Senha incorreta, utilize a senha correta! ');
                window.location.href = '../system/perfil.php?codigo=';
            </script>"  ;

        }

      

    }

    db_desconectar();

?>