<?php include('includes/dashboard.php'); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<style>
	.conteudoPedidos{
		padding: 0.5rem;
	}
</style>

<section class="conteudoPedidos">
	<!-- TABELA DOS CLIENTES -->
	<table class="table display" id="tabelaClientes" style="width: 100%;">
	  <thead class="table-dark">
	      <tr>
		      <th scope="col">Nome</th>
		      <th scope="col">Telefone</th>
		      <th scope="col">Endereco</th>
		      <th scope="col">Complemento</th>
		      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>	  			
	  	<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
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