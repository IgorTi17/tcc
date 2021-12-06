<?php 
include('../../conexao.php');

$id = $_POST['id'];
$quant="";
$query = "SELECT * FROM medicamentos WHERE idMedicamento = '".$_POST['id']."' AND quantidade > 0";
$eQuery = mysqli_query($conexao, $query);
while ($result = mysqli_fetch_array($eQuery)){
	$quant=$result['quantidade'];
}

echo $quant;