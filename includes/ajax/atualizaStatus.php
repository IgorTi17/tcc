<?php 
include('../../conexao.php');

$id=$_POST['id'];
$status=$_POST['status'];
if($status == "separando"){$newStatus="entrega";}
if($status == "entrega"){$newStatus="concluido";}
if($status == "concluido"){$newStatus="cancelado";}
if($status == "cancelado"){$newStatus="separando";}

$query = "UPDATE `pedidos` SET `status`='".$newStatus."' WHERE idPedido = '".$id."'";

if (mysqli_query($conexao, $query)) {
	echo '1';
}
	

