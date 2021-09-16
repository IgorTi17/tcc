<?php 
include ('includes/dashboard.php');

// Excluindo cliente 

// Query clientes
$queryClientes = "SELECT * FROM cliente";
$eQueryClientes = mysqli_query($conexao, $queryClientes);
?>

<style> .some{display:nome;}.conteudoFornecedor{padding: 0.5rem;}</style>
<section class="conteudoFornecedor">
	<div style="display: flex; justify-content: space-between;">
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formularioFornecedor">Cadastrar novo cliente</button>
	</div><br>

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
	  	<?php
	  		$nCliente = "";
	  		while ($clientes = mysqli_fetch_array($eQueryClientes)){ $nCliente = $clientes['nome']; ?>	  			
	  			<tr>
			      <th><?= $clientes['nome'] ?></th>
			      <td><?= $clientes['telefone']?></td>
			      <td><?= $clientes['endereco']?></td>
			      <td><?= $clientes['complemento']?></td>
			      <td>
			      	<a href=''><button type='button' class='btn btn-warning'>
					  <i class='fas fa-edit'></i>
					</button></a>
			      	<a href='exclusaoCliente.php?ec=<?= $clientes['idCliente'] ?>'><button type='button' class='btn btn-danger'>
					  <i class='fas fa-trash-alt'></i>
					</button></a>			      
				  </td>
			    </tr>
	  	<?php } 
	  	if ($nCliente == "") {
	  		echo "<tr><th>Nenhum cliente foi encontrado.</th></tr>";
	  	} ?>
	    
	  </tbody>
	</table>
</section>

<?php
include ('includes/footer.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>	
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
	// dataTable
	$(document).ready(function() {
        $('#tabelaClientes').DataTable({
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
        	"pageLength": 3,
        	"scrollX": true
        });
    } );
</script>
