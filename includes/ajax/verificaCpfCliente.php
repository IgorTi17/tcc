<?php
include('../../conexao.php');

$cpf = $_POST['cpf'];
$query = "SELECT * FROM cliente WHERE cpf = '$cpf'";
$response = mysqli_query($conexao, $query);

if ($response->num_rows > 0) {
    echo '1';
} else {
    echo '0';
}

