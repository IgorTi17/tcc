<?php 

//agosto
$agostoConcluido=0;$agostoCancelado=0;
$queryAgosto = mysqli_query($conexao, "SELECT * FROM pedidos WHERE dataAtual >= 1627776061 AND dataAtual < 1630454399");
while ($agosto = mysqli_fetch_array($queryAgosto)){
	if($agosto['status'] == 'concluido'){
		$agostoConcluido+=1;
	}
	if($agosto['status'] == 'cancelado'){
		$agostoCancelado+=1;
	}
}
echo "<p id='agostoConcluido' style='display:none;'>".$agostoConcluido."</p>";
echo "<p id='agostoCancelado' style='display:none;'>".$agostoCancelado."</p>";


//setembro
$setembroConcluido=0;$setembroCancelado=0;
$querySetembro = mysqli_query($conexao, "SELECT * FROM pedidos WHERE dataAtual >= 1630454461 AND dataAtual < 1633046399");
while ($setembro = mysqli_fetch_array($querySetembro)){
	if($setembro['status'] == 'concluido'){
		$setembroConcluido+=1;
	}
	if($setembro['status'] == 'cancelado'){
		$setembroCancelado+=1;
	}
}
echo "<p id='setembroConcluido' style='display:none;'>".$setembroConcluido."</p>";
echo "<p id='setembroCancelado' style='display:none;'>".$setembroCancelado."</p>";

//outubro
$outubroConcluido=0;$outubroCancelado=0;
$queryOutubro = mysqli_query($conexao, "SELECT * FROM pedidos WHERE dataAtual >= 1633046461 AND dataAtual < 1635724799");
while ($outubro = mysqli_fetch_array($queryOutubro)){
	if($outubro['status'] == 'concluido'){
		$outubroConcluido+=1;
	}
	if($outubro['status'] == 'cancelado'){
		$outubroCancelado+=1;
	}
}
echo "<p id='outubroConcluido' style='display:none;'>".$outubroConcluido."</p>";
echo "<p id='outubroCancelado' style='display:none;'>".$outubroCancelado."</p>";


//novembro
$novembroConcluido=0;$novembroCancelado=0;
$queryNovembro = mysqli_query($conexao, "SELECT * FROM pedidos WHERE dataAtual >= 1635724861 AND dataAtual < 1638316799");
while ($novembro = mysqli_fetch_array($queryNovembro)){
	if($novembro['status'] == 'concluido'){
		$novembroConcluido+=1;
	}
	if($novembro['status'] == 'cancelado'){
		$novembroCancelado+=1;
	}
}
echo "<p id='novembroConcluido' style='display:none;'>".$novembroConcluido."</p>";
echo "<p id='novembroCancelado' style='display:none;'>".$novembroCancelado."</p>";


//dezembro
$dezembroConcluido=0;$dezembroCancelado=0;
$queryDezembro = mysqli_query($conexao, "SELECT * FROM pedidos WHERE dataAtual >= 1638316861 AND dataAtual < 1640995199");
while ($dezembro = mysqli_fetch_array($queryDezembro)){
	if($dezembro['status'] == 'concluido'){
		$dezembroConcluido+=1;
	}
	if($dezembro['status'] == 'cancelado'){
		$dezembroCancelado+=1;
	}
}
echo "<p id='dezembroConcluido' style='display:none;'>".$dezembroConcluido."</p>";
echo "<p id='dezembroCancelado' style='display:none;'>".$dezembroCancelado."</p>";

?>