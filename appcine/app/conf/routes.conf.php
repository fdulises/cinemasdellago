<?php

	/*
	* Archivo de configuracion de rutas
	* Lista con las rutas y sus controladores
	*/

	namespace wecor;

	routes::add( '/', 'inicio');
	routes::add( 'inicio', 'inicio');
	routes::add( 'contacto', function(){
		event::add('siteInfoTitle', function($data){
			return "{$data} - Página de contacto";
		}, 10, 1);
		event::add('siteInfoLink', function($data){
			return "{$data}/contacto";
		}, 10, 1);
		require APP_ROOT_DIR.'/tema/contacto.php';
	});
	routes::add( 'contactar', function(){
		require APP_ROOT_DIR.'/tema/contactar.php';
	});
	routes::add( 'acercade', function(){
		event::add('siteInfoTitle', function($data){
			return "{$data} - Página acerca de";
		}, 10, 1);
		event::add('siteInfoLink', function($data){
			return "{$data}/acercade";
		}, 10, 1);
		require APP_ROOT_DIR.'/tema/acercade.php';
	});
	routes::add( 'promociones', function(){
		event::add('siteInfoTitle', function($data){
			return "{$data} - Página de promociones";
		}, 10, 1);
		event::add('siteInfoLink', function($data){
			return "{$data}/promociones";
		}, 10, 1);
		require APP_ROOT_DIR.'/tema/promociones.php';
	});
	routes::add( 'estrenos', function(){
		event::add('siteInfoTitle', function($data){
			return "{$data} - Página de estrenos";
		}, 10, 1);
		event::add('siteInfoLink', function($data){
			return "{$data}/estrenos";
		}, 10, 1);
		require APP_ROOT_DIR.'/tema/estrenos.php';
	});
	routes::add( 'busqueda', function(){
		event::add('siteInfoTitle', function($data){
			return "{$data} - Página de búsqueda";
		}, 10, 1);
		event::add('siteInfoLink', function($data){
			return "{$data}/busqueda";
		}, 10, 1);
		require APP_ROOT_DIR.'/tema/busqueda.php';
	});
	routes::add(function($url){
		$data = [];
		$result = post::get([
			'slug' => $url, 'columns' => [ 'p.id', 'p.slug', 'p.type', 'p.title', 'p.descrip', 'p.cover' ],
		]);
		if( $result ){
			if( $result['type'] == 1 || $result['type'] == 3 ) $data['controller'] = 'page';
			if( $result['type'] == 2 ) $data['controller'] = 'post';
			$data['params'] = $result;

			event::add('siteInfoTitle', function($title) use($result){
				return $title.' - '.extras::htmlentities($result['title']);
			}, 9, 1);
			event::add('siteInfoDescrip', function($descrip) use($result){
				return extras::htmlentities($result['descrip']);
			}, 9, 1);
			event::add('siteInfoLink', function($link) use($result){
				return $link.'/'.extras::htmlentities($result['slug']);
			}, 9, 1);
			event::add('siteInfoCover', function($cover) use($result){
				return site::getInfo('url').'/media/covers/'.extras::htmlentities($result['cover']);
			}, 9, 1);
		}
		return $data;
	});
	routes::add(function($url){
		$data = [];
		$result = cat::get([
			'slug' => $url, 'columns' => [ 'id', 'slug', 'type' ],
		]);
		if( $result ){
			if( $result['type'] == 1 ) $data['controller'] = 'cat';
			if( $result['type'] == 2 ) $data['controller'] = 'tag';
			$data['params'] = $result;
		}
		return $data;
	});
