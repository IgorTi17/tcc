<?php
include('includes/dashboard.php');

$querySeparando = mysqli_query($conexao, "SELECT count(*) AS separando FROM pedidos WHERE status = 'separando'");
$pedidosSeparando = 0;
while ($separando = mysqli_fetch_array($querySeparando)) {
    $pedidosSeparando = $separando['separando'];
}

$queryEntrega = mysqli_query($conexao, "SELECT count(*) AS entrega FROM pedidos WHERE status = 'entrega'");
$pedidosEntrega = 0;
while ($entrega = mysqli_fetch_array($queryEntrega)) {
    $pedidosEntrega = $entrega['entrega'];
}

$queryConcluido = mysqli_query($conexao, "SELECT count(*) AS concluido FROM pedidos WHERE status = 'concluido'");
$pedidosConcluido = 0;
while ($concluido = mysqli_fetch_array($queryConcluido)) {
    $pedidosConcluido = $concluido['concluido'];
}

$queryCancelado = mysqli_query($conexao, "SELECT count(*) AS cancelado FROM pedidos WHERE status = 'cancelado'");
$pedidosCancelado = 0;
while ($cancelado = mysqli_fetch_array($queryCancelado)) {
    $pedidosCancelado = $cancelado['cancelado'];
}

$queryTotalClientes = mysqli_query($conexao, "SELECT count(*) AS soma FROM cliente");
$totalClientes = 0;
while ($somaClientes = mysqli_fetch_array($queryTotalClientes)) {
    $totalClientes = $somaClientes['soma'];
}

$queryTotalFuncionarios = mysqli_query($conexao, "SELECT count(*) AS soma FROM usuario WHERE status = 'ativo' AND id_usuario != '" . $_SESSION['userid'] . "'");
$totalFuncionarios = 0;
while ($somaFuncionarios = mysqli_fetch_array($queryTotalFuncionarios)) {
    $totalFuncionarios = $somaFuncionarios['soma'];
}
?>

<link href='css/fullcalendar/main.css' rel='stylesheet' />
<link href='css/dashboard.css' rel='stylesheet' />

<style>
    .botoesIniciais {
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    .divBotao {
        margin: 0.3rem 1rem;
        width: 100%;
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
    }

    .divBotao:nth-child(1) {
        background-color: rgb(254, 176, 25);
    }

    .divBotao:nth-child(2) {
        background-color: rgb(0, 143, 251);
    }

    .divBotao:nth-child(3) {
        background-color: rgb(0, 227, 150);
    }

    .divBotao:nth-child(4) {
        background-color: rgb(255, 69, 96);
    }

    .divTotal {
        display: flex;
        justify-content: center;
        margin: 0 auto;
        font-size: 2.5rem;
    }

    .tituloChart {
        text-align: center;
        font-weight: bold;
    }

    .fc-col-header a, .fc-daygrid-day-top a{
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bold;
    }
    .fc-toolbar-title{
        color: var(--fc-button-bg-color, #2C3E50);
        font-weight: bold;
        text-transform: capitalize;
    }

    @media (max-width: 992px) {
        .botoesIniciais {
            flex-wrap: wrap;
        }
    }
</style>

<br>
<div class="botoesIniciais">
    <div class="divBotao">
        <a href="pedidos-list.php?status=separando" style="text-decoration:none; color: #000000;">
            <div style="padding: 0.5rem 0 0 0.5rem">
                <p>SEPARANDO</p>
            </div>
            <div class="divTotal">
                <p><?= $pedidosSeparando ?></p>
            </div>
        </a>
    </div>

    <div class="divBotao">
        <a href="pedidos-list.php?status=entrega" style="text-decoration:none; color: #000000;">
            <div style="padding: 0.5rem 0 0 0.5rem">
                <p>ENTREGA</p>
            </div>
            <div class="divTotal">
                <p><?= $pedidosEntrega ?></p>
            </div>
        </a>
    </div>

    <div class="divBotao">
        <a href="pedidos-list.php?status=concluido" style="text-decoration:none; color: #000000;">
            <div style="padding: 0.5rem 0 0 0.5rem">
                <p>CONCLUIDO</p>
            </div>
            <div class="divTotal">
                <p><?= $pedidosConcluido ?></p>
            </div>
        </a>
    </div>

    <div class="divBotao">
        <a href="pedidos-list.php?status=cancelado" style="text-decoration:none; color: #000000;">
            <div style="padding: 0.5rem 0 0 0.5rem">
                <p>CANCELADO</p>
            </div>
            <div class="divTotal">
                <p><?= $pedidosCancelado ?></p>
            </div>
        </a>
    </div>
</div><br><br><br>

<div class="row layout-top-spacing" style="margin: 0 0.5rem;">
    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-three">
            <div class="widget-content" style="height:450px">
                <div id="calendar" style="padding: 8px">
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-three">
            <div class="widget-content">
                <div id="chart"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" style="margin: 3rem 0;">
        <div class="widget widget-chart-three">
            <div class="widget-heading" style="margin-bottom:20px;">
                <h5 class="tituloChart">Pedidos Mensais</h5>
            </div>
            <div class="widget-content">
                <?php include('includes/charts/pedidosMensais.php'); ?>
                <div id="pedidosMensais"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget-four">
            <div class="widget-heading" style="margin-bottom:20px;">
                <h5 class="">Medicamentos mais vendidos</h5>
            </div>
            <div class="widget-content">
                <?php
                $queryQuantMed = mysqli_query($conexao, "select sum(quantMedicamento) AS somas, medicamento from itens_pedido AS IP INNER JOIN pedidos as PE ON PE.idPedido = IP.idPedido WHERE PE.status != 'cancelado' group by medicamento order by sum(quantMedicamento) desc LIMIT 5");
                while ($quantMed = mysqli_fetch_array($queryQuantMed)) {
                    $queryNomeMed = mysqli_query($conexao, "SELECT * FROM medicamentos WHERE idMedicamento = '" . $quantMed['medicamento'] . "'");
                    $resultNomeMed = mysqli_fetch_array($queryNomeMed);
                    $nomeMed   = $resultNomeMed["nome"];
                ?>
                    <div class="w-browser-details">
                        <div class="w-browser-info">
                            <h6 style="color: #000000;"><?= ucfirst($nomeMed) ?></h6>
                            <p class="browser-count"><?= $quantMed['somas'] ?></p>
                        </div>

                        <div class="w-browser-stats">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 100%; background-color: rgb(254, 176, 25);" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div><br>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget-four">
            <div class="widget-heading" style="margin-bottom:20px;">
                <h5 class="">Clientes com mais pedidos</h5><br>
            </div>
            <div class="widget-content">
                <?php
                $queryQuantCliente = mysqli_query($conexao, "SELECT idCliente, COUNT(idCliente) AS somas FROM pedidos GROUP BY idCliente ORDER BY somas DESC LIMIT 5");
                while ($quantCli = mysqli_fetch_array($queryQuantCliente)) {
                    if (is_numeric($quantCli['idCliente'])) {
                        $queryNomeCli = mysqli_query($conexao, "SELECT * FROM cliente WHERE idCliente = '" . $quantCli['idCliente'] . "'");
                        $resultNomeCli = mysqli_fetch_array($queryNomeCli);
                        $nomeCli = $resultNomeCli["nome"];
                    } else {
                        $nomeCli = $quantCli['idCliente'];
                    }
                ?>
                    <div class="w-browser-details">
                        <div class="w-browser-info">
                            <h6 style="color: #000000;"><?= ucfirst($nomeCli) ?></h6>
                            <p class="browser-count"><?= $quantCli['somas'] ?></p>
                        </div>

                        <div class="w-browser-stats">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 100%; background-color: rgb(0, 143, 251)" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div><br>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-four">
            <div class="widget-content">
                <div class="w-content">
                    <div class="w-info">
                        <h6 class="value"><?= $totalClientes ?></h6>
                        <p class="" style="color:rgb(22, 61, 84) !important">Clientes</p>
                    </div>

                    <div class="">
                        <div class="w-icon" style="background-color: rgb(22, 61, 84); color:#fff;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="background-color: rgb(22, 61, 84); width: 100%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div><br><br>

        <?php if ($_SESSION['cargo'] == "adm") { ?>
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value"><?= $totalFuncionarios ?></h6>
                            <p class="" style="color:rgb(22, 61, 84) !important">Funcionários</p>
                        </div>

                        <div class="">
                            <div class="w-icon" style="background-color: rgb(22, 61, 84); color:#fff;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="background-color: rgb(22, 61, 84); width: 100%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<?php
include('includes/footer.php');
?>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/charts/pedidosMensais.js"></script>
<script src="js/charts/medicamentosMaisVendidos.js"></script>
<script src='js/fullcalendar/main.js'></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/locales/pt-br.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    var options = {
        series: [<?= $pedidosEntrega ?>, <?= $pedidosConcluido ?>, <?= $pedidosSeparando ?>, <?= $pedidosCancelado ?>],
        chart: {
            width: 470,
            type: 'pie',
        },
        labels: ['Entrega', 'Concluido', 'Separando', 'Cancelado'],
        responsive: [{
            breakpoint: 100,
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


    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'pt-br',
            initialView: 'dayGridMonth',
            height: '100%',
            dayMaxEvents: true,
            headerToolbar: {
                left: 'title',
                right: 'prev,next'
            }
        });
        calendar.setOption('locale', 'pt-br');
        calendar.render();
    });
</script>