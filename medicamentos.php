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
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formularioFornecedor">Cadastrar novo medicamento</button>
		<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#buscaAvancada" aria-expanded="false" aria-controls="collapseExample">
		    Botao Abrir
		</button>
	</div><br>

	<div class="collapse" id="buscaAvancada">
		<br><div class="card card-body">
	<!-- TABELA DOS CLIENTES -->
	<table class="table display" id="tabelaFornecedor">
	  <thead class="table-dark">
	      <tr>
		      <th scope="col">Nome</th>
		      <th scope="col">Telefone</th>
		      <th scope="col">Endereço</th>
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
			      	<a href='editarFornecedor.php?ec=<?= $clientes['idCliente'] ?>'><button type='button' class='btn btn-warning'>
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
	</div>
	</div><br>
</section>


<?php
include ('includes/footer.php');
?>

<script src="js/bootstrap.min.js"></script>
