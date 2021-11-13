<?php
include('../../conexao.php');

if(isset($_POST['inativar'])){
	$id = $_POST['inativar'];

	$query = "UPDATE `usuario` SET `status`='inativo' WHERE id_usuario = '".$id."'";

	if (mysqli_query($conexao, $query)) {
		echo '1';
	}
}

if(isset($_POST['ativar'])){
	$id = $_POST['ativar'];

	$query = "UPDATE `usuario` SET `status`='ativo' WHERE id_usuario = '".$id."'";

	if (mysqli_query($conexao, $query)) {
		echo '1';
	}
}