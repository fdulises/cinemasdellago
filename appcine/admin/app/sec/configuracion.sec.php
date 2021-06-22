<?php
	namespace wecor;

	if( isset($_GET['guardar']) ){
		$result = [
			'state'=>0,
			'error'=>[],
			'data'=>[],
		];

		$data = [];
		$query = false;

		$data['title'] = isset($_POST['title']) ? $_POST['title'] : '';
		$data['descrip'] = isset($_POST['descrip']) ? $_POST['descrip'] : '';
		$data['url'] = isset($_POST['url']) ? $_POST['url'] : '';
		$data['email'] = isset($_POST['email']) ? $_POST['email'] : '';
		$data['conf_session_attempts'] = isset($_POST['conf_session_attempts']) ? (INT) $_POST['conf_session_attempts'] : 0;

		if( !filter_var($data['url'],FILTER_VALIDATE_URL) ) $result['error'][] = "ERROR_URL";
		if( !filter_var($data['email'],FILTER_VALIDATE_EMAIL) ) $result['error'][] = "ERROR_EMAIL";

		if( !count($result['error']) ) $query = site::updateInfo($data);

		if( $query ) $result['state'] = 1;

		echo json_encode($result);
		exit();
	}

	$datasite = site::getInfo([
		'title','descrip','url','email','conf_session_attempts'
	]);
	$datasite = extras::htmlentities($datasite);

	require APP_SEC_DIR.'/header.php';
?>
	<form action="?guardar" method="post" class="container cont-white cont-700 simpleform">
		<h1><span class="icon-cog"></span> Configuración del sitio</h1>
		<div class="form-sec">
			<label for="title">Titulo</label>
			<input type="text" name="title" value="<?php echo $datasite['title'] ?>" class="form-in" id="title">
		</div>
		<div class="form-sec">
			<label for="descrip">Descripcion</label>
			<textarea name="descrip" class="form-in" id="descrip"><?php echo $datasite['descrip'] ?></textarea>
		</div>
		<div class="form-sec">
			<label for="url">Dirección</label>
			<input type="text" name="url" value="<?php echo $datasite['url'] ?>" class="form-in" id="url">
		</div>
		<div class="form-sec">
			<label for="email">Correo</label>
			<input type="text" name="email" value="<?php echo $datasite['email'] ?>" class="form-in" id="email">
		</div>
		<div class="form-sec">
			<label for="conf_session_attempts">Intentos de inicio de sesión permitidos</label>
			<input type="text" name="conf_session_attempts" value="<?php echo $datasite['conf_session_attempts'] ?>" class="form-in" id="conf_session_attempts">
		</div>
		<button type="submit" name="button" class="btn btn-primary">Guardar Cambios</button>
	</form>
<?php require APP_SEC_DIR.'/footer.php'; ?>
