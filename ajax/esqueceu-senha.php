<?php 
    require "../include/functions.php";
    require "../banco_de_dados/config_banco.php";

    db_conectar();

    if ($_POST["acao"] == "verificarEmail"){
        
        $email = $_POST["email"];

        $sql = "SELECT idUsuario
                FROM   esqueceu_senha
                WHERE  email = ? ";

        $dados = db_lista($sql, $email);

        if ( empty($dados) ) {
            echo "<script>
                    alert(' Email enviado com sucesso! ');
                    window.location.href = '../index.php?';
                  </script>"  ;

        } else {

            $sql = "SELECT data_validade
                    FROM   esqueceu_senha
                    WHERE  idUsuario = ? ";

            $dados2 = db_lista($sql, $dados);

            $hora_atual = new DateTime(date('Y-m-d H:i:s'));
            $data_expirar = new DateTime($dados2);

            if (empty($dados2) || $hora_atual >= $data_expirar ){

                if ($hora_atual >= $data_expirar){ // se entrou nesse if pela hora ser maior que atual ele vai apagar e escrever outra
                  $sql = "DELETE 
                          FROM esqueceu_senha
                          WHERE idUsuario = ?; ";
    
                    db_query($sql, array("i", $idUsuario));
                }
    
                $codigo = bin2hex(openssl_random_pseudo_bytes(32)); // gera codigos aleatorios
                $expirar_data = date('Y-m-d H:i:s', strtotime('+15 minutes')); // a quantidade de tempo que vai ficar disponivel
    
                $sql = "INSERT into esqueceu_senha( idUsuario, codigo, data_validade)
                                            value ( ?, ?, ?); ";
                db_query($sql, array( $idUsuario, $codigo, $expirar_data));
    
                # envia o email
                require "../include/emailRecuperarSenha.php";
      
                echo "<script>
                        alert(' Email enviado com sucesso! ');
                        window.location.href = '../index.php?';
                      </script>"  ;
                        

            } else{

                echo "<script>
                        alert(' Sera? ');
                        window.location.href = '../index.php?';
                      </script>"  ;
                        
            }

        }
    }

    db_desconectar();
?>