<?php 
include ('includes/dashboard.php');
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<style>
	.conteudoSolicitacao{
		padding: 0.5rem;
	}
	.status-PENDENTE{background-color: #ffc107; text-transform: uppercase; font-weight: bold; border-radius: 5px;}
	
	.status-CONCLUIDO{background-color: #28a745; color: #fff; text-transform: uppercase; font-weight: bold; border-radius: 5px;}

	.status-CANCELADO{background-color: #dc3545; color: #fff; text-transform: uppercase; font-weight: bold; border-radius: 5px;}

	.dataTables_filter input {
		margin-bottom: 6px;
	}
</style>

<section class="conteudoSolicitacao">
<!-- TABELA DOS PEDIDOS -->
	<table class="table display" id="tabelaPedidos" style="width: 100%;">
	  <thead class="table-dark">
	      <tr>
		      <th scope="col" class="text-center">N°</th>
		      <th scope="col" class="text-center">Solicitante</th>
		      <th scope="col" class="text-center">Fornecedor</th>
		      <th scope="col" class="text-center">Data</th>
		      <th></th>
	    </tr>
	  </thead>
	  <tbody>
	 		<?php
				$eQuerySolicitacao = mysqli_query($conexao, "SELECT * FROM `history_solicitacao`");
				while ($resultSolicitacao = mysqli_fetch_array($eQuerySolicitacao)){
					//nomeFornecedor
					$queryNomeFornecedor = mysqli_query($conexao, "SELECT nome, razao_social FROM fornecedor WHERE idFornecedor = '".$resultSolicitacao['idFornecedor']."'");
					$resultNomeFornecedor = mysqli_fetch_array($queryNomeFornecedor);

					if(empty($resultNomeFornecedor['nome'])){
						$forne = $resultNomeFornecedor['razao_social'];
					}else{
						$forne = $resultNomeFornecedor['nome'];
					}

					//nomeUsuario
					$queryNomeUsuario = mysqli_query($conexao, "SELECT usuario FROM usuario WHERE id_usuario = '".$resultSolicitacao['idUsuario']."'");
					$resultNomeUsuario = mysqli_fetch_array($queryNomeUsuario);

					$dataSolicitacao = $resultSolicitacao['dataAtual'];
	  		?>	  			
			  	<tr>
					<th class="text-center"><?= $resultSolicitacao['idHistory'] ?></th>
					<th class="text-center"><?= ucfirst($resultNomeUsuario['usuario']) ?></th>
					<th class="text-center"><?= $forne ?></th>
					<th class="text-center"><?= date('d/m/Y', $dataSolicitacao) ?></th>
					<th class="text-center">
						<button id="status-<?= $resultSolicitacao['idHistory'] ?>" onclick="atualizaStatus(<?= $resultSolicitacao['idHistory'] ?>, '<?= $resultSolicitacao['status'] ?>')" class="btn btn-sm status-<?= $resultSolicitacao['status'] ?>"><?= $resultSolicitacao['status'] ?></button> 
					</th>
				</tr>
			<?php } ?>
	  </tbody>
	</table>
</section>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>	
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php
include ('includes/footer.php');
?>

<script>
	// dataTable
	$(document).ready(function() {
        $('table').DataTable({
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

    function atualizaStatus(id, status){
		$.ajax({
	        url: 'includes/ajax/atualizaStatusSolicitacao.php',
	        data: {
	            'id': id,
	            'status': status
	        },
	        type: 'POST',
	        success: function(data) {
	            if(data == 1){
	            	$(location).attr('href', 'solicitaoMedicamentos.php?msg=update');
	            }
	        }
	    });
	}

    <?php
	if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'update') { ?>
        jQuery(document).ready(function() {
            Snackbar.show({
                text: 'Status atualizado!',
                actionTextColor: '#fff',
                backgroundColor: '#163d54',
                pos: 'top-right',
                duration: 2000
            });
        });
	<?php } ?>
</script>