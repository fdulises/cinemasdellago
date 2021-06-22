<?php
	namespace wecor;

	if( isset($_GET['iniciar']) ){
		$state = [ 'state'=>0, 'data'=>[], 'error'=>[] ];

		$data = [];
		$data['usuario'] = isset($_POST['usuario']) ? $_POST['usuario'] : "";
		$data['clave'] = isset($_POST['clave']) ? $_POST['clave'] : "";

		if( user::access($data) ) $state['state'] = 1;
		else $state['error'] = user::$error;

		echo json_encode($state);
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<title><?php echo site::getInfo('cms_info'); ?> - Página de accceso</title>
	<link rel="stylesheet" href="theme/css/listefi-fuentes.css" />
	<link rel="stylesheet" href="theme/css/listefi.css" />
	<link rel="stylesheet" href="theme/css/listefi-tema.css" />
	<script src="theme/js/listefi.js"></script>
	<script src="theme/js/sha512.js"></script>
	<script src="theme/js/acceso.js"></script>
</head>
<body>
	<div class="container cont-400">
		<form id="login-form" method="post" action="?iniciar">
			<h1 class="header-t1">Iniciar sesión</h1>
			<div class="cont-white">
				<input placeholder="Usuario" type="text" name="usuario" id="usuario" class="form-in" autofocus />
				<span class="icon icon-user form-decoration"></span>
				<input placeholder="Contraseña" type="password" name="clave" id="clave" class="form-in" />
				<span class="icon icon-key form-decoration"></span>
				<button class="btn size-l btn-primary d-block">Acceder</button>
			</div>
		</form>
		<div class="fpass-link">
			<a href="<?php echo site::getInfo('url'); ?>">Volver a <?php echo site::getInfo('title'); ?></a>
		</div>
	</div>
</body>
</html>
