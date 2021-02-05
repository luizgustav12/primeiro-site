<?php   
    require "../include/functions.php";
    require "../banco_de_dados/config_banco.php";
    db_conectar();
    
    $email = descriptografar_valor($_GET["codigo"]);

    $sql = "SELECT *
            FROM cadastro_usuario
            WHERE email = ? ";
        
    $arrayDados[1] = $email;

    $dados = db_lista($sql, $arrayDados);

    $idUsuario = $dados[0]["idUsuario"];
    $nome = $dados[0]["nome"];
    $telefone = $dados[0]["telefone"];
    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <title> Perfil | Contato</title>
    <link rel="shortcut icon" href="../imagens/icones/icone.png">
    <link rel="stylesheet" type="text/css" href="../css/contato.css"> 

    <body>
        <div class="topo">
            <div class="voltar">
                <a type="submit" class="button_voltar" href="../system/perfil.php?codigo=<?php  echo $_GET["codigo"] ?>">
                    <img id="esquerda" src="../imagens/icones/esquerda_preta.png">
                    Voltar
                </a>
            </div>

            <p> Entre em contato com a gente!</p>
            <a class="texto"> Mande suas dúvidas, sujestôes, reclamações ou até dicas para nosso melhoramento. </a>       
            <a class="informacao"> Seus dados seguirão junto a mensagem para que nossa equipe lhe identifique. </a>

            <div class="class-body">
                <div class="form-body">
                    <form name="form-alteracao" id="alteracao" action="../ajax/contato.php" method="post" data-toggle="validator" role="form">
                        <fieldset>
                            <h1>Escreva sua Mensagem</h1>

                            <textarea id="mensagem" name="mensagem" required></textarea>
                            <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario ?>">
                            <input type="hidden" id="acao" name="acao" value="alteracao" > 
                            
                            <button type="submit" class="button_submit"> Salvar alterações</button>

                        </fieldset>
                    </form>
                </div>
            </div>
                
        </div>
    </body>

</html>

<?php  db_desconectar(); ?>