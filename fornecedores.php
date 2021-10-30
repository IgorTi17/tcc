<?php 
include ('includes/dashboard.php');
if ($_SESSION['cargo'] != "adm") {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit;
}


// RECEBENDO DADOS DO FORMULARIO DE NOVO FORNECEDOR
if (isset($_POST['action'])) { 
	if (!empty($_POST['nomeNF'])) {
		$nomeNF = $_POST['nomeNF'];
		$cpfCnpjNF = $_POST['cpfNF'];
		$razao_socialNF = "";
	}
	if (!empty($_POST['razao_socialNF'])) {
		$razao_socialNF = $_POST['razao_socialNF'];
		$cpfCnpjNF= $_POST['cnpjNF'];
		$nomeNF = "";
	}
	$enderecoNF = $_POST['enderecoNF'];
	$complementoNF = $_POST['complementoNF'];
	$telefoneNF = $_POST['telefoneNF'];
	$emailNF = $_POST['emailNF'];

	$sql = "INSERT INTO fornecedor (nome, razao_social, cpfCnpj, endereco, complemento, telefone, email) VALUES ('$nomeNF', '$razao_socialNF', '$cpfCnpjNF', '$enderecoNF', '$complementoNF', '$telefoneNF', '$emailNF')";
	$conexao->query($sql);

	header('Location: fornecedores.php?msg=success');
	exit;
}


// Query Buscando fornecedores
$queryFornecedor = "SELECT * FROM fornecedor WHERE cpfCnpj != '' ";


// Recebendo dados da busca avançada
if (isset($_POST['actionBA'])) {
	if (!empty($_POST['fornecedorBA'])) {
		$fornecedorBA = $_POST['fornecedorBA'];
		$queryFornecedor .= "AND (nome = '".$fornecedorBA."' OR razao_social = '".$fornecedorBA."') ";
	}
	if (!empty($_POST['cpfCnpjBA'])) {
		$cpfCnpjBA = $_POST['cpfCnpjBA'];
		$queryFornecedor .= "AND cpfCnpj = '".$cpfCnpjBA."' ";
	}
	if (!empty($_POST['telefoneBA'])) {
		$telefoneBA = $_POST['telefoneBA'];
		$queryFornecedor .= "AND telefone = '".$telefoneBA."' ";
	}
	if (!empty($_POST['emailBA'])) {
		$emailBA = $_POST['emailBA'];
		$queryFornecedor .= "AND email = '".$emailBA."' ";
	}
}

// Query fornecedores para solicitar medicamentos
$queryFornecedorSM = mysqli_query($conexao, "SELECT idFornecedor, nome, razao_social FROM fornecedor");
$nomesforne = [];
while ($fornecedorSM = mysqli_fetch_array($queryFornecedorSM)){
	if (empty($fornecedorSM['nome'])) {
		$nomesforne[] = $fornecedorSM['razao_social'];
	} else { 
		$nomesforne[] = $fornecedorSM['nome'];
	}
} 
sort($nomesforne);


// Executando query buscando fornecedores
$eQueryFornecedor = mysqli_query($conexao, $queryFornecedor);
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<style> .some{display:nome;}.conteudoFornecedor{padding: 0.5rem;}table{font-size: 14px;}
	.dataTables_filter input {
		margin-bottom: 6px;
	}
	.imputCuscaAvancada{
		margin: 10px auto;
	}
	@media (max-width: 600px){
		.imputCuscaAvancada{
			margin: 10px auto;
		}
	}
</style>

<section class="conteudoFornecedor">
	<!-- botão modal formulario fornecedor-->
	<div style="display: flex; justify-content: space-between;">
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formularioFornecedor">Cadastrar novo fornecedor</button>
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formularioSM">Solicitar medicamentos</button>
		<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#buscaAvancada" aria-expanded="false" aria-controls="collapseExample">
		    Busca Avançada
		</button>
	</div>

	<div class="collapse" id="buscaAvancada">
		<br><div class="card card-body">
	    	<form method="post">
	    		<input type="hidden" name="actionBA">
	    		<div class="row">
		    		<div class="col-lg-4">
		    			<div class="row">
			    			<label>Fornecedor</label>
			    		</div>
			    		<div class="row">
			    			<input type="text" name="fornecedorBA" class="form-control imputCuscaAvancada" value="<?php if(isset($_POST['fornecedorBA'])){ echo $_POST['fornecedorBA'];} ?>">
			    		</div>
			    	</div>
			    	<div class="col-lg-2">
			    		<div class="row">
			    			<label>CPF/CNPJ</label>
			    		</div>
			    		<div class="row">
			    			<input type="text" name="cpfCnpjBA" class="form-control imputCuscaAvancada" value="<?php if(isset($_POST['cpfCnpjBA'])){ echo $_POST['cpfCnpjBA'];} ?>">
			    		</div>
			    	</div>
			    	<div class="col-lg-2">
			    		<div class="row">
			    			<label>Telefone</label>
			    		</div>
			    		<div class="row">
			    			<input type="text" name="telefoneBA" class="form-control imputCuscaAvancada" value="<?php if(isset($_POST['telefoneBA'])){ echo $_POST['telefoneBA'];} ?>">
			    		</div>
			    	</div>
			    	<div class="col-lg-4">
			    		<div class="row">
			    			<label>Email</label>
			    		</div>
			    		<div class="row">
			    			<input type="text" name="emailBA" class="form-control imputCuscaAvancada" value="<?php if(isset($_POST['emailBA'])){ echo $_POST['emailBA'];} ?>">
			    		</div>
			    	</div>
			    </div>
			    <input type="submit" class="btn btn-primary" value="Buscar">
			    <input type="submit" class="btn btn-primary" onclick="limpar()" value="Limpar a busca">
	    	</form>
	  	</div>
	</div><br>


	<!-- Modal formulario fornecedor -->
	<div class="modal fade" id="formularioFornecedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Cadastrando Fornecedor</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
			<form method="post">
			  <input type="hidden" name="action" value="action">
			  <div class="custom-control custom-radio">
				<input type="radio" class="custom-control-input" id="radioCpf" name="cpfCnpj">
				<label class="custom-control-label" for="radioCpf" style="margin-right:30px;">Pessoa Física</label>
				
				<input type="radio" class="custom-control-input" id="radioCnpj" name="cpfCnpj" checked>
				<label class="custom-control-label" for="radioCnpj">Pessoa Jurídica</label>
			  </div><br>

			  <div class="mb-3 divNome some">
				<label for="nome" class="form-label">Nome</label>
				<input type="text" class="form-control" name="nomeNF">
			  </div>
			  <div class="mb-3 divRazaoSocial">
				<label for="razao_social" class="form-label">Razão Social</label>
				<input type="text" class="form-control" name="razao_socialNF">
			  </div>
			  <div class="mb-3 divPessoaFisica some">
				<label for="cpf" class="form-label">CPF</label>
				<input type="text" class="form-control cpfNF" name="cpfNF">
			  </div>
			  <div class="mb-3 divPessoaJuridica">
				<label for="cnpj" class="form-label">CNPJ</label>
				<input type="text" class="form-control cnpjNF" name="cnpjNF">
			  </div>
			  <div class="mb-3">
				<label for="endereco" class="form-label">Endereço</label>
				<input type="text" class="form-control" name="enderecoNF">
			  </div>
			  <div class="mb-3">
				<label for="complemento" class="form-label">Complemento</label>
				<input type="text" class="form-control" name="complementoNF">
			  </div>
			  <div class="mb-3">
				<label for="telefone" class="form-label">Telefone</label>
				<input type="text" class="form-control telefoneNF" name="telefoneNF">
			  </div>
			  <div class="mb-3">
				<label for="email" class="form-label">E-mail</label>
				<input type="email" class="form-control" name="emailNF">
			  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
	        <button type="submit" class="btn btn-primary">Cadastrar</button>
			</form>
	      </div>
	    </div>
	  </div>
	</div> 


	<!-- Modal formulario solicitar medicamentos -->
	<div class="modal fade" id="formularioSM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Solicitando medicamentos</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
		  	<form method="post" action="solicitandoMedicamento.php">
				<input type="hidden" name="actionSM" value="actionSM">
				<select class="form-select" id="select2SM" name="fornecedor" aria-label="Default select example">
					<option>Selecione</option>
					<?php
						foreach ($nomesforne as $nomesforneArr) { ?>
						    <option value="<?= $nomesforneArr ?>"><?= $nomesforneArr ?></option>
						<?php }
					?>
				</select><br>

				<div class="row center" style="margin: 0px;">
                    <label for="msgPedido" class="form-label">Mesangem do pedido</label><br>
                    <textarea class="col-lg-12" name="msgPedido" rows="5"></textarea>
                </div>
					
				</textarea>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
	        	<button type="submit" class="btn btn-primary">Solicitar</button>
			</form>
	      </div>
	    </div>
	  </div>
	</div> 


	<!-- TABELA DOS FORNECEDORES -->
	<table class="table display" id="tabelaFornecedor" style="width: 100%;">
	  <thead class="table-dark">
	      <tr>
		      <th scope="col">Fornecedor</th>
		      <th scope="col">CPF/CNPJ</th>
		      <th scope="col">Telefone</th>
		      <th scope="col">Email</th>
		      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$nForne = "";
	  		while ($fornecedor = mysqli_fetch_array($eQueryFornecedor)){ 
	  			if($fornecedor['nome'] != ""){$nome = $fornecedor['nome']; } 
	  			else{$nome = $fornecedor['razao_social']; } 
	  			$nForne = $fornecedor['cpfCnpj']; ?>
	  			<tr>
			      <th><?= $nome ?></th>
			      <td><?= $fornecedor['cpfCnpj']?></td>
			      <td><?= $fornecedor['telefone']?></td>
			      <td><?= $fornecedor['email']?></td>
			      <td>
			      	<div style="display: flex;">
				      	<a href='editarFornecedor.php?ef=<?= $fornecedor['idFornecedor'] ?>'><button type='button' class='btn btn-warning'>
						  <i class='fas fa-edit'></i>
						</button></a>
				      	<a style="margin-left: 5px;" href='exclusaoFornecedor.php?ef=<?= $fornecedor['idFornecedor'] ?>'><button type='button' class='btn btn-danger'>
						  <i class='fas fa-trash-alt'></i>
						</button></a>	
					</div>		      
				  </td>
			    </tr>
	  	<?php } 
	  	if ($nForne == "") {
	  		echo "<tr><th>Nenhum fornecedor foi encontrado.</th></tr>";
	  	} ?>
	    
	  </tbody>
	</table>

</section>

<?php
include ('includes/footer.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>	
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mask.js"></script>

<script> 
	// Formatando formulario novo fornecedor
	var cpfNF = document.querySelector(".cpfNF");	
	var radioCpf = document.querySelector("#radioCpf");	
	radioCpf.addEventListener('click', cpfCnpj);
	var cnpjNF = document.querySelector(".cnpjNF");
	var radioCnpj = document.getElementById("radioCnpj");
	radioCnpj.addEventListener('click', cpfCnpj);

	var divCpf = document.querySelector(".divPessoaFisica");	
	var divCnpj = document.querySelector(".divPessoaJuridica");
	var divNome = document.querySelector(".divNome");	
	var divRazaoSocial = document.querySelector(".divRazaoSocial");	

	function cpfCnpj(){
		if (radioCpf.checked){
			divCpf.classList.remove("some");
			divCnpj.classList.add("some");
			divNome.classList.remove("some");
			divRazaoSocial.classList.add("some"); }
		if (radioCnpj.checked){
			divCpf.classList.add("some");
			divCnpj.classList.remove("some");
			divNome.classList.add("some");
			divRazaoSocial.classList.remove("some"); }
	};
		
	// Máscaras dos formulario novo fornecedor
	$(document).ready(function(){
        $('.telefoneNF').mask("00000-0000", {reverse: true});
        $('.cpfNF').mask("000.000.000-00", {reverse: true});
        $('.cnpjNF').mask("00.000.000/0000-00", {reverse: true});
    });

	// Limpando a busca avançada
    function limpar(){
		$("input").val("");
		$("textarea").val("");
	}

	<?php if ($_REQUEST['msg'] == 'success') { ?>
            jQuery(document).ready(function() {
                Snackbar.show({
                    text: 'Salvo com sucesso!',
                    actionTextColor: '#fff',
                    backgroundColor: '#163d54',
                    pos: 'top-right',
                    duration: 2000,
                });
            });
        <?php } if ($_REQUEST['msg'] == 'send') { ?>
        		jQuery(document).ready(function() {
		            Snackbar.show({
		                text: 'Solicitado com sucesso!',
		                actionTextColor: '#fff',
		                backgroundColor: '#163d54',
		                pos: 'top-right',
		                duration: 2000,
		            });
		        });
        <?php } ?>

	// dataTable
	$(document).ready(function() {
        $('#tabelaFornecedor').DataTable({
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
    });
</script>
