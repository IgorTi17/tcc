<?php

//Março
$queryDataCliente = mysqli_query($conexao, "SELECT dataRegistro FROM cliente");
$dadosMarco=0;$dataRegistro="";
while ($clientes = mysqli_fetch_array($queryDataCliente)){
	$dataRegistro = $clientes['dataRegistro'];
	if(strtotime('2021-03-01') <= strtotime($dataRegistro) && strtotime('2021-03-31') >= strtotime($dataRegistro)){
		$dadosMarco ++;
	}
}
echo "<p id='dadosMarco' style='display:none;'>".$dadosMarco."</p>";


//Abril
$queryDataCliente = mysqli_query($conexao, "SELECT dataRegistro FROM cliente");
$dadosAbril=0;$dataRegistro="";
while ($clientes = mysqli_fetch_array($queryDataCliente)){
	$dataRegistro = $clientes['dataRegistro'];
	if(strtotime('2021-04-01') <= strtotime($dataRegistro) && strtotime('2021-04-30') >= strtotime($dataRegistro)){
		$dadosAbril ++;
	}
}
echo "<p id='dadosAbril' style='display:none;'>".$dadosAbril."</p>";

//Maio
$queryDataCliente = mysqli_query($conexao, "SELECT dataRegistro FROM cliente");
$dadosMaio=0;$dataRegistro="";
while ($clientes = mysqli_fetch_array($queryDataCliente)){
	$dataRegistro = $clientes['dataRegistro'];
	if(strtotime('2021-05-01') <= strtotime($dataRegistro) && strtotime('2021-05-31') >= strtotime($dataRegistro)){
		$dadosMaio ++;
	}
}
echo "<p id='dadosMaio' style='display:none;'>".$dadosMaio."</p>";

//Junho
$queryDataCliente = mysqli_query($conexao, "SELECT dataRegistro FROM cliente");
$dadosJunho=0;$dataRegistro="";
while ($clientes = mysqli_fetch_array($queryDataCliente)){
	$dataRegistro = $clientes['dataRegistro'];
	if(strtotime('2021-06-01') <= strtotime($dataRegistro) && strtotime('2021-06-30') >= strtotime($dataRegistro)){
		$dadosJunho ++;
	}
}
echo "<p id='dadosJunho' style='display:none;'>".$dadosJunho."</p>";

//Julho
$queryDataCliente = mysqli_query($conexao, "SELECT dataRegistro FROM cliente");
$dadosJulho=0;$dataRegistro="";
while ($clientes = mysqli_fetch_array($queryDataCliente)){
	$dataRegistro = $clientes['dataRegistro'];
	if(strtotime('2021-07-01') <= strtotime($dataRegistro) && strtotime('2021-07-31') >= strtotime($dataRegistro)){
		$dadosJulho ++;
	}
}
echo "<p id='dadosJulho' style='display:none;'>".$dadosJulho."</p>";

//Agosto
$queryDataCliente = mysqli_query($conexao, "SELECT dataRegistro FROM cliente");
$dadosAgosto=0;$dataRegistro="";
while ($clientes = mysqli_fetch_array($queryDataCliente)){
	$dataRegistro = $clientes['dataRegistro'];
	if(strtotime('2021-08-01') <= strtotime($dataRegistro) && strtotime('2021-08-31') >= strtotime($dataRegistro)){
		$dadosAgosto ++;
	}
}
echo "<p id='dadosAgosto' style='display:none;'>".$dadosAgosto."</p>";

//Setembro
$queryDataCliente = mysqli_query($conexao, "SELECT dataRegistro FROM cliente");
$dadosSetembro=0;$dataRegistro="";
while ($clientes = mysqli_fetch_array($queryDataCliente)){
	$dataRegistro = $clientes['dataRegistro'];
	if(strtotime('2021-09-01') <= strtotime($dataRegistro) && strtotime('2021-09-30') >= strtotime($dataRegistro)){
		$dadosSetembro ++;
	}
}
echo "<p id='dadosSetembro' style='display:none;'>".$dadosSetembro."</p>";

?>