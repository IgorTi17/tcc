<?php include('includes/dashboard.php'); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<style>
	.conteudoPedidos{
		padding: 0.5rem;
	}
	.status-separando{padding: 0.5rem; background-color: #ffc107; border-radius: 10px; text-transform: uppercase;}
	.status-concluido{padding: 0.5rem; background-color: #28a745; border-radius: 10px; color: #fff; text-transform: uppercase;}
	.status-cancelado{padding: 0.5rem; background-color: #dc3545; border-radius: 10px; color: #fff; text-transform: uppercase;}
	.status-entrega{padding: 0.5rem; background-color: #007bff; border-radius: 10px; color: #fff; text-transform: uppercase;}
</style>

<section class="conteudoPedidos">
	<!-- TABELA DOS CLIENTES -->
	<table class="table display" id="tabelaClientes" style="width: 100%;">
	  <thead class="table-dark">
	      <tr>
		      <th scope="col" class="text-center">N°</th>
		      <th scope="col" class="text-center">Cliente</th>
		      <th scope="col" class="text-center">Data e Hora</th>
		      <th scope="col" class="text-center">Total</th>
		      <th scope="col" class="text-center">Forma de Pagamento</th>
		      <th scope="col" class="text-center">Status</th>
	    </tr>
	  </thead>
	  <tbody>
	 		<?php
				$queryPedido = mysqli_query($conexao, "SELECT * FROM pedidos ORDER BY idPedido");
				while ($resultPedido = mysqli_fetch_array($queryPedido)){
					//nomeCliente
					$queryNomeCliente = mysqli_query($conexao, "SELECT nome FROM cliente WHERE idCliente = '".$resultPedido['idCliente']."'");
					$resultNomeCliente = mysqli_fetch_array($queryNomeCliente);

					$dataAtual = $resultPedido['dataAtual'];
					$total = $resultPedido['total'];
					$total = number_format($total, 2, ',', ' ');
	  		?>	  			
			  	<tr>
					<th class="text-center"><?= $resultPedido['idPedido'] ?></th>
					<th class="text-center"><?= $resultNomeCliente['nome'] ?></th>
					<th class="text-center"><?= date('d/m/Y \à\s H:i', $dataAtual) ?></th>
					<th class="text-center">R$ <?= $total ?></th>
					<th class="text-center"><?= $resultPedido['formaDePagamento'] ?></th>
					<th class="text-center">
						<span class="status-<?= $resultPedido['status'] ?>"><?= $resultPedido['status'] ?></span>
					</th>
				</tr>
			<?php } ?>
	  </tbody>
	</table>
</section>

<?php include('includes/footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>	
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
<?php if ($_REQUEST['msg'] == 'novoPedido') { ?>
            jQuery(document).ready(function() {
                Snackbar.show({
                    text: 'Pedido feito com sucesso!',
                    actionTextColor: '#fff',
                    backgroundColor: '#163d54',
                    pos: 'top-right',
                    duration: 2000,
                });
            });
        <?php } ?>
</script>