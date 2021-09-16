<?php
include('conexao.php');

if (isset($_POST['actionSM'])){
	$fornecedor = $_POST['fornecedor'];
	$msgPedido = $_POST['msgPedido'];

	$queryFornecedorSM = mysqli_query($conexao, "SELECT email FROM fornecedor WHERE nome = '".$fornecedor."' OR razao_social = '".$fornecedor."'");
	while ($fornecedorSM = mysqli_fetch_array($queryFornecedorSM)){
		$emailForne = $fornecedorSM['email'];
	}
	$emailForne = "igormoura2204@gmail.com";

	USE PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'email-ssl.com.br';                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'contato@macarraocremoso.com.br';                     // SMTP username
	    $mail->Password   = 'MN!c%baOhpSioWl4';                               // SMTP password
	    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('contato@macarraocremoso.com.br', $fornecedor);
	    $mail->addAddress('contato@macarraocremoso.com.br', 'DrogasMil'); 

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Mensagem do Cliente';
	    $mail->Body    = '<meta charset="UTF-8">Mensagem - '.$msgPedido.'<br><br>';
	    $mail->AltBody = 'Mensagem - '.$msgPedido;

	    $mail->send();
	    header('Location: fornecedores.php');
	} catch (Exception $e) {
	    header('Location: fornecedores.php');
	}


}else{
	header('location:fornecedores.php');
}


?>