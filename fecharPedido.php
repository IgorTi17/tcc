<?php 
include ('includes/dashboard.php');

if (isset($_POST['action'])) {
	//pedido
	$idCliente = $_POST['idCliente'];
	$dataAtual = strtotime("now");
	$total = "10.30";//Fazer sistema de somas dos itens do pedido
	$status = "separando";
	$formaDePagamento = $_POST['formaDePagamento'];
	if (isset($_POST['troco'])) {
			$troco = $_POST['troco'];
	}else{$troco = "0";}

	$queryPedido = "INSERT INTO `pedidos`(`idCliente`, `dataAtual`, `total`, `formaDePagamento`, `troco`, `status`) VALUES ('".$idCliente."','".$dataAtual."','".$total."','".$formaDePagamento."','".$troco."','".$status."')";
	//$conexao->query($queryPedido);
	echo $queryPedido;

	//itens do pedido
	$queryIdPedido = mysqli_query($conexao, "SELECT idPedido FROM pedidos ORDER BY idPedido DESC LIMIT 1");
    $resultIdPedido = mysqli_fetch_array($queryIdPedido);
	$idPedido   = $resultIdPedido["idPedido"];

	$medicamento = $_POST['medicamento'];
	$quantidadeMedicamento = $_POST['quantidadeMedicamento'];
	$tamanhoMedicamento = count($medicamento);
	$tamanhoMedicamento-=1;

	for ($i=0; $i <= $tamanhoMedicamento; $i++) { 
		$queryItensPedido = "INSERT INTO `itens_pedido`(`idPedido`, `medicamento`, `quantMedicamento`) VALUES ('".$idPedido."','".$medicamento[$i]."','".$quantidadeMedicamento[$i]."')";
        //$conexao->query($queryItensPedido);
        echo $queryItensPedido;
	}
		
	//('location:pedidos-list.php?msg=novoPedido');
	exit;
}
?>
<style>
	.conteudoImpressao{
		padding: 0.5rem;
	}
	h6{
		font-weight: bold;
	}
</style>
<section class="conteudoImpressao">
	<div class="card" style="padding: 0.5rem;">
		<?php
			if (isset($_POST['viewer'])){
				date_default_timezone_set('America/Sao_Paulo');
				//informações do cliente
				$queryCliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE idCliente = '".$_POST['idCliente']."'");
                $resultCliente = mysqli_fetch_array($queryCliente);
				$nomeCliente = $resultCliente["nome"];
				$endereco = $resultCliente["endereco"];
				$complemento = $resultCliente["complemento"];
				$telefone = $resultCliente["telefone"];


				echo "<h6>DADOS DO CLIENTE</h6><br>";
				echo "<strong><p>NOME - ".$nomeCliente."</p>";
				echo "<p>ENDEREÇO - ".$endereco."</p>";
				echo "<p>COMPLEMENTO - ".$complemento."</p>";
				echo "<p>TELEFONE - ".$telefone."</p>";
				echo "<p>".date('d/m/Y \à\s H:i')."</p></strong>";
				echo "<hr>";

				echo "<h6>ITENS DO PEDIDO N° 4587</h6>";
					//itens do pedido
					$queryIdPedido = mysqli_query($conexao, "SELECT idPedido FROM pedidos ORDER BY idPedido DESC LIMIT 1");
				    $resultIdPedido = mysqli_fetch_array($queryIdPedido);
					$idPedido   = $resultIdPedido["idPedido"];

					$medicamento = $_POST['medicamento'];
					$quantidadeMedicamento = $_POST['quantidadeMedicamento'];
					$tamanhoMedicamento = count($medicamento);
					$tamanhoMedicamento-=1;

					for ($i=0; $i <= $tamanhoMedicamento; $i++) { 
						$idMedicamento = $medicamento[$i];
						$queryMedicamento = mysqli_query($conexao, "SELECT * FROM medicamentos where idMedicamento = '".$idMedicamento."'");
				    	$resultMedicamento = mysqli_fetch_array($queryMedicamento); 
				        echo "<p>".$quantidadeMedicamento[$i]."x ".$resultMedicamento['nome'];
					}
				echo "<hr>";

				echo "<h6>TAXA DE ENTREGA</h6>";
				$_POST['taxaEntrega'] = number_format($_POST['taxaEntrega'], 2, ',', ' ');
				echo "<p>R$ ".$_POST['taxaEntrega']."</p>";
				$_POST['taxaEntrega'] = str_replace(',', '.', $_POST['taxaEntrega']);
				echo "<hr>";

				echo "<h6>FORMA DE PAGAMENTO</h6>";
				echo "<p>".$_POST['formaDePagamento']."</p>";
				echo "<hr>";

				echo "<strong><p>VALOR A COBRAR DO CLIENTE - R$ 15,00</p></strong>";
			}
		?>
	</div>
</section>

<script src="js/bootstrap.min.js"></script>
<?php
include ('includes/footer.php');
?>