<?php 
    require "../include/header.php"; 
?>

<!DOCTYPE html> 
<html lang="pt-br">
    <title>Meu síte | Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css"> 
    
    <body>
        <div class="form-body">
            
            <form name="form-login" id="login" action="../ajax/login.php" method="post" data-toggle="validator" role="form">
                <fieldset>
                    <h1>Login</h1>

                    <a id="indicador-email">Email:</a>
                    <input type="email" id="email" required  name="email" size="46" maxlength="60">

                    <a id="indicador-senha">Senha:</a>
                    <input type="password" id="senha" required  name="senha" size="46" maxlength="25" >

                    <input type="hidden" id="acao"    name="acao"    value="login" > 

                    <button type="submit" class="button_submit"> Entrar</button>

                </fieldset>
            </form>

        </div>

    </body>

</html> 
  
<?php require "../include/footer.php"; ?>