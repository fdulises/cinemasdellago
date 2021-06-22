<?php

	namespace wecor;

	//Autocarga de clases del usuario
	spl_autoload_register(function($classname){
		$classname = explode("\\" , $classname);
		if ($classname[0] == 'wecor') {
			$filename = realpath( APP_ROOT_DIR . "/app/class/{$classname[1]}.php" );
			if( file_exists($filename) ) require_once($filename);
		}
	});

	//Incluimos archivos de configuracion del sistema
	require_once realpath( APP_ROOT_DIR . '/app/conf/db.conf.php' );
	require_once realpath( APP_ROOT_DIR . '/app/conf/db.tables.conf.php' );
	require_once realpath( APP_ROOT_DIR . '/app/conf/site.conf.php' );

	//Establecemos zona horaria
	date_default_timezone_set(TIME_ZONE);

	//Establecemos la sesion
	session::setConfig('name', S_ID);
	session::start();

	//Establecemos datos de configuracion para el cache
	basicache::setDir( realpath( APP_ROOT_DIR . '/app/cache' ) );
	basicache::setLifetime(60*60);

	//Realizamos la coneccion con la base de datos
	DBConnector::connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	//Cargamos el paquete de idioma seleccionado
	$lang_url = APP_ROOT_DIR.'/tema/lang/'.site::getLenguage().'.php';
	if( file_exists($lang_url) ) require $lang_url;
	else die("No se encontro el paquete de idioma :(");
