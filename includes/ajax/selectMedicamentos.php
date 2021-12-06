<?php 
include('../../conexao.php');

$arrMed = "";
$data = [];
$idMedicamento = [];
$nome = [];

$query = "SELECT * FROM medicamentos WHERE quantidade > 0 ORDER BY nome ASC";
$eQuery = mysqli_query($conexao, $query);

while ($result = mysqli_fetch_array($eQuery)){
	$idMedicamento[] = "{$result['idMedicamento']}";
	$nome[] = "{$result['nome']}";
}

$data = ["idMedicamento" => $idMedicamento, "nome" => $nome];

echo json_encode($data);
	

