<?php

	namespace wecor;

	abstract class post{

		use paginaraux;


		public static function get( $data = array() ){
			$resultado = DB::select(t_posts.' p')
				->where( 'p.state', '>', 0 )
				->leftJoin(t_cats.' c', 'p.cat', '=', 'c.id')
				->leftJoin(t_users.' u', 'p.autor', '=', 'u.id')
				->leftJoin(t_profiles.' up', 'p.autor', '=', 'up.id');
			if( isset($data['id']) ) $resultado->where('p.id', '=', $data['id']);
			if( isset($data['slug']) ) $resultado->where('p.slug', '=', $data['slug']);
			if( isset($data['type']) ) $resultado->where('p.type', '=', $data['type']);
			if( isset($data['columns']) ) $resultado->columns($data['columns']);
			if( isset($data['cat_id']) ) $resultado->where( 'p.cat', '=', $data['cat_id'] );
			if( isset($data['cat_name']) ) $resultado->where( 'c.name', '=', $data['cat_name'] );
			if( isset($data['cat_slug']) ) $resultado->where( 'c.slug', '=', $data['cat_slug'] );
			return $resultado->first();
		}

		public static function getList( $data = array() ){
			$resultado = DB::select(t_posts.' p')
				->where( 'p.state', '>', 0 )
				->leftJoin(t_cats.' c', 'p.cat', '=', 'c.id')
				->leftJoin(t_users.' u', 'p.autor', '=', 'u.id')
				->leftJoin(t_profiles.' up', 'p.autor', '=', 'up.id');

			if( isset( $data['schedules'] ) ){
				$resultado->leftJoin(t_schedules.' sc', 'sc.post_id', '=', 'p.id');
				if( isset($data['schedules']) ) $resultado->where($data['schedules']['cond']);
			}

			if( isset($data['id']) ) $resultado->where('p.id', '=', $data['id']);
			if( isset($data['slug']) ) $resultado->where('p.slug', '=', $data['slug']);
			if( isset($data['type']) ) $resultado->where('p.type', '=', $data['type']);
			if( isset($data['columns']) ) $resultado->columns($data['columns']);
			if( isset($data['cat_id']) ) $resultado->where( 'p.cat', '=', $data['cat_id'] );
			if( isset($data['cat_name']) ){
				if( empty($data['cat_name']) ) $resultado->where( 'c.name IS NULL' );
				else $resultado->where( 'c.name', '=', $data['cat_name'] );
			}
			if( isset($data['cat_slug']) ){
				if( empty($data['cat_slug']) ) $resultado->where( 'c.slug IS NULL' );
				else $resultado->where( 'c.slug', '=', $data['cat_slug'] );
			}

			if( isset($data['search']) ){
				$data['search'] = DBConnector::escape($data['search']);
				if( str_word_count($data['search']) > 1 )
					$resultado->fullTextSearch(['p.title', 'p.descrip'], $data['search']);
				else $resultado->where("p.title like '%{$data['search']}%'");
			}

			if( isset($data['limit'], $data['offset']) )
				$resultado->limit($data['limit'], $data['offset']);
			else if( isset($data['limit']) ) $resultado->limit($data['limit']);

			if( isset($data['order']) ) $resultado->order($data['order']);

			return self::getSelect($resultado->getSQL());
		}

		public static function getSchedules($post_id){
			$result = DB::select(t_schedules)
				->columns(['sc_d', 'sc_h', 'sc_m', 'type'])
				->where('post_id', '=', $post_id)
				->order('type ASC, sc_h ASC')
				->get();
			return $result;
		}

		public static function auxSchedules($sc){
			//Concatenamos el campo hora con el campo minuto
			foreach($sc as $k => $v){
				$hf = $v['sc_h'] > 12 ? true : false;

				if( $hf ) $v['sc_h'] -= 12;
				$hf = ($hf || $v['sc_h'] == 12 ) ? 'pm' : 'am';
				if( $v['sc_h'] == 0 ) $v['sc_h'] = 12;

				if( $v['sc_h'] < 10 ) $v['sc_h'] = '0'.$v['sc_h'];
				if( $v['sc_m'] < 10 ) $v['sc_m'] = '0'.$v['sc_m'];
				$v['sc_h'] = '<span class="sc-tag">'.implode(':', [$v['sc_h'], $v['sc_m']]).' '.$hf.'</span>';
				$sc[$k]['sc_h'] = $v['sc_h'];
				unset($sc[$k]['sc_m']);
			}

			//Simplificamos el arreglo original sumando campos repetidos
			$aux_nuevo = [];
			foreach( $sc as $k => $v ){
				if( !isset( $aux_nuevo[$v['sc_d']] ) ) $aux_nuevo[$v['sc_d']] = [$v['sc_h']];
				else $aux_nuevo[$v['sc_d']][] = $v['sc_h'];
			}
		
			//Transformamos las listas de horarios en cadenas de texto
			foreach( $aux_nuevo as $k => $v ) $aux_nuevo[$k] = implode(' ', $aux_nuevo[$k]);

			ksort($aux_nuevo);
			return $aux_nuevo;
		}
	}
