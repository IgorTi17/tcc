<?php 
include ('includes/dashboard.php');

if (!isset($_REQUEST['id'])){
	header('location:pedidos-list.php');
}

$queryPedido = mysqli_query($conexao, "SELECT * FROM pedidos WHERE idPedido = '".$_REQUEST['id']."'");
while ($resultPedido = mysqli_fetch_array($queryPedido)){
	$idCliente = $resultPedido['idCliente'];
	$dataAtual = date('d/m/Y \à\s H:i', $resultPedido['dataAtual']);
	$taxa = $resultPedido['taxa'];
	$formaDePagamento = $resultPedido['formaDePagamento'];
	$troco = $resultPedido['troco'];
	$total = $resultPedido['total'];
}

if (is_numeric($idCliente)){
	$queryCliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE idCliente = '".$idCliente."'");
	while ($resultCliente = mysqli_fetch_array($queryCliente)){
		$nomeCliente = $resultCliente['nome'];
		$enderecoCliente = $resultCliente['endereco'];
		$complementoCliente = $resultCliente['complemento'];
		$telefoneCliente = $resultCliente['telefone'];
	}
}else{
	$nomeCliente = $idCliente;
}

?>

<section class="conteudoImpressao">
	<div class="card" style="padding: 0.5rem;">
		<div class="card" style="padding: 0.5rem;">
			<div id="imprimir">
				<?php
					date_default_timezone_set('America/Sao_Paulo');
					echo "<p><strong>DADOS DO CLIENTE</strong></p>";

					echo "<strong><p>NOME - ".$nomeCliente."</p>";
					if (is_numeric($idCliente)){
						echo "<p>ENDEREÇO - ".$enderecoCliente."</p>";
						echo "<p>COMPLEMENTO - ".$complementoCliente."</p>";
						echo "<p>TELEFONE - ".$telefoneCliente."</p>";
					}
					echo "<p>".$dataAtual."</p></strong>";
					echo "<hr>";

					echo "<p><strong>ITENS DO PEDIDO N° ".$_REQUEST['id']."</strong></p>";
						// itens do pedido
						$queryItens = mysqli_query($conexao, "SELECT * FROM itens_pedido WHERE idPedido = '".$_REQUEST['id']."'");
						while ($resultItens = mysqli_fetch_array($queryItens)){
							$queryNomeMedicamento = mysqli_query($conexao, "SELECT * FROM medicamentos WHERE idMedicamento = '".$resultItens['medicamento']."'");
							$resultNomeMed = mysqli_fetch_array($queryNomeMedicamento);
							$nomeMed   = $resultNomeMed["nome"];

							echo "<p>".$resultItens['quantMedicamento']."x ".$nomeMed."</p>";
						}

					echo "<hr>";

					echo "<p><strong>TAXA DE ENTREGA</strong></p>";
					$taxa = number_format($taxa, 2, ',', ' ');
					echo "<p>R$ ".$taxa."</p>";
					echo "<hr>";

					echo "<p><strong>FORMA DE PAGAMENTO</strong></p>";
					echo "<p>".$formaDePagamento."</p>";
					echo "<hr>";

					if($troco > 0){
						$levarTroco = $troco - $total;
						$levarTroco = number_format($levarTroco, 2, ',', ' ');
						$troco = number_format($troco, 2, ',', ' ');
						echo "<strong><p>VALOR A COBRAR DO CLIENTE - R$ ".$troco."</p></strong>";
						echo "<strong><p>VALOR PARA LEVAR DE TROCO - R$ ".$levarTroco."</p></strong><br>"; 
						$troco = str_replace(',', '.', $troco);
					}else{
						$total = number_format($total, 2, ',', ' ');
						echo "<strong><p>VALOR A COBRAR DO CLIENTE - R$ ".$total."</p></strong><br>";
						$total = str_replace(',', '.', $total); 
					}
				?>
			</div>
			<button style='width: 100%;' class='btn btn-primary imprimir'>REIMPRESSÃO</button><br>
		</div>
	</div>
</section>


<?php 
include ('includes/footer.php');
?>

<script src="js/imprimir.js"></script>