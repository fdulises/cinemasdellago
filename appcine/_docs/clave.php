<?php

	/*
	* Metodo para generar hash aleatorio
	*
	* Parametros: $hash - Metodo de cifrado para el hash
	* Retorna: cadena aleatoria cifrada
	*/
	function randomHash( $hash = 'md5' ){
		if(is_callable('openssl_random_pseudo_bytes'))
			$randomString = openssl_random_pseudo_bytes(16);
		else $randomString = mt_rand(1, mt_getrandmax());
		
		return hash( $hash, $randomString );
	}
	
	//Funcion hash a usar
	$hash = 'sha512';
	
	//1- Obtenemos la clave y la ciframos
	$clave = hash( $hash, isset($_GET['clave']) ? $_GET['clave'] : '' );
	
	//2- Generamos sal aleatoria cifrada
	$sal = randomHash( $hash );
	
	//3- Concatenamos la clave con la sal y volvemos a cifrar
	$clave = hash( $hash, $clave.$sal );
	
	echo "<p>Clave: </p>";
	echo "<p>", $clave, "</p>";
	echo "<p>Sal: </p>";
	echo "<p>", $sal, "</p>";