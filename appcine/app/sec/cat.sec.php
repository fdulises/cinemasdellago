<?php

	namespace wecor;
	
	$result = cat::get([
		'id' => routes::$params['id'],
		'columns' => [
			'id',
			'name',
			'slug',
			'created',
			'updated',
			'descrip',
			'type',
		]
	]);
	
	extras::print_r($result);