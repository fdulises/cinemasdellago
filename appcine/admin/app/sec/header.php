<?php
	namespace wecor;
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<title><?php echo site::getInfo('cms_info'); ?> - Dashboard</title>
	<link rel="stylesheet" href="<?php echo APP_ROOT; ?>/theme/css/listefi-fuentes.css" />
	<link rel="stylesheet" href="<?php echo APP_ROOT; ?>/theme/css/listefi.css" />
	<link rel="stylesheet" href="<?php echo APP_ROOT; ?>/theme/css/listefi-tema.css" />
	<link rel="stylesheet" href="<?php echo APP_ROOT; ?>/theme/css/estilos.css" />
	<script>
	var SITIO_SEC = '<?php echo $controller; ?>';
	var APP_ROOT = '<?php echo APP_ROOT; ?>';
	</script>
	<script src="<?php echo APP_ROOT; ?>/theme/js/listefi.js"></script>
	<script src="<?php echo APP_ROOT; ?>/theme/js/helpers.js"></script>
	<script src="<?php echo APP_ROOT; ?>/theme/js/funciones.js"></script>
</head>
<body>
	<header class="nav-bar nav-primary">
		<div class="nav-brand"><a href="<?php echo APP_ROOT; ?>/inicio"><?php echo site::getInfo('cms_info'); ?></a></div>
		<button data-estado="open" type="button" class="btn-sadw" id="actionNav">
			<span class="line"></span>
			<span class="line"></span>
			<span class="line"></span>
		</button>
		<ul class="bx-right hide-m">
			<li><a href="<?php echo site::getInfo('url'); ?>"><span class="icon-link"></span> Ver Sitio</a></li>
			<li><a href="<?php echo APP_ROOT; ?>/salir"><span class="icon-exit"></span> Salir</a></li>
		</ul>
	</header>
	<article>
		<aside class="nav-abs" id="leftNav">
			<ul>
				<li class="hide-min-m">
					<a href="<?php echo site::getInfo('url'); ?>"><span class="icon-link"></span> Ver Sitio</a>
				</li>
				<li class="hide-min-m">
					<a href="<?php echo APP_ROOT; ?>/salir"><span class="icon-exit"></span> Salir</a>
				</li>
				<li>
					<a href="<?php echo APP_ROOT; ?>/entradas"><span class="icon-file-text"></span> Entradas</a>
				</li>
				<li>
					<a href="<?php echo APP_ROOT; ?>/categorias"><span class="icon-folder"></span> Categorías</a>
				</li>
				<li>
					<a href="<?php echo APP_ROOT; ?>/promociones"><span class="icon-star-empty"></span> Promociones</a>
				</li>
				<li>
					<a href="<?php echo APP_ROOT; ?>/usuarios"><span class="icon-user"></span> Usuarios</a>
				</li>
				<li>
					<a href="<?php echo APP_ROOT; ?>/configuracion"><span class="icon-cog"></span> Configuración</a>
				</li>
			</ul>
		</aside>
		<div class="container-r clearfix" id="cont">
