<?php 
include ('includes/dashboard.php');

// Impedindo entrada desnecessária
if (!isset($_POST['action']) && !isset($_REQUEST['em'])) {
	header('Location: medicamentos.php');
}


// Editando o medicamento
if(isset($_POST['action'])){
	$idMedicamento = $_POST['idMedicamento'];
	if (empty($_POST['nomeNM'])) {$nome = "";}else{$nome = $_POST['nomeNM'];}
	if (empty($_POST['precoNM'])) {$preco = "";}else{$preco = $_POST['precoNM'];}
	if (empty($_POST['quantidadeNM'])) {$quantidade = "";}else{$quantidade = $_POST['quantidadeNM'];}
	if (empty($_POST['receitaNM'])) {$receita = "";}else{$receita = $_POST['receitaNM'];}
	if (empty($_POST['caracteristicasNM'])) {$caracteristicas = "";}else{$caracteristicas = $_POST['caracteristicasNM'];}

	$queryEditar = "UPDATE medicamentos SET nome='$nome', preco='$preco', quantidade='$quantidade', receita='$preco', caracteristicas='$caracteristicas' WHERE idMedicamento='$idMedicamento'";
	$conexao->query($queryEditar);
	header('Location: medicamentos.php?msg=success');
	exit;
}


// Buscando medicamento
if (isset($_REQUEST['em'])) {
	$queryMedicamento = "SELECT * FROM medicamentos WHERE idMedicamento = '".$_REQUEST['em']."'";
	$eQueryMedicamento = mysqli_query($conexao, $queryMedicamento);
	while ($medicamento = mysqli_fetch_array($eQueryMedicamento)){
	  	$nome = $medicamento['nome'];
	  	$preco = $medicamento['preco'];
	  	$quantidade = $medicamento['quantidade'];
	  	$receita = $medicamento['receita'];
	  	$caracteristicas = $medicamento['caracteristicas']; ?>

	  		<div style="padding: 1rem;">
		  		<form method="post">
				  <input type="hidden" name="action" value="action">
				  <input type="hidden" name="idMedicamento" value="<?= $_REQUEST['em']?>">
				  <div class="mb-3">
					<label for="nome" class="form-label">Nome</label>
					<input type="text" class="form-control" name="nomeNM" value="<?= $nome?>">
				  </div>
				  <div class="mb-3">
					<label for="preco" class="form-label">Preço</label>
					<input type="text" class="form-control" id="precoNM" name="precoNM" value="<?= $preco?>">
				  </div>
				  <div class="mb-3">
					<label for="quantidade" class="form-label">Quantidade</label>
					<input type="number" class="form-control" name="quantidadeNM" value="<?= $quantidade?>">
				  </div>
				  <div class="mb-3">
					<label for="receita" class="form-label">Necessita receita:</label><br>
					<input type="radio" value="s" name="receitaNM" <?php if ($receita == "s"){echo "checked";} ?>><label style="margin: 0 0.5rem;">SIM</label>
					<input type="radio" value="n" name="receitaNM" <?php if ($receita == "n"){echo "checked";} ?>><label style="margin-left: 0.5rem;">NÃO</label>
				  </div>
				  <div class="mb-3">
					<label for="caracteristicas" class="form-label">Características</label><br>
					<textarea name="caracteristicasNM" rows="3" style="width: 100%;"><?= $caracteristicas ?></textarea>
				  </div>

				  <br>
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
	// Máscaras dos formulario novo medicamento
	$(document).ready(function(){
        $('#precoNM').mask("##0.00", {reverse: true});
    });
</script>
