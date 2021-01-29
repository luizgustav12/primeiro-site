<?php require "../include/header.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
    <title>Meu síte | Cadastro</title>
    <link rel="stylesheet" type="text/css" href="../css/cadastro.css"> 
    <!-- <link rel="stylesheet" type="text/css" href="../css/index.css">  -->

    <body>
        
        <div class="form-body">
        
            <form name="form-cadastro" id="cadastro" action="../ajax/cadastro.php" method="post" data-toggle="validator" role="form">
                <fieldset>
                    <h1>Preencha seus dados</h1>

                    <a id="indicador-nome">Nome:</a>
                    <input type="text"  id="nome"  required  name="nome"  size="65" maxlength="60" placeholder=" João">

                    <a id="indicador-email">Email:</a>
                    <input type="email" id="email" required  name="email" size="65" maxlength="60" placeholder=" joao@gmail.com">

                    <a id="indicador-telefone">Telefone:</a>
                    <input type="tel" id="telefone" required  name="telefone" size="65" maxlength="15" placeholder=" (99) 9999-9999" >
                    <!-- pattern="(\([0-9]{2}\))\s([9]{1})?([0-9]{4})-([0-9]{4})" title="Número de telefone precisa ser no formato (99) 9999-9999" -->

                    <a id="indicador-senha">Sua senha:</a>
                    <input type="password" id="senha" required  name="senha" size="65" maxlength="25" >


                    <!-- <a id="indicador-mensagem">Deixe sua mensagem:</a>
                    <input type="text" id="mensagem" name="mensagem" maxlength="1000" > -->

                    <input type="hidden" id="acao"    name="acao"    value="cadastro" > 

                    <button type="submit" class="button_submit">Cadastrar</button>

                </fieldset>
            </form>

        </div>
    </body>
</html>

  
<?php require "../include/footer.php"; ?>