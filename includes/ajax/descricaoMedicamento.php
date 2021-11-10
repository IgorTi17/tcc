<?php 
include('../../conexao.php');

$query = "SELECT * FROM medicamentos WHERE idMedicamento = '".$_POST['id']."'";
$eQuery = mysqli_query($conexao, $query);

while ($result = mysqli_fetch_array($eQuery)){ 
	$preco = $result['preco'];
	$preco = number_format($preco, 2, ',', ' ');
	if($result['receita'] == 's'){$receita = "SIM";}else{$receita = "NÃO";}
	$target = '" target="_blanc"';
	if($result['bula'] == ''){$bula = '#"';}else{$bula = "upload_files/".$result['bula'].$target;}

	echo '<div class="row" style="border: 1px solid rgba(0, 0, 0, 0.325); margin: 0 15%; margin-bottom: 1.3rem; padding-bottom: 10px;border-radius: 5px;"><div class="col-lg-11"></div><div class="col-lg-1" style="padding:0;"><button onclick="fecharDescricao()" type="button" class="btn btn-danger" style="float:right;font-weight: bold; float: right;">X</button></div><div class="col-lg-1"></div><div class="col-lg-4"><img src="upload_files/'.$result['imagem'].'"class="card-img-top" alt="..."></div><div class="col-lg-1"></div><div class="col-lg-5"><h5 style="text-align:center;" class="card-title"><strong>Dipirona</strong></h5><br><p class="card-text"><strong>QUANTIDADE:</strong> '.$result['quantidade'].'</p><p class="card-text"><strong>PREÇO:</strong> R$ '.$preco.'</p><p class="card-text" style="text-align: justify;"><strong>Necessita receita:</strong> '.$receita.'</p><div style="text-align: center;"><a style="width: 100%;" href="'.$bula.' class="btn btn-primary">Leia a Bula</a></div></div><div class="col-lg-1"></div></div>';
}
