<?php 
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "validacao";

    // Conexão com o banco
    $mysqli = new mysqli($host, $usuario, $senha, $banco);

    // Retorna se houver erros com a conexão
    if(mysqli_connect_errno()) trigger_error(mysqli_connect_errno());
?>