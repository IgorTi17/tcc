<?php 
include ('includes/dashboard.php');
?>

<style>
	.conteudoBusca{padding: 1.5rem 2rem;}
	.btn-cliente{margin-bottom: 0.5rem;}
</style>

<div class="conteudoBusca">
	<div class="card">
		<br><div style="width: 100%;">
			<button style="width: 100%;" class="btn-sem-cliente btn btn-primary btn-lg">Pedido na loja</button>
		</div><br>

		<div style="margin-top: 0.8rem;">
			<a href="clientes.php?new-client=new"><button style="width: 100%;" class="btn btn-primary btn-lg">Cadastrar novo cliente</button></a>
		</div><br>

		<div class="card" style="margin: 0 2rem;">
			<form method="POST" style="padding: 1rem;">
				<h4 style="text-align: center;">Telefone do cliente</h4>
				<input class="form-control" id="telefone" type="text" name="telefone"><br>
				<input class="btn btn-primary" style="width:100%;" type="submit" value="Buscar">
			</form>
		</div><br>

		<div style="display: flex; flex-wrap: wrap; justify-content: center;">
			<?php 
			if(isset($_POST['telefone'])){
				$queryCliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE telefone = '".$_POST['telefone']."'");
				while ($cliente = mysqli_fetch_array($queryCliente)){ ?>
					<div class="col-lg-4 card" style="margin: 0.5rem 1.5rem; text-align: center;">
						<span>Nome: <?= $cliente['nome'] ?></span>
						<span>Endereço: <?= $cliente['endereco'] ?></span>
						<span>Telefone: <?= $cliente['telefone'] ?></span>
						<a style="margin-top: 0.3rem;" href="pedidos.php?idCliente=<?= $cliente['idCliente'] ?>"><button class="btn-cliente btn btn-primary">Fazer pedido</button></a>
						<div style="display: flex; justify-content: center; align-items: center;">
							
							<a style="margin-right: 0.5rem;" href="editarCliente.php?ef=<?= $cliente['idCliente'] ?>"><button class="btn-cliente btn btn-warning">Editar</button></a>
							<a href="exclusaoCliente.php?ec=<?= $cliente['idCliente'] ?>"><button class="btn-cliente btn btn-danger">Excluir</button></a>
						</div>
					</div>
				<?php } 
			} ?>
		</div>
	</div>
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
