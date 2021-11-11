<?php 
include ('includes/dashboard.php');

// Buscando cliente e fazendo confirmação
if (isset($_REQUEST['ec']) && empty($_POST['action'])) {
	$queryCliente = "SELECT * FROM cliente WHERE idCliente = '".$_REQUEST['ec']."'";
	$eQueryCliente = mysqli_query($conexao, $queryCliente);
	while ($cliente = mysqli_fetch_array($eQueryCliente)){
		$nome = $cliente['nome'];
	  	$cpf = $cliente['cpf'];
	  	$telefone = $cliente['telefone'];
	  	$email = $cliente['email'];
	  	$complemento = $cliente['complemento'];
	  	$endereco = $cliente['endereco'];?>
	  	<h4 style='text-align: center; font-weight: bold;'>Tem certeza que deseja excluir o Cliente ?</h4><br>

	  	<h6 style='text-align: center;'>Nome: <?= $nome?></h6>
	  	<h6 style='text-align: center;'>CPF: <?= $cpf?></h6>
	  	<h6 style='text-align: center;'>Telefone: <?= $telefone?></h6>
	  	<h6 style='text-align: center;'>Email: <?= $email?></h6>
	  	<h6 style='text-align: center;'>Endereço: <?= $endereco?></h6>
	  	<h6 style='text-align: center;'>Complemento: <?= $complemento?></h6><br>

	  	<form method="post">
	  		<input type="hidden" name="action" value="action">
	  		<input type="hidden" name="idCliente" value="<?= $_REQUEST['ec']?>">
	  		<div class="d-flex justify-content-center">
	  			<button style="margin-right: 2rem;" class="btn btn-success" type="submit" name="sim" value="sim">Sim</button>
		  		<button class="btn btn-danger" type="submit" name="nao" value="nao">Não</button>
	  		</div>
	  	</form>

	<?php 
	}
}

// Deletando o cliente
if(isset($_POST['action'])){
	if (isset($_POST['nao'])) { header('Location: clientes.php');}
	if (isset($_POST['sim'])) { 
		$resposta = $_POST['sim'];
		$idCliente = $_POST['idCliente'];
		$queryDelete = "DELETE FROM `cliente` WHERE idCliente = '".$idCliente."'";
		$conexao->query($queryDelete);
		header('Location: clientes.php');
		exit;
	}
}

// Impedindo entrada desnecessária
if (!isset($_POST['action']) && !isset($_REQUEST['ec'])) {
	header('Location: clientes.php');
}

?>
<style>
	.conteudo{
		padding-top: 3rem;
		padding-bottom: 5rem;
	}
</style>
	


<?php
include ('includes/footer.php');
?>
