<?php

	/*
	* Wecor - Dashboard
	* V 17.02.09
	* Desarrollado por Ulises Rendon - fdulises@outlook.com
	* Todos los derechos reservados
	*/

	/*
	* Archivo principal de la aplicacion
	* Procesa todas las peticiones
	*/

	namespace wecor;

	require_once realpath( __DIR__ . "/core/conf/cms.conf.php" );

	//Definimos el enlace a la raiz de la aplicacion
	$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
	$approot = trim($protocol.$_SERVER['SERVER_NAME'].$port.dirname($_SERVER['SCRIPT_NAME']), '/');
	define( 'APP_ROOT', $approot );
	define( 'APP_ROOT_DIR', realpath( __DIR__ ) );
	define( 'APP_SEC_DIR', realpath( __DIR__ . '/app/sec') );

	//Autocarga de librerias del sistema
	spl_autoload_register(function($classname){
		$classname = explode("\\" , $classname);
		if ($classname[0] == 'wecor') {
			$filename = realpath( __DIR__ . "/core/lib/{$classname[1]}.php" );
			if( file_exists($filename) ) require_once($filename);
		}
	});

	//Cargamos los archivos de configuracion del backoffice
	$conffiles = glob( __DIR__ . '/app/conf/*.conf.php' );
	if( $conffiles ) foreach($conffiles as $v) require_once $v;
	//Cargamos los archivos de datos para la aplicacion
	$incfiles = glob( __DIR__ . '/app/inc/*.inc.php' );
	if( $incfiles ) foreach( $incfiles as $v ) require_once $v;

	//Obtenemos la ruta actual
	routes::get();
	//Disparamos evento antes de carga de seccion
	event::fire('beforeLoadSec');
	if( is_callable(routes::$controller) ){
		call_user_func(routes::$controller);
	}else{
		$controller = routes::$controller;
		//Cargamos el archivo de la seccion actual
		$secfile = APP_SEC_DIR ."/{$controller}.sec.php";
		if( file_exists( $secfile ) && $controller != 'error404' ) require_once $secfile;
		else extras::e404();
	}
