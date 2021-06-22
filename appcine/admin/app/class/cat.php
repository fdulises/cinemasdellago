<?php

	namespace wecor;
	
	abstract class cat{
		
		use paginaraux;
		
		public static function create( $data = [] ){
			$predata = [
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s'),
			];
			
			$data = array_merge($data, $predata);
			
			return DB::insert(t_cats)
				->columns(array_keys($data))
				->values(array_values($data))
				->send();
		}
		
		public static function update( $id, $data ){
			return DB::update(t_cats)
				->set($data)
				->where('id', '=', $id)
				->send();
		}
		
		public static function delete( $id ){
			return DB::delete(t_cats)
				->set($data)
				->where('id', '=', $id)
				->send();
		}
		
		public static function get( $data = array() ){
			$resultado = DB::select(t_cats)->where('id', '=', $data['id']);
			if( isset($data['columns']) ) $resultado->columns($data['columns']);
			if( isset($data['type']) ) $resultado->where('type', '=', $data['type']);
			return $resultado->first();
		}
		
		public static function getList( $data = array() ){
			$resultado = DB::select(t_cats)->where('state', '!=', 0);
			if( isset($data['columns']) ) $resultado->columns($data['columns']);
			
			if( isset($data['type']) ) $resultado->where('type', '=', $data['type']);
			
			if( isset($data['limit'], $data['offset']) )
				$resultado->limit($data['limit'], $data['offset']);
			else if( isset($data['limit']) ) $resultado->limit($data['limit']);
			
			if( isset($data['order']) ) $resultado->order($data['order']);
			
			return self::getSelect($resultado->getSQL());
		}
	}