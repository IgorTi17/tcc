<?php 
include('includes/dashboard.php'); 
date_default_timezone_set('America/Sao_Paulo');

//Busca avançada
if(isset($_POST['actionBA'])){
	if(empty($_POST['dataInicioBA'])){$dataInicioBA = "";}
	else{
		$dataInicioBA = strtotime(date($_POST['dataInicioBA'].' 00:00:00'));
		$dataInicioBA = " AND dataAtual > ".$dataInicioBA;
	} 
	if(empty($_POST['dataFimBA'])){$dataFimBA = "";}
	else{
		$dataFimBA = strtotime(date($_POST['dataFimBA'].' 23:59:59'));
		$dataFimBA = " AND dataAtual < ".$dataFimBA;
	}   
	if(empty($_POST['formaDePagamento'])){
		$formaDePagamento="";
	}else{
		$formaDePagamento = " AND formaDePagamento = '".$_POST['formaDePagamento']."'";
	}




	if(empty($_POST['numeroPedidoBA'])){$numeroBA = "";}else{$numeroBA = "AND idPedido = '".$_POST['numeroPedidoBA']."'";}
}else{
	$numeroBA="";$dataInicioBA="";$dataFimBA="";$formaDePagamento="";
}

$queryPedido = "SELECT * FROM pedidos WHERE idPedido != '' ".$numeroBA.$dataInicioBA.$dataFimBA.$formaDePagamento." ORDER BY idPedido";

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<style>
	.form-control{
		width: 95%;
	}
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
	<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#buscaAvancada" aria-expanded="false" aria-controls="collapseExample">
		Busca Avançada
	</button><br><br>

	<!-- Busca avançada -->
	<div class="collapse" id="buscaAvancada">
		<br><div class="card card-body">
	    	<form method="post">
	    		<input type="hidden" name="actionBA">
	    		<div class="row">
			    	<div class="col-lg-3">
			    		<div class="row">
			    			<label>Número do pedido</label>
			    		</div>
			    		<div class="row">
			    			<input type="number" name="numeroPedidoBA" class="form-control">
			    		</div>
			    	</div>
			    	<div class="col-lg-3">
			    		<div class="row">
			    			<label>Data início</label>
			    		</div>
			    		<div class="row">
			    			<input type="date" name="dataInicioBA" class="form-control">
			    		</div>
			    	</div>
			    	<div class="col-lg-3">
			    		<div class="row">
			    			<label>Data fim</label>
			    		</div>
			    		<div class="row">
			    			<input type="date" name="dataFimBA" class="form-control">
			    		</div>
			    	</div>
			    	<div class="col-lg-3">
			    		<div class="row">
			    			<label>Forma de pagamento</label>
			    		</div>
			    		<div class="row">
			    			<select name="formaDePagamento" class="form-control">
			    				<option value="">Selecione</option>
			    				<option value="dinheiro">Dinheiro</option>
			    				<option value="cartao">Cartão</option>
			    			</select>
			    		</div>
			    	</div>
			    </div><br>
			    <input type="submit" class="btn btn-primary" value="Buscar">
			    <input type="submit" class="btn btn-primary" onclick="limpar()" value="Limpar a busca">
	    	</form>
	  	</div>
	</div><br>

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
				$eQueryPedido = mysqli_query($conexao, $queryPedido);
				while ($resultPedido = mysqli_fetch_array($eQueryPedido)){
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
	// Limpando a busca avançada
    function limpar(){
		$("input").val("");
	}

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

    <?php
	if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'update') { ?>
        jQuery(document).ready(function() {
            Snackbar.show({
                text: 'Pedido atualizado!',
                actionTextColor: '#fff',
                backgroundColor: '#163d54',
                pos: 'top-right',
                duration: 2000
            });
        });
	<?php } ?>

	<?php
	if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'novoPedido') { ?>
        jQuery(document).ready(function() {
            Snackbar.show({
                text: 'Pedido feito com sucesso!',
                actionTextColor: '#fff',
                backgroundColor: '#163d54',
                pos: 'top-right',
                duration: 2000
            });
        });
	<?php } ?>
</script>