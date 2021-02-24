<?php 
    require "../banco_de_dados/config_banco.php";
    db_conectar();
?>

<!DOCTYPE html> 
<html lang="pt-br">

    <head>
        <title>Meu síte | Login</title>
        <link rel="shortcut icon" href="../imagens/icones/icone.png">
        <link rel="stylesheet" type="text/css" href="../css/login.css"> 

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <div> <a class="button-title" href="../index.php" >Meu síte</a>  </div>

    </head>

    <body class="body">
        <div class="form-body">
            
            <form name="form-login" id="login" action="../ajax/login.php" method="post" data-toggle="validator" role="form">
                <fieldset>
                    <h1 class="titulo-h1"> Login</h1>

                    <a id="indicador-email"> Email:</a><br>
                    <input type="email" id="email" required  name="email" size="46" maxlength="60">

                    <a id="indicador-senha"> Senha:</a>
                    <input type="password" id="senha" required  name="senha" size="46" maxlength="25" >

                    <input type="hidden" id="acao"    name="acao"    value="login" > 

                    <button type="button" class="botao-esqueceu" data-toggle="modal" data-target="#ExemploModalCentralizado"> Esquceu a senha?</button>

                    <button type="submit" class="button_submit"> Entrar</button>

                </fieldset>
            </form>

            <!-- Modal do Esqueceu a senha-->
            <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <b class="modal-title" id="recuperacao-de-senha"> Recuperação de senha</b>
                            </button>
                        </div>

                        <form name="form_login" id="form-modal" action="../ajax/esqueceu-senha.php" method="post" data-toggle="validator" role="form">
                            <div class="modal-body">
                                <p id="text-body"> Por favor, informe seu E-mail:</p>
                                
                                <div class="form-group">
                                    <input type="email" id="email-modal" required  name="email" size="50" class="form-control" data-error="Preencha este campo corretamente" aria-describedby="emailHelp" placeholder= "Email">
                                    <div class="help-block with-errors"></div>
                                    <input type="hidden" id="acao" name="acao" value="verificarEmail" />							
                                </div>
                                
                            </div>

                            <div class="modal-footer">
                                <button type="button" id="cancelar" class="btn btn-secondary" data-dismiss="modal"> Fechar</button>
                                <button type="submit" id="enviar-modal"   class="btn btn-primary"> Enviar</button>
                            </div>
					    </form>

                    </div>
                </div>
            </div>

        </div>

        <!-- Importando o jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        
        <!-- Importando o js do bootstrap -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
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