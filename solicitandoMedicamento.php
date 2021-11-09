<?php

USE PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\SMTP;
USE PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

session_start();
include('conexao.php');

if (isset($_POST['actionSM'])){
	$fornecedor = $_POST['fornecedor'];
	$msgPedido = $_POST['msgPedido'];
	$dataAtual = strtotime('now');

	$queryFornecedorSM = mysqli_query($conexao, "SELECT idFornecedor, email FROM fornecedor WHERE nome = '".$fornecedor."' OR razao_social = '".$fornecedor."'");
	while ($fornecedorSM = mysqli_fetch_array($queryFornecedorSM)){
		$emailForne = $fornecedorSM['email'];
		$idFornecedor = $fornecedorSM['idFornecedor'];
	}
	$emailForne = "igormoura2204@gmail.com";
	$nomeUser = ucfirst($_SESSION['usuario']); 
	
}
	date_default_timezone_set('America/Sao_Paulo');
	$body = "<h1>DrogasMil Ltda.</h1><span>Comércio Farmacêutico</span><br><span>Av. Santa Cruz, 580 - Realengo</span><br><span>Rio de Janeiro – RJ</span><p>Rio de Janeiro, ". date('d')." de ".date('F')." ".date('Y')."</p><p>Prezado Senhor:</p><span>".$msgPedido."</span><br><br><p>Atenciosamente,</p><p> ".$nomeUser.", Administrador</p><br><br><img src='images/logo.png'>";
	
	try {
	    //Server settings
	    $mail->CharSet = 'UTF-8';	
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'email-ssl.com.br';                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'contato@macarraocremoso.com.br';                     // SMTP username
	    $mail->Password   = 'MN!c%baOhpSioWl4';                               // SMTP password
	    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('contato@macarraocremoso.com.br', "DrogasMil");
	    $mail->addAddress('igormoura2204@gmail.com', 'Igor Moura'); 

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Solicitação novos medicamentos';
	    $mail->Body    = $body;
	    $mail->AltBody = 'Mensagem - '.$msgPedido;

	    $mail->send();

	    $query = "INSERT INTO history_solicitacao (idUsuario, idFornecedor, dataAtual, msg) VALUES ('".$_SESSION['userid']."', '$idFornecedor', '$dataAtual', '$msgPedido')";
	    $conexao->query($query);

	    header('Location: fornecedores.php?msg=send');
	} catch (Exception $e) {
	    header('Location: fornecedores.php');
	}
?>


