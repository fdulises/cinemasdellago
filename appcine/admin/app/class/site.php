<?php

	namespace wecor;

	abstract class site{

		private static $info = [];

		public static function getInfo( $data = array() ){
			if( !count(self::$info) ) self::$info = DB::select(t_site)->first();
			if( !$data ) return self::$info;
			else if( is_array($data) ){
				$result = array();
				foreach($data as $v){
					if( isset( self::$info[$v] ) ) $result[$v] = self::$info[$v];
				}
				return $result;
			}else if( is_string($data) )
				return isset(self::$info[$data]) ? self::$info[$data] : null;
		}

		/*
		* Metodo para editar datos de configuracion del sitio
		*/
		public static function updateInfo( $data, $value = null ){
			if( is_array($data) && is_null($value) )
				$result = DB::update(t_site)->set($data)->send();
			else if( is_string($data) && (is_string($value) || is_numeric($value)) )
				$result = DB::update(t_site)->set(array(
					$data => $value
				))->send();
			return $result;
		}

		public static function getLenguage(){
			if( isset($_COOKIE['sitelang']) ) return $_COOKIE['sitelang'];
			return 'es';
		}
	}
