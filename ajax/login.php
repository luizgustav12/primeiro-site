<?php 
    require "../include/functions.php";
    require "../banco_de_dados/config_banco.php";

    db_conectar();

    if ($_POST["acao"] == "login"){

        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $senha_login = base64_encode(base64_encode(base64_encode($senha)));

        $sql = "SELECT email
                FROM cadastro_usuario
                WHERE email = ? ";
    
        $arrayEmail[0] = "abc";
        $arrayEmail[1] = & $email;

        $dados = db_lista($sql, $arrayEmail);

        if (empty($dados)){ // Se nao tiver o email no banco ele da erro
            echo "<script>
                        alert(' Email ou senha inválidos. Tente novamente. ');
                        window.location.href = '../system/login.php?';
                    </script>"  ;
        } else{
            
            $sql = "SELECT senha
                    FROM cadastro_usuario
                    WHERE email = ?";

            $arraySenha[0] = "abc";
            $arraySenha[1] = & $arrayEmail[1];

            $dados2 = db_lista($sql, $arraySenha);
            $senha_cadastro = $dados2[0]["senha"];
        
            if ($senha_login != $senha_cadastro){
                echo "<script>
                        alert(' Email ou senha inválidos. Tente novamente. ');
                        window.location.href = '../system/login.php?';
                    </script>"  ;
            } else{

                $emailCrip = base64_encode(base64_encode(base64_encode($email)));

                header("Location: ../system/perfil.php?codigo={$emailCrip}");

            }
        }
    }

    db_desconectar();
?>