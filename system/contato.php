<?php require "../include/header.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
    <title>Meu síte | Contato</title>
    <link rel="stylesheet" type="text/css" href="../css/contato.css"> 

    <body>
        
        <div class="form-body">
        
            <form name="form-contact" id="contato" action="../ajax/contato.php" method="post" data-toggle="validator" role="form">
                <fieldset>
                    <h1>Entre em contato</h1>

                    <a id="indicador-nome">Nome:</a>
                    <input type="text"  id="nome"  required  name="nome"  size="50" >

                    <a id="indicador-email">Email:</a>
                    <input type="email" id="email" required  name="email" size="50" >

                    <a id="indicador-telefone">Telefone:</a>
                    <input type="telefone" id="telefone" required  name="telefone" size="50" maxlength="15" >

                    <a id="indicador-mensagem">Deixe sua mensagem:</a>
                    <input type="text" id="mensagem" name="mensagem" maxlength="1000" >
                    <input type="hidden" id="acao"    name="acao"    value="contato" >

                    <button type="submit" class="button_submit">Enviar</button>

                </fieldset>
            </form>

        </div>
    </body>
</html>

  
<?php require "../include/footer.php"; ?>