<?php 
include ('includes/dashboard.php');

// Excluindo cliente 

// Query medicamentos
$queryMedicamentos = "SELECT * FROM medicamentos";
$eQueryMedicamentos = mysqli_query($conexao, $queryMedicamentos);
?>

<style> .some{display:nome;}.conteudoFornecedor{padding: 0.5rem;}</style>

<section class="conteudoFornecedor">
	<div style="display: flex; justify-content: space-between;">
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formularioFornecedor">Cadastrar novo medicamento</button>
		<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#buscaAvancada" aria-expanded="false" aria-controls="collapseExample">
		    Buscar Medicamento
		</button>
	</div><br>

	<div class="collapse" id="buscaAvancada">
		<br><div class="card card-body">
			<form>
			  <div class="mb-3" style="width:40%">
				<label for="exampleInputEmail1" class="form-label">Nome do Medicamento</label>
				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
			  </div>
			  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#remedio" aria-expanded="false" aria-controls="collapseExample">Buscar</button>
			</form>
			
			<div class="collapse" id="remedio">
				<div class="card" style="width: 18rem; margin: 0 auto;">
				  <img src="images/dipirona.jpg" class="card-img-top" alt="...">
				  <div class="card-body">
					<h5 style="text-align:center;" class="card-title"><strong>Dipirona</strong></h5><br>
					<p class="card-text"><strong>QUANTIDADE:</strong> 50</p>
					<p class="card-text"><strong>PREÇO:</strong> R$ 5,94</p>
					<p class="card-text" style="text-align: justify;"><strong>MODO DE USAR:</strong> Adultos e adolescentes acima de 15 anos: 1 a 2 comprimidos até 4 vezes ao dia. Doses maiores, somente a critério médico.</p>
					<div style="text-align: center;">
						<a style="width: 100%;" href="bula/dipirona.pdf" class="btn btn-primary" target="_blanc">Leia a Bula</a>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div><br>
	
	<!-- TABELA DOS CLIENTES -->
	<table class="table display" id="tabelaFornecedor">
	  <thead class="table-dark">
	      <tr>
		      <th scope="col">Nome</th>
		      <th scope="col">Quantidade</th>
		      <th scope="col">Preço</th>
			  <th scope="col">Informações</th>
		      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$nCliente = "";
	  		while ($medicamentos = mysqli_fetch_array($eQueryMedicamentos)){ 
				$nMedicamentos = $medicamentos['nome']; ?>	  			
	  			<tr>
			      <th><?= $medicamentos['nome'] ?></th>
			      <td><?= $medicamentos['quantidade']?></td>
			      <td><?= $medicamentos['preco']?></td>
				  <td><button class="btn btn-primary">Descrição <i class="fas fa-clipboard-list"></i></button></td>
			      <td>
			      	<a href='#'><button type='button' class='btn btn-warning'>
					  <i class='fas fa-edit'></i>
					</button></a>
			      	<a href='#'><button type='button' class='btn btn-danger'>
					  <i class='fas fa-trash-alt'></i>
					</button></a>			      
				  </td>
			    </tr>
	  	<?php } 
	  	if ($nMedicamentos == "") {
	  		echo "<tr><th>Nenhum cliente foi encontrado.</th></tr>";
	  	} ?>
	    
	  </tbody>
	</table>
</section>


<?php
include ('includes/footer.php');
?>

<script src="js/bootstrap.min.js"></script>
