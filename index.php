<?php
   require "banco_de_dados/config_banco.php";
   db_conectar();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Meu síte</title>       
        <link rel="shortcut icon" href="../imagens/icones/icone.png">       
        <link rel="stylesheet" type="text/css" href="../css/index.css">
    </head>

    <body>
        <div>
            <a class="button-title" href="../index.php" > Meu síte</a>
        </div>

        <div class="class-botoes">
            <div class="botoes">
                <a href="../system/galeria.php" class="button-gallery btn1"> Galeria</a>
            </div>

            <div class="botoes">
                <a href="../system/cadastro.php" class="button-cadastro btn2"> Cadastro</a>
            </div>

            <div class="botoes">
                <a href="../system/login.php" class="button-entrar btn3"> Entrar</a>
            </div>
        </div>

        <div class="foto">
            <img id="foto-index" src="../imagens/fotos/foto-index.svg">    
        </div>

    </body>

    <footer style="top:120px;">
        <div class="div-redes">
            <a class="button-redes" href="https://instagram.com/_luizgustavops?igshid=kgml87ktakyf">
                <img id="insta" src="../imagens/icones/instagram.png">
            </a>
            <a class="button-redes" href="http://linkedin.com/in/luiz-gustavo-pereira-4213121a7">
                <img id="linkedin" src="../imagens/icones/linkedin.png">
            </a>
        </div>
    </footer>
    
</html>
<?php db_desconectar(); ?>