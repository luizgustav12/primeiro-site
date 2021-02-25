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
    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <title> Perfil | Cancelar</title>
    <link rel="shortcut icon" href="../imagens/icones/icone.png">
    <link rel="stylesheet" type="text/css" href="../css/cancelar.css"> 

    <body>
       <div class="topo">
            <div class="sair">
                <a type="submit" class="button_voltar" href="../system/perfil.php?codigo=<?=  $_GET["codigo"] ?>"> 
                    <img id="esquerda" src="../imagens/icones/esquerda_preta.png">
                    Voltar
                </a>
            </div>

            <p> Cancelamento da conta</p>

        </div> 

        <div class="form-body">
            <form name="form-cancelamento" id="cancelar" action="../ajax/cancelar.php" method="post" data-toggle="validator" role="form">
                <fieldset>
                    <h1 class="texto"> Utilize sua senha para confirmar o cancelamento de sua conta:</h1>

                    <input type="password" id="senha" required name="senha" size="55" maxlength="25">  
                    <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $idUsuario ?>">
                    <input type="hidden" id="acao" name="acao" value="cancelar" >
                    <button type="submit" class="button"> Confirmar</button>
                    
                </fieldset>

            </form>

        </div>

    </body> 
    

</html>

<?php  db_desconectar(); ?>