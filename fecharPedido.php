<?php 
include ('includes/dashboard.php');

if(isset($_POST['finalizar'])){
	$idPedido = $_POST['idPedido'];
	$idCliente = $_POST['idCliente'];
	$formaDePagamento = $_POST['formaDePagamento'];
	$total = $_POST['total'];
	$dataAtual = strtotime(date('Y-m-d H:i:00'));
	$troco = $_POST['troco'];
	

	$itemQuantArr = explode("|", $_POST['itensPedidoInput']);
	foreach ($itemQuantArr as $key => $value) {
		$item = explode("=", $value);
		$queryItensPedido = "INSERT INTO itens_pedido (`idPedido`,`medicamento`,`quantMedicamento`) VALUES ('".$idPedido."', '".$item[1]."', '".$item[0]."')";	
		$conexao->query($queryItensPedido);
	}

	$queryPedido = "INSERT INTO pedidos (`idCliente`,`dataAtual`,`total`,`formaDePagamento`,`troco`,`status`) VALUES ('".$idCliente."','".$dataAtual."','".$total."','".$formaDePagamento."','".$troco."','separando')";
	$conexao->query($queryPedido);
	
	header('location: pedidos-list.php');
	exit;
}
?>
<style>
	.conteudoImpressao{
		padding: 0.5rem;
	}
</style>
<section class="conteudoImpressao">
	<div class="card" style="padding: 0.5rem;">
		<div id="imprimir">
		<?php
			if (isset($_POST['viewer'])){
				//buscando numero do proximo pedido
				$r = mysqli_query($conexao, "SHOW TABLE STATUS LIKE 'pedidos'");
				$l = mysqli_fetch_array($r);
				$numeroPedido = $l['Auto_increment'];

				$total = $_POST['total'];
				if(isset($_POST['troco'])){$troco = $_POST['troco'];}else{$troco = 0;}

				date_default_timezone_set('America/Sao_Paulo');
				echo "<p><strong>DADOS DO CLIENTE</strong></p>";
				if(isset($_POST['nomeCliente']) && !empty($_POST['nomeCliente'])){
					echo "<strong><p>NOME - ".ucfirst($_POST['nomeCliente'])."</p>";
				}

				if($_POST['idCliente'] != 'n'){
					//informações do cliente
					$queryCliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE idCliente = '".$_POST['idCliente']."'");
	                $resultCliente = mysqli_fetch_array($queryCliente);
					$nomeCliente = $resultCliente["nome"];
					$endereco = $resultCliente["endereco"];
					$complemento = $resultCliente["complemento"];
					$telefone = $resultCliente["telefone"];
				
					echo "<strong><p>NOME - ".$nomeCliente."</p>";
					echo "<p>ENDEREÇO - ".$endereco."</p>";
					echo "<p>COMPLEMENTO - ".$complemento."</p>";
					echo "<p>TELEFONE - ".$telefone."</p>";
				}

				echo "<p>".date('d/m/Y \à\s H:i')."</p></strong>";
				echo "<hr>";

				echo "<p><strong>ITENS DO PEDIDO N° ".$numeroPedido."</strong></p>";
					//itens do pedido
					$medicamento = $_POST['medicamento'];
					$quantidadeMedicamento = $_POST['quantidadeMedicamento'];
					$tamanhoMedicamento = count($medicamento);
					$tamanhoMedicamento-=1;
					$itensPedidoInput="";

					for ($i=0; $i <= $tamanhoMedicamento; $i++) { 
						$idMedicamento = $medicamento[$i];
						$queryMedicamento = mysqli_query($conexao, "SELECT * FROM medicamentos where idMedicamento = '".$idMedicamento."'");
				    	$resultMedicamento = mysqli_fetch_array($queryMedicamento); 
				        echo "<p>".$quantidadeMedicamento[$i]."x ".$resultMedicamento['nome'];
				        $itensPedidoInput .= $quantidadeMedicamento[$i]."=".$idMedicamento."|";
					}

					$itensPedidoInput = substr($itensPedidoInput, 0, -1); 
					$inputItens = "<input type='hidden' name='itensPedidoInput' value='". $itensPedidoInput ."'>";

				echo "<hr>";

				echo "<p><strong>TAXA DE ENTREGA</strong></p>";
				if(isset($_POST['taxaEntrega'])){$taxaEntrega=$_POST['taxaEntrega'];}else{$taxaEntrega = 0;}
				$taxaEntrega = number_format($taxaEntrega, 2, ',', ' ');
				echo "<p>R$ ".$taxaEntrega."</p>";
				$taxaEntrega = str_replace(',', '.', $taxaEntrega);
				echo "<hr>";

				echo "<p><strong>FORMA DE PAGAMENTO</strong></p>";
				echo "<p>".$_POST['formaDePagamento']."</p>";
				echo "<hr>";

				if($troco > 0){
					$levarTroco = $troco - $total;
					$levarTroco = number_format($levarTroco, 2, ',', ' ');
					$troco = number_format($troco, 2, ',', ' ');
					echo "<strong><p>VALOR A COBRAR DO CLIENTE - R$ ".$troco."</p></strong>";
					echo "<strong><p>VALOR PARA LEVAR DE TROCO - R$ ".$levarTroco."</p></strong><br></div>"; 
					$troco = str_replace(',', '.', $troco);
				}else{
					$total = number_format($total, 2, ',', ' ');
					echo "<strong><p>VALOR A COBRAR DO CLIENTE - R$ ".$total."</p></strong><br></div>";
					$total = str_replace(',', '.', $total); 
				} ?>
				

				<form method="POST">
					<input type="hidden" name="finalizar">
					<?= $inputItens ?>
					<input type="hidden" name="idPedido" value="<?= $numeroPedido ?>">
					<?php if ($_POST['idCliente'] != 'n'){ ?>
						<input type="hidden" name="idCliente" value="<?= $_POST['idCliente'] ?>">
					<?php }else{ ?>
						<input type="hidden" name="idCliente" value="<?= $_POST['nomeCliente'] ?>">
					<?php } ?>
					<input type="hidden" name="total" value="<?= $total ?>">
					<input type="hidden" name="troco" value="<?= $troco ?>">
					<input type="hidden" name="formaDePagamento" value="<?= $_POST['formaDePagamento'] ?>">
					<button type="submit" style="width: 100%;" class='btn btn-primary imprimir'>Fechar pedido</button><br><br>
				</form>
					
				<a href="pedidos.php?idCliente=<?= $_POST['idCliente'] ?>"><button style="width: 100%;" class='btn btn-primary'>Corrigir pedido</button></a><br><br>

				<?php
			}
		?>
	</div>
</section>

<script src="js/bootstrap.min.js"></script>
<script src="js/imprimir.js"></script>
<?php
include ('includes/footer.php');
?>