<?php 
include ('includes/dashboard.php');

// Buscando fornecedores e fazendo confirmação
if (isset($_REQUEST['ef']) && empty($_POST['action'])) {
	$queryFornecedor = "SELECT * FROM fornecedor WHERE idFornecedor = '".$_REQUEST['ef']."'";
	$eQueryFornecedor = mysqli_query($conexao, $queryFornecedor);
	while ($fornecedor = mysqli_fetch_array($eQueryFornecedor)){
		if($fornecedor['nome'] != ""){$nome = $fornecedor['nome']; } 
	  	else{$nome = $fornecedor['razao_social']; }
	  	$cpfCnpj = $fornecedor['cpfCnpj'];
	  	$telefone = $fornecedor['telefone'];
	  	$email = $fornecedor['email'];?>
	  	<h4 style='text-align: center; font-weight: bold;'>Tem certeza que deseja excluir o Fornecedor ?</h4><br>

	  	<h6 style='text-align: center;'>Fornecedor: <?= $nome?></h6>
	  	<h6 style='text-align: center;'>CPF/CNPJ: <?= $cpfCnpj?></h6>
	  	<h6 style='text-align: center;'>Telefone: <?= $telefone?></h6>
	  	<h6 style='text-align: center;'>Email: <?= $email?></h6><br>

	  	<form method="post">
	  		<input type="hidden" name="action" value="action">
	  		<input type="hidden" name="idFornecedor" value="<?= $_REQUEST['ef']?>">
	  		<div class="d-flex justify-content-center">
	  			<button style="margin-right: 2rem;" class="btn btn-success" type="submit" name="sim" value="sim">Sim</button>
		  		<button class="btn btn-danger" type="submit" name="nao" value="nao">Não</button>
	  		</div>
	  	</form>

	<?php 
	}
}

// Deletando o fornecedor
if(isset($_POST['action'])){
	if (isset($_POST['nao'])) { header('Location: fornecedores.php');}
	if (isset($_POST['sim'])) { 
		$resposta = $_POST['sim'];
		$idFornecedor = $_POST['idFornecedor'];
		$queryDelete = "DELETE FROM `fornecedor` WHERE idFornecedor = '".$idFornecedor."'";
		$conexao->query($queryDelete);
		header('Location: fornecedores.php');
		exit;
	}
}

// Impedindo entrada desnecessária
if (!isset($_POST['action']) && !isset($_REQUEST['ef'])) {
	header('Location: fornecedores.php');
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
