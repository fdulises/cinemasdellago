<?php
	namespace wecor;
	/*
		Funcion para mandar emails php
		sendMail(array(
			'destino' => alguien@sitio.algo, //Para quien va
			'asunto' => 'Aqui va el asunto del mensaje',
			'mensaje' => '<p>Lorem ipsum dolor sit amet</p>',
			'from' => contacto@sitio.algo, //Quien envia
		))
	*/
	function sendMail($datos){
		$cabeceras  = 'MIME-Version: 1.0'."\r\n";
		$cabeceras .= 'Content-type: text/html; charset=utf-8'."\r\n";
		if( isset( $datos['from'] ) ) $cabeceras .= 'From: '.$datos['from']."\r\n";
		if( isset( $datos['cc'] ) ) $cabeceras .= 'CC: '.$datos['cc']."\r\n";
		if( isset( $datos['bcc'] ) ) $cabeceras .= 'Bcc: '.$datos['bcc']."\r\n";
		return mail(
			$datos['destino'], $datos['asunto'], $datos['mensaje'], $cabeceras
		);
	}

	//Validamos que se hayan recibido los datos necesarios
	if( !isset(
		$_POST['nombre'], $_POST['email'], $_POST['mensaje'], $_POST['telefono'])
	) die('3');

	//Validamos que se hayan llenado los campos obligatorios
	if(
		empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['mensaje'])
	) die('2');

	//Preparamos el contenido del email
	$emailtext = "<h2>Detalles del formulario de contacto</h2>\n\n";
	$emailtext .= "<p><b>Nombre:</b> " . $_POST['nombre'] . "</p>\n";
	$emailtext .= "<p><b>E-mail:</b> " . $_POST['email'] . "</p>\n";
	$emailtext .= "<p><b>Telefono:</b> " . $_POST['telefono'] . "</p>\n";
	$emailtext .= "<p><b>Mensaje:</b></p><p> " . nl2br($_POST['mensaje']) . "</p>\n\n";

	//Enviamos el email
	$enviar = sendMail(array(
		'destino' => site::getInfo('email'),
		'asunto' => 'Contacto desde sitio web '.site::getInfo('title'),
		'mensaje' => $emailtext,
		'from' => site::getInfo('email'),
	));
	if($enviar) echo 1;
	else echo 0;
