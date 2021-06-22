<?php

	namespace wecor;

	$data = [
		'id' => routes::$params['id'],
		'columns' => [
			'p.id',
			'p.slug',
			'p.created',
			'p.updated',
			'p.tags',
			'p.cover',
			'p.state',
			'p.type',
			'p.template',
			'p.hits',
			'p.cat as cat_id',
			'c.name as cat_name',
			'p.autor as autor_id',
			'u.nickname as autor',
			'u.email as autor_email',
			'u.role as autor_role',
			'up.name as autor_name',
			'p.directores',
			'p.trailer',
			'p.reparto',
			'p.clasificacion',
			'p.duracion'
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

	require APP_ROOT_DIR.'/tema/post.php';
