<?php 
include ('includes/dashboard.php');

// Impedindo entrada desnecessária
if (!isset($_POST['action']) && !isset($_REQUEST['ef'])) {
	header('Location: fornecedores.php');
}


// Editando o fornecedor
if(isset($_POST['action'])){
	$idCliente = $_POST['idCliente'];
	if (empty($_POST['nomeNC'])) {$nome = "";}else{$nome = $_POST['nomeNC'];}
	if (empty($_POST['enderecoNC'])) {$endereco = "";}else{$endereco = $_POST['enderecoNC'];}
	if (empty($_POST['complementoNC'])) {$complemento = "";}else{$complemento = $_POST['complementoNC'];}
	if (empty($_POST['telefoneNC'])) {$telefone = "";}else{$telefone = $_POST['telefoneNC'];}
	if (empty($_POST['emailNC'])) {$email = "";}else{$email = $_POST['emailNC'];}
	if (empty($_POST['cpfNC'])) {$cpf = "";}else{$cpf = $_POST['cpfNC'];}
	

	$queryEditar = "UPDATE cliente SET nome='$nome', cpf='$cpf', endereco='$endereco', complemento='$complemento', telefone='$telefone', email='$email' WHERE idCliente='$idCliente'";
	$conexao->query($queryEditar);
	header('Location: clientes.php');
	exit;
}


// Buscando fornecedor
if (isset($_REQUEST['ef'])) {
	$queryCliente = "SELECT * FROM cliente WHERE idCliente = '".$_REQUEST['ef']."'";
	$eQueryCliente = mysqli_query($conexao, $queryCliente);
	while ($cliente = mysqli_fetch_array($eQueryCliente)){
		$nome = $cliente['nome']; 
	  	$endereco = $cliente['endereco'];
	  	$complemento = $cliente['complemento'];
	  	$telefone = $cliente['telefone'];
	  	$email = $cliente['email'];
	  	$cpf = $cliente['cpf']; ?>

	  		<div style="padding: 1rem;">
		  		<form method="post">
				  <input type="hidden" name="action" value="action">
				  <input type="hidden" name="idCliente" value="<?= $_REQUEST['ef']?>">

				  <div class="col-lg-12">
					<label for="endereco" class="form-label">Nome</label>
					<input type="text" class="form-control" name="nomeNC" value="<?= $nome?>">
				  </div><br>
				  <div class="row">
					  <div class="col-lg-6">
						<label for="telefone" class="form-label">Telefone</label>
						<input type="text" class="form-control telefoneNC" name="telefoneNC" value="<?= $telefone?>">
					  </div>
					  <div class="col-lg-6">
						<label for="nome" class="form-label">CPF</label>
						<input type="text" class="form-control" name="cpfNC" value="<?= $cpf?>" readonly>
					  </div>
				  </div><br>
				  <div class="col-lg-12">
					<label for="endereco" class="form-label">Endereço</label>
					<input type="text" class="form-control" name="enderecoNC" value="<?= $endereco?>">
				  </div><br>
				  <div class="col-lg-12">
					<label for="complemento" class="form-label">Complemento</label>
					<input type="text" class="form-control" name="complementoNC" value="<?= $complemento?>">
				  </div><br>
				  <div class="col-lg-12">
					<label for="email" class="form-label">E-mail</label>
					<input type="email" class="form-control" name="emailNC" value="<?= $email?>">
				  </div><br>

		          <button style="width: 100%;" type="submit" class="btn btn-primary">Salvar edição</button>
		      	  
				</form>
			</div>

	<?php }
}



?>


<?php
include ('includes/footer.php');
?>

<script src="js/jquery.js"></script>
<script src="js/jquery.mask.js"></script>

<script>
	// Máscaras dos formulario novo fornecedor
	$(document).ready(function(){
        $('.telefoneNC').mask("00000-0000", {reverse: true});
    });
</script>
