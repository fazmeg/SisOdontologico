<?php 
	include('../../start.php');
	fnc_autentificacion();
	$destinatario=$_POST["destinatario"];
	$asunto=$_POST["asunto"];
	$contenido=$_POST["contenido"];
	include_once ("class.phpmailer.php");
	include_once ("class.smtp.php");
	$mail = new PHPMailer;
	$mail->isSMTP();                                      		// Mailer Permite utilizar SMTP
	$mail->Host = 'mail.supremecluster.com';  					// Especifique el servidor principal y de reserva
	$mail->SMTPAuth = true;                               		// Habilitar la autenticación SMTP
	$mail->Username = 'info@fazstore.com';                    // Usuario de SMTP
	$mail->Password = 'conexioncorreo@';                           	// Contraseña de usuario SMTP 
	$mail->SMTPSecure = '';                            			// Habilitar el cifrado, 'ssl' y 'tls'
	$mail->Port = 2525; 
	$mail->From = 'info@fazstore.com';
	$mail->FromName = 'OdontoClinic';
	$mail->addAddress($destinatario);  					// Agrega direccion de destino
	//$mail->addAddress('fazmeg@hotmail.com');              	// Agrega direccion de destino opcional
	//$mail->addReplyTo('fazmeg@fazstore.com', 'Information');	// Agrega direccion de reenvio
	//$mail->addCC(' ');
	//$mail->addBCC(' ');
	$mail->WordWrap = 50;                                 // Número de caracteres maximo	
	$mail->addAttachment('/var/tmp/file.tar.gz');         // Agregar archivos adjuntos
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Nombre opcional de archivo adjunto
	$mail->isHTML(true);                                  // Formato de Correo Electrónico de envio "HTML"
	$mail->Subject = $asunto;
	$mail->Body    = $contenido;
	$mail->AltBody = 'Firma';
	if(!$mail->send()) {
	  // echo 'No se pudo enviar el mensaje.';
	   //echo 'Mailer Error: ' . $mail->ErrorInfo;
	   //exit;
	   $envio='';
		}else
		{$envio='ok';
		}
		if($envio=='ok'){
			$MSG = 'Correo enviado correctamente.';
			$MSGdes = '[A: '.$destinatario.'] ';
			$MSGimg = $RUTAi.'ok.png';
		}else{
			
			$MSG = 'Error al enviar el correo.';
			$MSGdes = '[A: '.$destinatario.'] '. $mail->ErrorInfo;
			$MSGimg = $RUTAi.'delete.png';
		}
	$_SESSION['MSG'] = $MSG;
	$_SESSION['MSGdes'] = $MSGdes;
	$_SESSION['MSGimg'] = $MSGimg;
	header("Location: ".$RUTAm."certificados/certificados_index.php");	


?>