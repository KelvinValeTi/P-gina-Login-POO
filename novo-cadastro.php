<?php
    require_once('class/config.php');
    require_once('autoload.php');

    //verificar se existe o post com todos os dados
    if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['repete_senha'])){
        //receber valores vindos do post e limpar
        $nome = limpaPost($_POST['nome']);
        $email = limpaPost($_POST['email']);
        $senha = limpaPost($_POST['senha']);
        $repete_senha = limpaPost($_POST['repete_senha']);

        //verificar se valores vindo do post não estão vazios
        if(empty($nome) or empty($email) or empty($senha) or empty($repete_senha) or empty($_POST['termos'])){
            $erro_geral="Todos os campos são obrigatórios!";
        }else{
            //instanciar a classe usuario
            $usuario = new Usuario($nome,$email,$senha);

            //setar a repetição de senha
            $usuario->set_repeticao($repete_senha);

            //validar o cadastro
            $usuario->validar_cadastro();

            //se não tiver nenhum erro - está vazio erros
            if(empty($usuario->erro)){
                //inserir
                if($usuario->insert()){
                    header('location:index.php');
                }else{
                    //deu errado - erro geral.
                    $erro_geral=$usuario->erro["erro_geral"];
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Novo Cadastro || kelvin Vale</title>
</head>
<body>

    <form method="post" class="form-style">
        <h1>Novo Cadastro</h1>

        <div class="div-style">
            <label>Nome:</label><br>
            <input type="text" name="nome" class="input-style" placeholder="Digite seu Nome" required
                <?php 
                    if(isset($_POST['nome'])){
                        echo'value="'.$_POST['nome'].'"';
                    }
                ?> 
            >

            <div class="erro"><?php 
                                if(isset($usuario->erro["erro_nome"])){
                                    echo $usuario->erro["erro_nome"];
                                }
                                ?>
            </div>
        </div>

        <div class="div-style">
            <label>Email:</label><br>
            <input type="email" name="email" class="input-style" placeholder="Digite seu Email" required
                <?php 
                    if(isset($_POST['email'])){
                        echo'value="'.$_POST['email'].'"';
                    }
                ?> 
            >

            <div class="erro"><?php 
                                if(isset($usuario->erro["erro_email"])){
                                    echo $usuario->erro["erro_email"];
                                    }
                                ?>
            </div>
        </div>

        <div class="div-style">
            <label>Senha (mínimo de 6 dígitos):</label><br>
            <input type="password" name="senha" class="input-style" placeholder="Digite sua Senha" required
                <?php 
                    if(isset($_POST['senha'])){
                        echo'value="'.$_POST['senha'].'"';
                    }
                ?>
            >

            <div class="erro"><?php 
                                if(isset($usuario->erro["erro_senha"])){
                                    echo $usuario->erro["erro_senha"];
                                }
                            ?>
            </div>
        </div>

        <div class="div-style">
            <label>Repita a Senha:</label><br>
            <input type="password" name="repete_senha" class="input-style" placeholder="Repita sua Senha" required
                <?php 
                    if(isset($_POST['repete_senha'])){
                        echo'value="'.$_POST['repete_senha'].'"';
                    }
                ?> 
            >

            <div class="erro"><?php 
                                if(isset($usuario->erro["erro_repete"])){
                                    echo $usuario->erro["erro_repete"];
                                    }
                                ?>
            </div>
        </div>

        <div class="div-style">
            <input type="checkbox" name="termos" required> 
            <label id="termos-style">Ao se cadastrar você concorda com a nossa Política de Privacidade e os Termos de uso</label>
        </div>

        <div class="div-style">
            <button type="submit" class="btn-style">Fazer Login</button>    
        </div>

        <div class="div-style">
            <a href="index.php">Já tenho cadastro</a>    
        </div>
    </form>

</body>
</html>