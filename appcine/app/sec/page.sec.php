<?php

	namespace wecor;

	$data = [
		'id' => routes::$params['id'],
		'columns' => [
			'p.id', 'p.slug', 'p.updated', 'p.cover',
		]
	];
	if( site::getLenguage() == 'en' ){
		$data['columns'][] = 'p.title_en as title';
		$data['columns'][] = 'p.descrip_en as descrip';
		$data['columns'][] = 'p.content_en as content';
	}else{
		$data['columns'][] = 'p.title';
		$data['columns'][] = 'p.descrip';
		$data['columns'][] = 'p.content';
	}
	$entrada = post::get($data);

	$entrada['cover'] = APP_ROOT.'/media/covers/'.$entrada['cover'];
	$entrada['slug'] = APP_ROOT.'/'.$entrada['slug'];

	require APP_ROOT_DIR.'/tema/page.php';
