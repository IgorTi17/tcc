<?php 
include ('includes/dashboard.php');

if (!isset($_REQUEST['idCliente'])) {
	session_destroy();
	header('location:index.php');
	exit;
}

?>
<style>
	.lixeira{
		color: red;
		cursor: pointer;
	}
	.labelValorTaxa{
		margin-right: 1rem;
	}
	@media (min-width: 992px){
		.lixeira{
			margin-top: 25px;
		}
	}
</style>

<div style='padding:15px;'>
	<?php if($_REQUEST['idCliente'] != 'n'){ ?>
		<h1 style= "text-align: center; font-family: Oswald, sans-serif; letter-spacing: 2px; "> Efetuar pedido </h1> <br>
	<?php }else{ ?>
    	<h1 style= "text-align: center; font-family: Oswald, sans-serif; letter-spacing: 2px; "> Efetuar pedido na loja </h1> <br>
	<?php } ?>

    <?php if($_REQUEST['idCliente'] != 'n'){ ?>
	    <hr>
	    <h4><strong>Dados do cliente</strong></h4>
	    <?php 
	    	$queryCliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE idCliente = '".$_REQUEST['idCliente']."' LIMIT 1");
	    	while ($resultCliente = mysqli_fetch_array($queryCliente)){ ?>
			    <p><strong>Nome:</strong> <?= $resultCliente['nome'] ?></p>
			    <p><strong>Endereço:</strong> <?= $resultCliente['endereco'] ?></p>
			    <p><strong>Complemento:</strong> <?= $resultCliente['complemento'] ?></p>
			    <p><strong>Telefone:</strong> <?= $resultCliente['telefone'] ?></p>
	    <?php } ?>
	    <hr>
	<?php }?>

    
 
 	<form method="POST" action="fecharPedido.php">
 		<?php 
 			if($_REQUEST['idCliente'] == 'n'){ ?>
 				<label>Nome cliente</label>
 				<input type="text" name="nomeCliente" id="nomeCliente" class="form-control">
 				<input type="checkbox" onchange="semNome(this)"><label style="margin-left: 0.5rem;">Sem nome</label><br><br>
 		<?php } ?>

 		<h3 id="add_div_pedido" style="font-size: 3rem; cursor: pointer; display: inline;"><i class="fas fa-plus-square text-success"></i></h3>

 		<input type="hidden" name="viewer">
 		<input type="hidden" name="idCliente" value="<?= $_REQUEST['idCliente'] ?>">
 		<input type="hidden" name="total" value="10.30">
		<div class="row" id="div_pedido">
			<div id="pedido_0" class="row" style="margin-bottom: 20px; padding-right: 0;">
				<div class="col-lg-9">
					<label>Medicamentos:</label>
					<select class="form-select" name="medicamento[]" required>
						<option selected>Selecione</option>
						<?php 
						$queryMed = mysqli_query($conexao, "SELECT * FROM medicamentos");
						while ($med = mysqli_fetch_array($queryMed)){ ?>
							<option value="<?= $med['idMedicamento'] ?>"><?= $med['nome'] ?></option>
						<?php } ?>
					</select>
				</div>	
				<div class="col-lg-2">
					<label>Quantidade:</label>
					<div class="row">
						<div class="col-lg-8">
							<input type="Number" name="quantidadeMedicamento[]" value="1" class="form-control" min="1">
						</div>	
					</div>		
				</div>
				<div class="col-lg-1">
					<button onclick="excluePedido(this.value)" value="0" class="btn"><i class="lixeira fas fa-trash-alt"></i></button>		
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<label>Forma de pagamento</label>
				<select class="form-control selectpicker" id="formaDePagamento" name="formaDePagamento">
					<option value="Dinheiro">Dinheiro</option>
					<option value="cartao">Cartão</option>
				</select>
			</div>
			<div class="col-lg-3" id="div_troco">
				<label>Troco</label>
				<input type="text" name="troco" id="troco" class="form-control" placeholder="Troco">
			</div>
			<?php if($_REQUEST['idCliente'] != 'n'){ ?>
				<div class="col-lg-4" id="div_troco">
					<label>Taxa de entrega</label><br>
	                <input type="radio" class="taxa2"  name="taxaEntrega" value="2" checked>
	                <label for="2Reais" class="labelValorTaxa">R$ 2,00</label>
	                <input type="radio" class="taxa3" name="taxaEntrega" value="3">
	                <label for="3Reais" class="labelValorTaxa">R$ 3,00</label><br>
	                <input type="radio" class="taxa4" name="taxaEntrega" value="4">
	                <label for="4Reais" class="labelValorTaxa">R$ 4,00</label>
	                <input type="radio" class="taxa5"  name="taxaEntrega" value="5">
	                <label for="5Reais" class="labelValorTaxa">R$ 5,00</label><br>
	                <input type="radio" class="taxa6" name="taxaEntrega" value="6">
	                <label for="6Reais" class="labelValorTaxa">R$ 6,00</label>
	                <input type="radio" class="taxa7" name="taxaEntrega" value="7">
	                <label for="7Reais" class="labelValorTaxa">R$ 7,00</label><br>
				</div>
			<?php } ?>
			<div class="col-lg-2"> <br>
				<div class="row">
					<div class="col-lg-9">
						<button style="width: 100%;" type="submit" class="btn btn-primary">Finalizar</button> 
					</div>	
				</div>	
		    </div>
		</div>
	</form>
</div>


<?php
include ('includes/footer.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="js/jquery.mask.js"></script>

<script>
	$(document).ready(function(){
	    $('#troco').mask("##0.00", {reverse: true});
	});
	contador = 1;
    //Adiciona linha de pedido
    $( "#add_div_pedido" ).click(function() {
        var documents = '<div id="pedido_'+contador+'" class="row" style="margin-bottom: 20px; padding-right: 0;"><div class="col-lg-9"><label>Medicamentos:</label><select class="form-select editaValor" name="medicamento[]" required><option selected>Selecione</option><option value="1">Dipirona</option><option value="2">Amocilina</option><option value="3">Torcilax</option></select></div><div class="col-lg-2"><label>Quantidade:</label><div class="row"><div class="col-lg-8"><input type="Number" name="quantidadeMedicamento[]" value="1" class="form-control editaValor" min="1"></div></div></div><div class="col-lg-1"><button onclick="excluePedido(this.value)" value="'+contador+'" class="btn"><i class="lixeira fas fa-trash-alt"></i></button></div></div>';

        $("#div_pedido").append(documents);
        contador++;
    });

    //Adicionar troco 
    campo = $("#formaDePagamento");
    campo.change(function() {
        campoValor = $("#formaDePagamento").val();
        $("#div_troco").empty();
        if(campoValor == 'dinheiro'){
            var div_conteudo ='<label>Troco</label><input type="text" name="troco" id="troco" class="form-control" placeholder="Troco">';
            $("#div_troco").append(div_conteudo);  
    		$('#troco').mask("##0.00", {reverse: true});
        }
    });

    function excluePedido(id){
    	$('#pedido_' + id).empty();
    	$('#pedido_' + id).attr('style', 'margin-bottom: 0px');
    }

    function semNome(campo){
    	if(campo.checked){
    		$('#nomeCliente').val('Sem nome');
    		$('#nomeCliente').attr('readonly', true);
    		$("#nomeCliente").css("cursor", "not-allowed");
    	}else{
    		$('#nomeCliente').val('');
    		$("#nomeCliente").css("cursor", "auto");
    		$('#nomeCliente').attr('readonly', false);
    	}
    }
</script>