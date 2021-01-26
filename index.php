<?php
   require "banco_de_dados/config_banco.php";
   db_conectar();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Meu síte</title>       
        <link rel="shortcut icon" href="../imagens/icones/icone.png">           
        <link rel="stylesheet" type="text/css" href="../css/index.css">

        <div>
            <a class="button-title" href="../index.php" >Meu síte</a>

        </div>
    </head>

    <body>
        <div>
            <a href="../system/galeria.php" class="button-gallery btn1">Galeria</a>
        </div>

        <div>
            <a href="../system/cadastro.php" class="button-cadastro btn2">Cadastro</a>
        </div>
    </body>

    <footer>
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