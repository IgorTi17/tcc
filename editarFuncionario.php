<?php 
include ('includes/dashboard.php');

// Impedindo entrada desnecessária
if (!isset($_POST['action']) && !isset($_REQUEST['ef'])) {
	header('Location: funcionarios.php');
}


// Editando o medicamento
if(isset($_POST['action'])){
	$idFuncionario = $_POST['idFuncionario'];
	if (empty($_POST['usuarioNF'])) {$usuario = "";}else{$usuario = $_POST['usuarioNF'];}
	if (empty($_POST['senhaNF'])) {$senha = "";}else{$senha = $_POST['senhaNF'];}
	if (empty($_POST['acessoNF'])) {$acesso = "";}else{$acesso = $_POST['acessoNF'];}

	$queryEditar = "UPDATE usuario SET usuario='$usuario', senha='$senha', acesso='$acesso' WHERE id_usuario = '".$idFuncionario."'";
	$conexao->query($queryEditar);
	header('Location: funcionarios.php?msg=success');
	exit;
}


// Buscando medicamento
if (isset($_REQUEST['ef'])) {
	$queryFuncionario = "SELECT * FROM usuario WHERE id_usuario = '".$_REQUEST['ef']."'";
	$eQueryFuncionario = mysqli_query($conexao, $queryFuncionario);
	while ($funcionario = mysqli_fetch_array($eQueryFuncionario)){
	  	$usuario = $funcionario['usuario'];
	  	$senha = $funcionario['senha'];
	  	$acesso = $funcionario['acesso']; ?>

	  		<div style="padding: 1rem;">
		  		<form method="post">
				  <input type="hidden" name="action" value="action">
				  <input type="hidden" name="idFuncionario" value="<?= $_REQUEST['ef']?>">
				  <div class="mb-3">
					<label for="usuario" class="form-label">Nome</label>
					<input type="text" class="form-control" name="usuarioNF" value="<?= $usuario?>">
				  </div>
				  <div class="mb-3">
					<label for="senha" class="form-label">Senha</label>
					<input type="text" class="form-control" id="senhaNF" name="senhaNF" value="<?= $senha?>">
				  </div>
				  <div class="mb-3">
					<label for="receita" class="form-label">Cargo:</label><br>
					<input type="radio" value="adm" name="acessoNF" <?php if ($acesso == "adm"){echo "checked";} ?>><label style="margin: 0 0.5rem;">ADM</label>
					<input type="radio" value="estoquista" name="acessoNF" <?php if ($acesso == "estoquista"){echo "checked";} ?>><label style="margin-left: 0.5rem;">Estoquista</label>
                    <input type="radio" value="atendente" name="acessoNF" <?php if ($acesso == "atendente"){echo "checked";} ?>><label style="margin-left: 0.5rem;">Atendente</label>
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

