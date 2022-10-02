<?php
    require_once('class/config.php');
    require_once('autoload.php');

    if(isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha'])){
        $email=limpaPost($_POST['email']);
        $senha=limpaPost($_POST['senha']);

        $login = new Login();
        $login->auth($email,$senha);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Página de Login || kelvin Vale</title>
</head>
<body>

    <form method="post" class="form-style">
        <h1>Login</h1>

        <?php 
            if(isset($login->erro["erro_geral"])){
                echo '<p class="erro">'.$login->erro["erro_geral"].'</p>';
            } 
        ?>

        <div class="div-style">
            <label>Email:</label><br>
            <input type="email" name="email" class="input-style" placeholder="Digite seu Email" required>
        </div>

        <div class="div-style">
            <label>Senha:</label><br>
            <input type="password" name="senha" class="input-style" placeholder="Digite sua Senha" >
        </div>

        <div class="div-style">
            <button type="submit" class="btn-style">Fazer Login</button>    
        </div>

        <div class="div-style">
            <a href="novo-cadastro.php">Não tenho cadastro</a>    
        </div>
    </form>

</body>
</html>