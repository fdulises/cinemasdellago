<?php

	/*
	* Archivo de configuracion de rutas
	* Lista con las rutas y sus controladores
	*/

	namespace wecor;

	routes::add( '/', 							'inicio');
	routes::add( 'inicio', 						'inicio');
	routes::add( 'configuracion', 				'configuracion');
	routes::add( 'acceso',						'acceso');
	routes::add( 'salir',						'salir');
	routes::add( 'categorias',					'categorias');
	routes::add( 'categorias\/crear',			'categorias.crear');
	routes::add( 'categorias\/editar\/(\d+)',	'categorias.editar');
	routes::add( 'entradas',					'entradas');
	routes::add( 'entradas\/crear',				'entradas.crear');
	routes::add( 'entradas\/editar\/(\d+)',		'entradas.editar');
	routes::add( 'usuarios',					'usuarios');
	routes::add( 'usuarios\/crear',				'usuarios.crear');
	routes::add( 'usuarios\/editar\/(\d+)',		'usuarios.editar');
	routes::add( 'schedules',					'schedules');
	routes::add( 'horarios',					'horarios');
	routes::add( 'promociones',					'promociones');
	routes::add( 'promociones\/crear',			'promociones.crear');
	routes::add( 'promociones\/editar\/(\d+)',	'promociones.editar');
