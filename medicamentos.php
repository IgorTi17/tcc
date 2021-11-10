<?php 
include ('includes/dashboard.php');

//função para upload de arquivos
function upLoadPic2($name, $id)
{
    $cl = trim($name['name']);
    $ext = pathinfo($cl, PATHINFO_EXTENSION);

    $id     = time() . "_" . rand(10000000, 90000000) . "." . $ext;

    $pic = "";
    $fileName = "";
    if (isset($cl) and $cl != "") {
        $temp_fileName = explode(".", $name['name']);
        if (!file_exists("upload_files/"))
            mkdir("upload_files/", 0777);
        $uploadDir = "upload_files/";
        $uploadFile = $uploadDir . $id;
        if (move_uploaded_file($name['tmp_name'], $uploadFile)) {
            return $id;
        } else {
            return "error";
        }
    }
}

//Novo medicamento
if(isset($_POST['action']) && $_POST['action'] == "novoMedicamento"){
	if ($_FILES['bulaNM']['name'] != '') {
        $upload1 = time() . '_' . $_FILES['bulaNM']['name'];
        $nomeBula = upLoadPic2($_FILES['bulaNM'], $upload1);
    }
    if ($_FILES['imagemNM']['name'] != '') {
        $upload1 = time() . '_' . $_FILES['imagemNM']['name'];
        $nomeImg = upLoadPic2($_FILES['imagemNM'], $upload1);
    }
    $nome = $_POST['nomeNM'];
    $quantidade = $_POST['quantNM'];
    $preco = $_POST['precoNM'];
    $receita = $_POST['receitaNM'];
    $caracteristicas = $_POST['caracteristicas'];

    $query = "INSERT INTO medicamentos (`nome`, `preco`, `quantidade`, `bula`, `imagem`, `receita`, `caracteristicas`) VALUES ('".$nome."', '".$preco."', '".$quantidade."', '".$nomeBula."', '".$nomeImg."', '".$receita."', '".$caracteristicas."')";
    $conexao->query($query);
    header('location:medicamentos.php?msg=success');
    exit;
}

// Query medicamentos
$queryMedicamentos = "SELECT * FROM medicamentos";
$eQueryMedicamentos = mysqli_query($conexao, $queryMedicamentos);
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<style>
	.conteudoMedicamento{
		padding: 0.5rem;
	}
	.dataTables_filter input {
		margin-bottom: 6px;
	}
	@media (max-width: 600px){
		.desc{flex-direction: column !important;}
	}
</style>

<section class="conteudoMedicamento">
	<div style="display: flex; justify-content: space-between;">
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formularioMedicamento">Cadastrar novo medicamento</button>
	</div><br>

	<!-- Descrição medicamento -->
	<div id="div_descricao"></div>

	<!-- Modal formulario medicamento -->
	<div class="modal fade" id="formularioMedicamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Cadastrando Medicamento</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
			<form method="POST" enctype="multipart/form-data">
			  <input type="hidden" name="action" value="novoMedicamento">

			  <div class="mb-3">
				<label for="nome" class="form-label">Nome</label>
				<input type="text" class="form-control" name="nomeNM">
			  </div>
			  <div class="mb-3">
				<label for="preco" class="form-label">Preço</label>
				<input type="text" class="form-control" id="precoNM" name="precoNM">
			  </div>
			  <div class="mb-3">
				<label for="quantidade" class="form-label">Quantidade</label>
				<input type="number" min="0" class="form-control" name="quantNM">
			  </div>
			  <div class="mb-3">
				<label for="bula" class="form-label">Insira PDF da bula</label>
				<input type="file" class="form-control" name="bulaNM">
			  </div>
			  <div class="mb-3">
				<label for="imagem" class="form-label">Insira imagem</label>
				<input type="file" class="form-control" name="imagemNM">
			  </div>
			  <div class="mb-3">
				<label for="receita" class="form-label">Necessita receita:</label><br>
				<input type="radio" value="s" name="receitaNM"><label style="margin: 0 0.5rem;">SIM</label>
				<input type="radio" value="n" name="receitaNM"><label style="margin-left: 0.5rem;">NÃO</label>
			  </div>
			  <div class="mb-3">
				<label for="receita" class="form-label">Características</label><br>
				<textarea name="caracteristicasNM" rows="3" style="width: 100%;"></textarea>
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
	
	<!-- TABELA DOS MEDICAMENTOS -->
	<table class="table display" id="tabelaMedicamentos" style="width: 100%;">
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
				$nMedicamentos = $medicamentos['nome'];
				$preco = $medicamentos['preco']; 	  
				$preco = number_format($preco, 2, ',', ' ');	?>		
	  			<tr>
			      <th><?= $medicamentos['nome'] ?></th>
			      <td><?= $medicamentos['quantidade']?></td>
			      <td>R$ <?= $preco?></td>
				  <td>
				  	<button class="btn btn-primary" onclick="abrirDescricao(<?= $medicamentos['idMedicamento'] ?>)">	Descrição <i class="fas fa-clipboard-list"></i>
				  	</button>
				  </td>
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
	  		echo "<tr><th>Nenhum medicamento foi encontrado.</th></tr>";
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
	// Máscaras do formulario novo medicamento
	$(document).ready(function(){
        $('#precoNM').mask("##0.00", {reverse: true});
    });

	// dataTable
	$(document).ready(function() {
        $('#tabelaMedicamentos').DataTable({
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

    //Abre descrição do medicamento 
    function abrirDescricao(id) {
    	var idMedicamento = id;

        $.ajax({
            url: 'includes/ajax/descricaoMedicamento.php',
            data: {
                'id': idMedicamento
            },
            type: 'POST',
            success: function(data) {
            	$("#div_descricao").empty();
            	var desc = data;
                $("#div_descricao").append(desc);
            }
        });

       	
    };

    //Fechar descrição do medicamento
    function fecharDescricao(){
    	$("#div_descricao").empty();
    }

    
</script>
