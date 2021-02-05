<?php 
    require "../include/functions.php";
    require "../include/PHPMailer/class.phpmailer.php";
    require "../banco_de_dados/config_banco.php";

    db_conectar();

    if ($_POST["acao"] == "alteracao"){

        $idUsuario = $_POST["idUsuario"];

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $senha = $_POST["senha_atual"];
        $nova_senha = $_POST["nova_senha"];
        $confirma_senha = $_POST["confirma_senha"];

        $senha_crip = criptografar_valor($senha);
        $nova_senha_crip = criptografar_valor($nova_senha);
        $email_crip = criptografar_valor($email);

        $sql = "SELECT senha
                FROM cadastro_usuario
                WHERE email = ? ";

        $arraySenha[1] = $email;

        $dados = db_lista($sql, $arraySenha);

        $senha_usuario = $dados[0]["senha"];

        if ($senha_usuario != $senha_crip){
            echo "<script>
                alert(' Você deve usar sua senha para confirmar alteração dos dados! ');
                window.location.href = '../system/perfil.php?codigo=$email_crip';
            </script>"  ;

        } else{

            if ($nova_senha != $confirma_senha){
                echo "<script>
                    alert(' As senhas devem ser iguais para alteração de dados! ');
                    window.location.href = '../system/perfil.php?codigo=$email_crip';
                </script>"  ;
    
            } else {
                
                $sql = "UPDATE cadastro_usuario
                        SET nome = ?,
                            email = ?,
                            telefone = ?,
                            senha = ?
                        
                        WHERE idUsuario = ? ";

                db_query($sql, array( $nome, $email, $telefone, $nova_senha_crip, $idUsuario) );
    
                echo "<script>
                    alert(' Dados alterados com sucesso! ');
                    window.location.href = '../system/perfil.php?codigo=$email_crip';
                </script>"  ;
            }

        }

    }

    db_desconectar();
?>