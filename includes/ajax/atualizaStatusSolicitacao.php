<?php 
include('../../conexao.php');

$id=$_POST['id'];
$status=$_POST['status'];
if($status == "PENDENTE"){$newStatus="CONCLUIDO";}
if($status == "CONCLUIDO"){$newStatus="CANCELADO";}
if($status == "CANCELADO"){$newStatus="PENDENTE";}

$query = "UPDATE `history_solicitacao` SET `status`='".$newStatus."' WHERE idHistory = '".$id."'";

if (mysqli_query($conexao, $query)) {
	echo '1';
}
	

