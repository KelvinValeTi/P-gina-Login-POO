<?php
    session_start();
    
    //configurações do banco de dados
    define('SERVIDOR', 'localhost');
    define('USUARIO','root');
    define('SENHA','');
    define('BANCO','login');


    function limpaPost($dados){
        $dados=trim($dados);
        $dados = stripslashes($dados);
        $dados = htmlspecialchars($dados);
        return $dados;
    }

?>