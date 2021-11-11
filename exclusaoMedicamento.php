<?php 
include ('includes/dashboard.php');

// Buscando medicamento e fazendo confirmação
if (isset($_REQUEST['em']) && empty($_POST['action'])) {
	$queryMedicamento = "SELECT * FROM medicamentos WHERE idMedicamento = '".$_REQUEST['em']."'";
	$eQueryMedicamento = mysqli_query($conexao, $queryMedicamento);
	while ($medicamento = mysqli_fetch_array($eQueryMedicamento)){
		$id = $medicamento['idMedicamento']; 
		$nome = $medicamento['nome']; 
	  	$preco = $medicamento['preco'];
	  	$preco = number_format($preco, 2, ',', ' ');
	  	$quantidade = $medicamento['quantidade'];?>
	  	<h4 style='text-align: center; font-weight: bold;'>Tem certeza que deseja excluir o Medicamento ?</h4><br>

	  	<h6 style='text-align: center;'>N°: <?= $id?></h6>
	  	<h6 style='text-align: center;'>Nome: <?= $nome?></h6>
	  	<h6 style='text-align: center;'>Preço: R$ <?= $preco?></h6>
	  	<h6 style='text-align: center;'>Quantidade: <?= $quantidade?></h6><br>

	  	<form method="post">
	  		<input type="hidden" name="action" value="action">
	  		<input type="hidden" name="idMedicamento" value="<?= $_REQUEST['em']?>">
	  		<div class="d-flex justify-content-center">
	  			<button style="margin-right: 2rem;" class="btn btn-success" type="submit" name="sim" value="sim">Sim</button>
		  		<button class="btn btn-danger" type="submit" name="nao" value="nao">Não</button>
	  		</div>
	  	</form>

	<?php 
	}
}

// Deletando o medicamento
if(isset($_POST['action'])){
	if (isset($_POST['nao'])) { header('Location: medicamentos.php');}
	if (isset($_POST['sim'])) { 
		$idMedicamento = $_POST['idMedicamento'];
		$queryDelete = "DELETE FROM `medicamentos` WHERE idMedicamento = '".$idMedicamento."'";
		$conexao->query($queryDelete);
		header('Location: medicamentos.php?msg=success');
		exit;
	}
}

// Impedindo entrada desnecessária
if (!isset($_POST['action']) && !isset($_REQUEST['em'])) {
	header('Location: medicamentos.php');
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
