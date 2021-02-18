<?php   
    require "../banco_de_dados/config_banco.php";
    db_conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <title> Perfil | Usuario</title>
    <link rel="shortcut icon" href="../imagens/icones/icone.png">
    <link rel="stylesheet" type="text/css" href="../css/perfil.css"> 

    <body>

        <div class="topo">
            <div class="sair">
                <a type="submit" class="button_sair" href="../index.php"> 
                    <img id="sair" src="../imagens/icones/xis.png">
                    Sair
                </a>
            </div>

            <p> Bem vindo(a) ao seu perfil!</p>
            <a class="texto"> Agora você pode entrar em contato conosco, mandar
            suas dúvidas e sugestões, <br> agradecemos sua participação.</a>

        </div>

        <div class="class_body">
            <selection class="class-buttons">
                <div class="buttons">
                    <a id="button1" type="submit" href="../system/contato.php?codigo=<?= $_GET["codigo"] ?>"> Entrar em contato</a>
                </div>
                
                <div class="buttons">
                    <a id="button2" type="submit" href="../system/alterar.php?codigo=<?= $_GET["codigo"] ?>"> Alterar seus dados</a>
                </div>

                <div class="buttons">
                    <a id="button3" type="submit" href="../system/cancelar.php?codigo=<?= $_GET["codigo"] ?>"> Cancelar Conta</a>
                </div>
            </selection>

        </div>
    </body>

</html>

<?php  db_desconectar(); ?>