<?php
	namespace wecor;
	/*
	* Archivo con constantes de datos de configuracion del sistema
	*/

	define('DEBUG_MODE', true);
	define('TIME_ZONE', 'America/Mexico_City');
	define('MAINTENANCE_MODE', false);

	//Constante con datos para las sesiones
	define('S_PRE',			'st_');
	define('S_ID',			S_PRE.'session_id');
	define('S_USERID',		S_PRE.'userid');
	define('S_USERNAME',	S_PRE.'username');
	define('S_USERMAIL',	S_PRE.'usermail');
	define('S_STRING',		S_PRE.'string');
	define('S_LOGING',		S_PRE.'loging');

	//Activamos registro de errores
	ini_set("log_errors" , "1");
	ini_set("error_log" , "error.log.txt");
	if( !DEBUG_MODE ) ini_set("display_errors" , "0");
