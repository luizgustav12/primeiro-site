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
    $senha = descriptografar_valor($dados[0]["senha"]);
    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <title> Perfil | Alterações</title>
    <link rel="shortcut icon" href="../imagens/icones/icone.png">
    <link rel="stylesheet" type="text/css" href="../css/alterar.css"> 

    <body>

        <div class="topo">
            <div class="sair">
                <a type="submit" class="button_voltar" href="../system/perfil.php?codigo=<?php  echo $_GET["codigo"] ?>"> 
                    <img id="esquerda" src="../imagens/icones/esquerda_preta.png">
                    Voltar
                </a>
            </div>

            <p> Alteração de dados</p>
        </div>    

        <div class="class-body">
            <div class="form-body">
                <form name="form-alteracao" id="alteracao" action="../ajax/alterar.php" method="post" data-toggle="validator" role="form">
                    <fieldset>
                        <h1>Preencha seus dados</h1>

                        <a id="indicador-nome">Nome:</a>
                        <input type="text"  id="nome"  required  name="nome"  size="69" maxlength="60" value="<?php echo $nome ?>"><br>

                        <a id="indicador-email">Email:</a>
                        <input type="email" id="email" required  name="email" size="69" maxlength="60" value="<?php echo $email ?>"><br>

                        <a id="indicador-telefone">Telefone:</a>
                        <input type="tel" id="telefone" required  name="telefone" size="69" maxlength="15" value="<?php echo $telefone ?>"><br>

                        <a id="indicador-senha-atual">Senha atual:</a>
                        <input type="password" id="senha_atual" required  name="senha_atual" size="69" maxlength="25" ><br>
                        
                        <a id="indicador-nova-senha">Nova senha:</a>
                        <input type="password" id="nova_senha" required  name="nova_senha" size="69" maxlength="25" ><br>
                        
                        <a id="indicador-confirma">Confirmar nova senha:</a><br>
                        <input type="password" id="confirma_senha" required  name="confirma_senha" size="69" maxlength="25" ><br>

                        <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario ?>" >

                        <input type="hidden" id="acao" name="acao" value="alteracao" > 

                        <button type="submit" class="button_submit"> Salvar alterações</button>

                    </fieldset>
                </form>
            </div>
        </div>
    </body>

</html>

<?php  db_desconectar(); ?>