<?php
include('../../conexao.php');

$cpfCnpj = $_POST['cpfCnpj'];

$query = "SELECT * FROM fornecedor WHERE cpfCnpj = '$cpfCnpj'";
$response = mysqli_query($conexao, $query);

if ($response->num_rows > 0) {
    echo '1';
} 

