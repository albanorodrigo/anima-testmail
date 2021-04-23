<?php
//Importacion de variables Globales
require_once 'config.inc.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'MailClass/vendor/autoload.php';


$asunto = "Test Programacion Web Anima";
$texto = "Esto es una prueba de envio desde PHP Mailer";
$to = "grupoa6totic2021@anima.edu.uy";

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->Mailer = "sendmail";
    $mail->isSMTP();                                     // Enable SMTP authentication
    
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
	$mail->SMTPAuth = true;
	
	$mail->Username = REMITENTE;
	$mail->Password = CLAVE;
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    // $mail->SMTPSecure = 'false';
	
    //Recipients
    $mail->setFrom(REMITENTE, REMITENTE_NAME);
	
	$para = explode(";", $to);
	for($i=0;$i<count($para);$i++){
		$mail->addAddress($para[$i]);				
	}
	if($reply != ''){
		$mail->addReplyTo(RESPONDE_A);
	}
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
	//Content
    $mail->isHTML($html);                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $texto;
    
    
    $mail->send();
    echo 'Envio OK';
} catch (Exception $e) {
    echo 'No se pudo realizar el envio. Mensaje del Error: '. $mail->ErrorInfo;
}

?>