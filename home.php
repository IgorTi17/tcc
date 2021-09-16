<?php 
include ('includes/dashboard.php');

$queryClientes = mysqli_query($conexao, "SELECT * FROM cliente");
$totalClientes=0;
while ($clientes = mysqli_fetch_array($queryClientes)){ $totalClientes++;}

$queryFornecedores = mysqli_query($conexao, "SELECT * FROM fornecedor");
$totalFornecedores=0;
while ($Fornecedores = mysqli_fetch_array($queryFornecedores)){ $totalFornecedores++;}

$queryMedicamentos = mysqli_query($conexao, "SELECT * FROM medicamentos");
$totalMedicamentos=0;
while ($Medicamentos = mysqli_fetch_array($queryMedicamentos)){ $totalMedicamentos++;}

$queryFuncionarios = mysqli_query($conexao, "SELECT * FROM usuario");
$totalFuncionarios=0;
while ($Funcionarios = mysqli_fetch_array($queryFuncionarios)){ $totalFuncionarios++;}
?>

<style>
	.botoesIniciais{display: flex; width: 100%; justify-content: space-between;}
	.divBotao{margin: 0.3rem 1rem; width: 100%; font-weight: bold; border-radius: 10px;cursor: pointer;}

	.divBotao:nth-child(1){background-color: #DAA520;}
	.divBotao:nth-child(2){background-color: #00BFFF;}
	.divBotao:nth-child(3){background-color: #00FF7F;}
	.divBotao:nth-child(4){background-color: #836FFF;}

	.divTotal{display:flex;justify-content: center;margin:0 auto;font-size: 2.5rem;}

	@media (max-width: 992px){
		.botoesIniciais{
			flex-wrap: wrap;
		}
	}
</style>

<br>
<div class="botoesIniciais">
	<div class="divBotao botaoCliente">
		<div style="padding: 0.5rem 0 0 0.5rem">
			<p>CLIENTES</p>
		</div>
		<div class="divTotal">
			<p><?= $totalClientes?></p>
		</div>
	</div>
	<?php if ($_SESSION['cargo'] == "adm" OR $_SESSION['cargo'] == "estoquista") { ?>
		<div class="divBotao botaoFornecedor">
			<div style="padding: 0.5rem 0 0 0.5rem">
				<p>FORNECEDORES</p>
			</div>
			<div class="divTotal">
				<p><?= $totalFornecedores?></p>
			</div>
		</div>
	<?php } ?>
	
	<div class="divBotao botaoMedicamento">
		<div style="padding: 0.5rem 0 0 0.5rem">
			<p>MEDICAMENTOS</p>
		</div>
		<div class="divTotal">
			<p><?= $totalMedicamentos?></p>
		</div>
	</div>

	<?php if ($_SESSION['cargo'] == "adm") { ?>
		<div class="divBotao botaoFuncionarios">
			<a href="funcionarios.php" style="text-decoration:none; color: #000000;">
				<div style="padding: 0.5rem 0 0 0.5rem">
					<p>FUNCIONÁRIOS</p>
				</div>
				<div class="divTotal">
					<p><?= $totalFuncionarios?></p>
				</div>
			</a>
		</div>
	<?php } ?>
</div><br><br><br>

<?php
	include ('includes/charts/clientesMeses.php');
?>

<div class="testecliente some" style="margin: 0 10%;">
	<div class="card">
		<div class="card-header" style="text-align: center;">
			<h3 style="font-weight: bold;">Novos clientes por mês</h3>
		</div>
		<div class="card-body">
			<div id="novosClientesChart"></div>
		</div>
	</div>
</div>




<div class="testefornecedor some" style="margin: auto 10%;">
	<div class="card">
		<div class="card-header" style="text-align: center;">
			<h3 style="font-weight: bold;">Principais fornecedores</h3>
		</div>
		<div class="card-body">
			<div id="chart"></div>
		</div>
	</div>
</div>




<div class="testemedicamentos some" style="margin: auto 10%;">
	<div class="card">
		<div class="card-header" style="text-align: center;">
			<h3 style="font-weight: bold;">Medicamentos mais vendidos</h3>
		</div>
		<div class="card-body">
			<div id="medicamentosMaisVendidoschart"></div>
		</div>
	</div>
</div>


<?php
include ('includes/footer.php');
?>


<script src="js/menuHome.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/charts/clientesMeses.js"></script>
<script src="js/charts/medicamentosMaisVendidos.js"></script>

<script>
	var options = {
          series: [50, 80, 30, 20, 45],
          chart: {
          width: 650,
          type: 'pie',
        },
        labels: ['Nike', 'Cocacola', 'Kabum', 'Ana Lucia', 'Lucia'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };
		
		var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
</script>