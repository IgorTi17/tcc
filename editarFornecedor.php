<?php 
include ('includes/dashboard.php');

// Impedindo entrada desnecessária
if (!isset($_POST['action']) && !isset($_REQUEST['ef'])) {
	header('Location: fornecedores.php');
}


// Editando o fornecedor
if(isset($_POST['action'])){
	$idFornecedor = $_POST['idFornecedor'];
	if (empty($_POST['nomeNF'])) {$nome = "";}else{$nome = $_POST['nomeNF'];}
	if (empty($_POST['razao_socialNF'])) {$razao_social = "";}else{$razao_social = $_POST['razao_socialNF'];}
	if (empty($_POST['enderecoNF'])) {$endereco = "";}else{$endereco = $_POST['enderecoNF'];}
	if (empty($_POST['complementoNF'])) {$complemento = "";}else{$complemento = $_POST['complementoNF'];}
	if (empty($_POST['telefoneNF'])) {$telefone = "";}else{$telefone = $_POST['telefoneNF'];}
	if (empty($_POST['emailNF'])) {$email = "";}else{$email = $_POST['emailNF'];}
	if (empty($_POST['cpfNF'])) {
		$cpfCnpj = $_POST['cnpjNF'];
	}else{
		$cpfCnpj = $_POST['cpfNF'];
	}

	$queryEditar = "UPDATE fornecedor SET nome='$nome', razao_social='$razao_social', cpfCnpj='$cpfCnpj', endereco='$endereco', complemento='$complemento', telefone='$telefone', email='$email' WHERE idFornecedor='$idFornecedor'";
	$conexao->query($queryEditar);
	header('Location: fornecedores.php');
	exit;
}


// Buscando fornecedor
if (isset($_REQUEST['ef'])) {
	$queryFornecedor = "SELECT * FROM fornecedor WHERE idFornecedor = '".$_REQUEST['ef']."'";
	$eQueryFornecedor = mysqli_query($conexao, $queryFornecedor);
	while ($fornecedor = mysqli_fetch_array($eQueryFornecedor)){
		if($fornecedor['nome'] != ""){$nome = $fornecedor['nome']; $nrz = 1;} 
	  	else{$nome = $fornecedor['razao_social']; $nrz = 2;}
	  	$cpfCnpj = $fornecedor['cpfCnpj'];
	  	$endereco = $fornecedor['endereco'];
	  	$complemento = $fornecedor['complemento'];
	  	$telefone = $fornecedor['telefone'];
	  	$email = $fornecedor['email']; ?>

	  		<div style="padding: 3rem 5rem;">
		  		<form method="post">
				  <input type="hidden" name="action" value="action">
				  <input type="hidden" name="idFornecedor" value="<?= $_REQUEST['ef']?>">
				  <?php if($nrz == 1) {?>
					  <div class="mb-3">
						<label for="nome" class="form-label">Nome</label>
						<input type="text" class="form-control" name="nomeNF" value="<?= $nome?>">
					  </div>
				  <?php } ?>

				  <?php if($nrz == 2) {?>
					  <div class="mb-3">
						<label for="razao_social" class="form-label">Razão Social</label>
						<input type="text" class="form-control" name="razao_socialNF" value="<?= $nome?>">
					  </div>
				  <?php } ?>

				  <div class="row">
				  	  <?php if($nrz == 1) {?>
						  <div class="col-lg-6">
							<label for="cpf" class="form-label">CPF</label>
							<input type="text" class="form-control" name="cpfNF" value="<?= $cpfCnpj?>" Readonly>
						  </div>
					  <?php } ?>

					  <?php if($nrz == 2) {?>
						  <div class="col-lg-6">
							<label for="cnpj" class="form-label">CNPJ</label>
							<input type="text" class="form-control" name="cnpjNF" value="<?= $cpfCnpj?>" Readonly>
						  </div>
					  <?php } ?>

					  <div class="col-lg-6">
						<label for="telefone" class="form-label">Telefone</label>
						<input type="text" class="form-control telefoneNF" name="telefoneNF" value="<?= $telefone?>">
					  </div>
				  </div><br>
				  <div class="mb-3">
					<label for="endereco" class="form-label">Endereço</label>
					<input type="text" class="form-control" name="enderecoNF" value="<?= $endereco?>">
				  </div>
				  <div class="mb-3">
					<label for="complemento" class="form-label">Complemento</label>
					<input type="text" class="form-control" name="complementoNF" value="<?= $complemento?>">
				  </div>
				  <div class="mb-3">
					<label for="email" class="form-label">E-mail</label>
					<input type="email" class="form-control" name="emailNF" value="<?= $email?>">
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
        $('.telefoneNF').mask("00000-0000", {reverse: true});
    });
</script>
