<?php 
include ('includes/dashboard.php');

if (isset($_POST['action'])){
	var_dump($_POST);
	exit;
}

?>
<style>
	.lixeira{
		color: red;
		cursor: pointer;
	}
	@media (min-width: 992px){
		.lixeira{
			margin-top: 25px;
		}
	}
</style>

<div style='padding:15px;'>
    <h1 style= "text-align: center; font-family: Oswald; letter-spacing: 2px;"> Efetuar Pedidos </h1> <br>

    <h3 id="add_div_pedido" style="font-size: 3rem; cursor: pointer;"><i class="fas fa-plus-square text-success"></i></h3>
 
 	<form method="POST">
 		<input type="hidden" name="action">
		<div class="row" id="div_pedido">
			<div id="pedido_0" class="row" style="margin-bottom: 20px; padding-right: 0;">
				<div class="col-lg-9">
					<label>Medicamentos:</label>
					<select class="form-select" name="medicamento[]">
						<option selected>Selecione</option>
						<option value="1">Dipirona</option>
						<option value="2">Amocilina</option>
						<option value="3">Torcilax</option>
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
			<div class="col-lg-10"> </div>
			<div class="col-lg-2"> <br>
				<div class="row">
					<div class="col-lg-8">
						<button style="width: 100%;" type="submit" class="btn btn-primary">Enviar</button> 
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

<script>
	contador = 1;
    //Adiciona linha de pedido
    $( "#add_div_pedido" ).click(function() {
        var documents = '<div id="pedido_'+contador+'" class="row" style="margin-bottom: 20px; padding-right: 0;"><div class="col-lg-9"><label>Medicamentos:</label><select class="form-select" name="medicamento[]"><option selected>Selecione</option><option value="1">Dipirona</option><option value="2">Amocilina</option><option value="3">Torcilax</option></select></div><div class="col-lg-2"><label>Quantidade:</label><div class="row"><div class="col-lg-8"><input type="Number" name="quantidadeMedicamento[]" value="1" class="form-control" min="1"></div></div></div><div class="col-lg-1"><button onclick="excluePedido(this.value)" value="'+contador+'" class="btn"><i class="lixeira fas fa-trash-alt"></i></button></div></div>';

        $("#div_pedido").append(documents);
        contador++;
    });

    function excluePedido(id){
    	$('#pedido_' + id).empty();
    	$('#pedido_' + id).attr('style', 'margin-bottom: 0px');
    }
</script>
