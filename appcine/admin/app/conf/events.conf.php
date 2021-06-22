<?php

	namespace wecor;

	//Validamos que el usuario haya iniciado sesion
	function checkUserLogin(){
		if( !user::logingCheck() && routes::$controller != 'acceso' )
			header('location: '.APP_ROOT.'/acceso');
	}
	event::add('beforeLoadSec', 'checkUserLogin');

	function sitePostIncrement($data){
		if( isset($data['state']) ){
			if( $data['state'] == 1 && $data['type'] == 2 )
				DB::update(t_site)->set('total_post = total_post+1')->send();
			else if( $data['state'] == 1 && $data['type'] == 3 )
				DB::update(t_site)->set('total_page = total_page+1')->send();
		}
	}

	function sitePostDecrement($data){
		if( isset($data['state']) ){
			if( $data['state'] == 0 && $data['type'] == 2 )
				DB::update(t_site)->set('total_post = total_post-1')->send();
			else if( $data['state'] == 1 && $data['type'] == 3 )
				DB::update(t_site)->set('total_page = total_page-1')->send();
		}
	}

	function siteUserIncrement($data){
		if( isset($data['state']) ){
			if( $data['state'] == 1 )
				DB::update(t_site)->set('total_user = total_user+1')->send();
		}
	}

	function siteUserDecrement($data){
		if( isset($data['state']) ){
			if( $data['state'] == 0 )
				DB::update(t_site)->set('total_user = total_user-1')->send();
		}
	}

	event::add('postCreated', 'sitePostIncrement', 10, 1);
	event::add('postUpdated', 'sitePostDecrement', 10, 1);
	event::add('userCreated', 'siteUserIncrement', 10, 1);
	event::add('userUpdated', 'siteUserDecrement', 10, 1);
