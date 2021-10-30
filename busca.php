<?php 
include ('includes/dashboard.php');
?>

<style>
</style>

<br>
<div style="margin: 0 auto">
	<button class="btn-sem-cliente btn btn-success btn-lg">Pedido sem cliente</button>
</div>
<br>


<div class="col-lg-4 card" style="margin: 0 2rem;">
	<form method="POST" style="padding: 1rem;">
		<h4 style="text-align: center;">Telefone do cliente</h4>
		<input class="form-control" id="telefone" type="text" name="telefone"><br>
		<input class="btn btn-primary btn-sm" style="width:100%;" type="submit" value="Buscar">
	</form>
</div><br>

<div style="display: flex; flex-wrap: wrap;">
	<?php 
	if(isset($_POST['telefone'])){
		$queryCliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE telefone = '".$_POST['telefone']."'");
		while ($cliente = mysqli_fetch_array($queryCliente)){ ?>
			<div class="col-lg-4 card" style="margin: 0.5rem 2rem; text-align: center;">
				<span>Nome: <?= $cliente['nome'] ?></span>
				<span>Endereço: <?= $cliente['endereco'] ?></span>
				<span>Telefone: <?= $cliente['telefone'] ?></span>
				<div style="display: flex; justify-content: space-between; margin-top: 0.3rem; padding: 0.5rem;">
					<form method="POST" action="pedidos.php">
						<button type="submit" name="idCliente" value="<?= $cliente['idCliente'] ?>" class="btn btn-primary">Fazer pedido</button>
					</form>
					<a href="editarCliente.php?ef=<?= $cliente['idCliente'] ?>"><button class="btn btn-warning">Editar</button></a>
					<a href="exclusaoCliente.php?ec=<?= $cliente['idCliente'] ?>"><button class="btn btn-danger">Excluir</button></a>
				</div>
			</div>
		<?php } 
	} ?>
</div>




<br><br><br>
<?php
include ('includes/footer.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>	
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mask.js"></script>

<script>
	// Máscaras dos formulario novo fornecedor
	$(document).ready(function(){
        $('#telefone').mask("00000-0000", {reverse: true});
    });
</script>
