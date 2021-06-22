<?php
	namespace wecor;

	/*
	* Obtenemos la lista de entradas principales
	*/
	$data = [
		'columns' => [
			'DISTINCT p.id',
			'p.slug',
			'p.updated',
			'p.cover',
			'p.hits',
			'p.cat as cat_id',
			'c.name as cat_name',
		],
		'limit' => 9,
		'order' => 'p.id DESC',
		'type' => 2,
		'schedules' => [
			'cond' => 'sc.id IS NOT NULL',
		],
	];
	if( site::getLenguage() == 'en' ){
		$data['columns'][] = 'p.title_en as title';
		$data['columns'][] = 'p.descrip_en as descrip';
	}else{
		$data['columns'][] = 'p.title';
		$data['columns'][] = 'p.descrip';
	}
	$lista_principal = post::getList($data);

	foreach( $lista_principal as $k => $v ){
		$lista_principal[$k]['cover'] = APP_ROOT.'/media/covers/'.$v['cover'];
		$lista_principal[$k]['link'] = APP_ROOT.'/'.$v['slug'];
	}

	/*
	* Obtenemos la lista de promociones
	*/
	$data = [
		'columns' => [
			'p.id', 'p.slug', 'p.updated', 'p.cover',
		],
		'limit' => 9,
		'order' => 'p.id DESC',
		'type' => 3,
	];
	if( site::getLenguage() == 'en' ){
		$data['columns'][] = 'p.title_en as title';
		$data['columns'][] = 'p.descrip_en as descrip';
	}else{
		$data['columns'][] = 'p.title';
		$data['columns'][] = 'p.descrip';
	}
	$lista_promociones = post::getList($data);

	foreach( $lista_promociones as $k => $v ){
		$lista_promociones[$k]['cover'] = APP_ROOT.'/media/covers/'.$v['cover'];
		$lista_promociones[$k]['link'] = APP_ROOT.'/'.$v['slug'];
	}


	/*
	* Obtenemos la lista de estrenos
	*/
	$data = [
		'columns' => [
			'p.id',
			'p.slug',
			'p.updated',
			'p.cover',
			'p.cat as cat_id',
			'c.name as cat_name',
		],
		'limit' => 9,
		'order' => 'p.id DESC',
		'type' => 2,
		'schedules' => [
			'cond' => 'sc.id IS NULL',
		],
	];
	if( site::getLenguage() == 'en' ){
		$data['columns'][] = 'p.title_en as title';
		$data['columns'][] = 'p.descrip_en as descrip';
	}else{
		$data['columns'][] = 'p.title';
		$data['columns'][] = 'p.descrip';
	}
	$lista_estrenos = post::getList($data);

	foreach( $lista_estrenos as $k => $v ){
		$lista_estrenos[$k]['cover'] = APP_ROOT.'/media/covers/'.$v['cover'];
		$lista_estrenos[$k]['link'] = APP_ROOT.'/'.$v['slug'];
	}

	require APP_ROOT_DIR.'/tema/inicio.php';
