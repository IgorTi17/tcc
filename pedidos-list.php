<?php include('includes/dashboard.php'); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<style>
	.conteudoPedidos{
		padding: 0.5rem;
	}
	.dataTables_filter input {
		margin-bottom: 6px;
	}
	.status-separando{background-color: #ffc107; text-transform: uppercase; font-weight: bold; border-radius: 5px;}
	
	.status-concluido{background-color: #28a745; color: #fff; text-transform: uppercase; font-weight: bold; border-radius: 5px;}

	.status-cancelado{background-color: #dc3545; color: #fff; text-transform: uppercase; font-weight: bold; border-radius: 5px;}

	.status-entrega{background-color: #007bff; color: #fff; text-transform: uppercase; font-weight: bold; border-radius: 5px;}
</style>

<section class="conteudoPedidos">
	<!-- TABELA DOS CLIENTES -->
	<table class="table display" id="tabelaPedidos" style="width: 100%;">
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
						<button id="status-<?= $resultPedido['idPedido'] ?>" onclick="atualizaStatus(<?= $resultPedido['idPedido'] ?>, '<?= $resultPedido['status'] ?>')" class="btn btn-sm status-<?= $resultPedido['status'] ?>"><?= $resultPedido['status'] ?></button> 
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
<script src="js/atualizaStatus.js"></script>

<script>
	// dataTable
	$(document).ready(function() {
        $('#tabelaPedidos').DataTable({
        	"oLanguage": {
				"oPaginate": {
					"sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
					"sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
				},
				"sInfo": "Mostrar p&#225;gina _PAGE_ de _PAGES_",
				"sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
				"sSearchPlaceholder": "Procurar...",
				"sLengthMenu": "Resultados :  _MENU_",
			},
        	"bLengthChange": false,
        	"pageLength": 5,
        	"scrollX": true
        });
    });

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
    <?php if ($_REQUEST['msg'] == 'update') { ?>
        jQuery(document).ready(function() {
            Snackbar.show({
                text: 'Pedido atualizado!',
                actionTextColor: '#fff',
                backgroundColor: '#163d54',
                pos: 'top-right',
                duration: 2000,
            });
        });
    <?php } ?>
</script>