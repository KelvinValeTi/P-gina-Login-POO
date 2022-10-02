<?php
    require_once('../class/config.php');
    require_once('../autoload.php');

    $login = new Login();

    $login->isAuth($_SESSION['TOKEN']);

    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Área restrita || kelvin Vale</title>
</head>
<body>
    <div id="div-area-restrita">
        <h1>Área Restrita!</h1><br>
        <?php
            echo"<h2>Bem-vindo à área restrita! $login->nome!</h2>";
        ?>
    </div>


</body>
</html>