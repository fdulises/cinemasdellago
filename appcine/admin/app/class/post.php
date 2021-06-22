<?php

	namespace wecor;

	abstract class post{

		use paginaraux;

		public static function create( $data = [] ){
			$predata = [
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s'),
			];

			$data = array_merge($data, $predata);

			$query = DB::insert(t_posts)
				->columns(array_keys($data))
				->values(array_values($data))
				->send();

			$result = 0;

			if($query){
				$result = DBConnector::insertId();
				$data['id'] = $result;

				event::fire('postCreated', $data);
			}

			return $result;
		}

		public static function update( $id, $data ){
			$predata = ['updated' => date('Y-m-d H:i:s')];
			$data = array_merge($data, $predata);

			$result = DB::update(t_posts)
				->set($data)
				->where('id', '=', $id)
				->send();

			$data['id'] = $id;

			if($result) event::fire('postUpdated', $data);

			return $result;
		}

		public static function delete( $id ){
			$result =DB::delete(t_posts)
				->set($data)
				->where('id', '=', $id)
				->send();

			return $result;
		}

		public static function get( $data = array() ){
			$resultado = DB::select(t_posts.' p')->where('id', '=', $data['id']);
			if( isset($data['columns']) ) $resultado->columns($data['columns']);
			if( isset($data['type']) ) $resultado->where('type', '=', $data['type']);
			return $resultado->first();
		}

		public static function getList( $data = array() ){
			$resultado = DB::select(t_posts.' p')
				->where('p.state', '!=', 0)
				->leftJoin(t_cats.' c', 'p.cat', '=', 'c.id');
			if( isset($data['columns']) ) $resultado->columns($data['columns']);

			if( isset($data['type']) ) $resultado->where('p.type', '=', $data['type']);

			if( isset($data['limit'], $data['offset']) )
				$resultado->limit($data['limit'], $data['offset']);
			else if( isset($data['limit']) ) $resultado->limit($data['limit']);

			if( isset($data['order']) ) $resultado->order($data['order']);

			return self::getSelect($resultado->getSQL());
		}

		public static function coverProcess($data){
			$pic_type = strtolower(strrchr($_FILES[$data['filename']]['name'],"."));
			$pic_name = '';

			if( isset($data['picname']) ) $pic_name .= $data['picname'].$pic_type;
			else $pic_name .= $_FILES[$data['filename']]['name'];

			if( isset($data['uri']) ) $pic_path = realpath($data['uri']).'/'.$pic_name;
			else  $pic_path = $pic_name;

			if( $_FILES[$data['filename']]['error'] === 0 ){
				$result = move_uploaded_file(
					$_FILES[$data['filename']]['tmp_name'], $pic_path
				);
				if( $result ) return $pic_name;
			}
			return 0;
		}

		public static function createSchedule($data){
			$result = DB::insert(t_schedules);

			if( isset($data['columns'], $data['values']) )
				$result->columns($data['columns'])->values($data['values']);
			else $result->columns(array_keys($data))->values(array_values($data));

			return $result->send();
		}

		public static function updateSchedule( $id, $data ){
			return DB::update(t_schedules)
				->set($data)
				->where('id', '=', $id)
				->send();
		}

		public static function deleteSchedule( $id ){
			return DB::delete(t_schedules)
				->where('id', '=', $id)
				->send();
		}

		public static function getListSchedule( $data = array() ){
			$resultado = DB::select(t_schedules);
			if( isset($data['post_id']) ) $resultado->where('post_id', '=', (INT) $data['post_id']);
			if( isset($data['type']) ) $resultado->where('type', '=', (INT) $data['type']);
			if( isset($data['columns']) ) $resultado->columns($data['columns']);
			if( isset($data['order']) ) $resultado->order($data['order']);

			return $resultado->get();
		}

	}
