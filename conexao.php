<?php
$servername = "localhost";
$database = "4system";
$username = "root";
$password = "";

//Conexão ao servidor e seleção do banco de dados.
$conexao = mysqli_connect($servername, $username, $password, $database);
// Adicionar UTF8 ao banco caso precise.
mysqli_set_charset($conexao,"utf8");
?>