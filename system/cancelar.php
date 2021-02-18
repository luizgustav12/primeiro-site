<?php   
    require "../include/functions.php";
    require "../banco_de_dados/config_banco.php";
    db_conectar();
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
            <!-- <a class="texto"> </a> -->
        </div> 

        <div class="form-body">
        
        </div>

    </body> 
    

</html>

<?php  db_desconectar(); ?>