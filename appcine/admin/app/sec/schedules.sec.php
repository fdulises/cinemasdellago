<?php

	namespace wecor;

	$action = isset($_GET['action']) ? $_GET['action'] : '';
	$result = [
		'state' => 0,
		'data' => [],
		'error' => [],
	];

	if( $action == 'create' ){
		$data = [];

		if( isset($_POST['post_id']) ) $data['post_id'] = $_POST['post_id'];
		if( isset($_POST['type']) ) $data['type'] = $_POST['type'];

		$query = post::createSchedule($data);

		if( $query ){
			$result['data']['id'] = DBConnector::insertId();
			$result['state'] = 1;
		}
	}else if( $action == 'update' && isset($_POST['id']) ){
		$data = [];

		$data['sc_d'] = isset($_POST['sc_d']) ? (int) $_POST['sc_d'] : 0;
		$data['sc_h'] = isset($_POST['sc_h']) ? (int) $_POST['sc_h'] : 0;
		$data['sc_m'] = isset($_POST['sc_m']) ? (int) $_POST['sc_m'] : 0;
		$data['type'] = isset($_POST['type']) ? (int) $_POST['type'] : 0;
		$data['post_id'] = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;

		$query = post::updateSchedule( (INT) $_POST['id'], $data );

		if( $query ) $result['state'] = 1;
	}else if( $action == 'delete' && isset($_POST['id']) ){
		if( post::deleteSchedule( (INT) $_POST['id'] ) ) $result['state'] = 1;
	}

	echo json_encode($result);
