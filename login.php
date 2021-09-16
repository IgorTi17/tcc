<?php
session_start();
include('conexao.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])){
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];


$query = "select * from usuario where usuario = '{$usuario}' and senha = '{$senha}'";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);


while ($registro = mysqli_fetch_array($result)){						
	$acesso =  $registro['acesso'];
	$atendente = $registro['id_usuario'];
} 


if ($row == 1 && $acesso == "atendente") {
	$_SESSION['usuario'] = $usuario;
	$_SESSION['cargo'] = "atendente";
	header('Location: home.php');
	exit();
} 

else if ($row == 1 && $acesso == "adm") {
	$_SESSION['usuario'] = $usuario;
	$_SESSION['cargo'] = "adm";
	header('Location: home.php');
	exit();
}

else if ($row == 1 && $acesso == "estoquista") {
	$_SESSION['usuario'] = $usuario;
	$_SESSION['cargo'] = "estoquista";
	header('Location: home.php');
	exit();
}

else{
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}

?>

