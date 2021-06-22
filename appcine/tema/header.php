<?php
	namespace wecor;
	global $text_site;
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title><?php echo event::apply('siteInfoTitle', site::getInfo('title')); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="<?php echo event::apply('siteInfoDescrip', site::getInfo('descrip')); ?>">
	<meta name="generator" content="Stradow Beta 1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />

	<meta property="og:url" content="<?php echo event::apply('siteInfoLink', site::getInfo('url')); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo event::apply('siteInfoTitle', site::getInfo('title')); ?>" />
	<meta property="og:description" content="<?php echo event::apply('siteInfoDescrip', site::getInfo('descrip')); ?>" />
	<meta property="og:image" content="<?php echo event::apply('siteInfoCover', site::getInfo('url').'/tema/images/logo-big.png'); ?>" />
	
	<link rel="icon" href="<?php echo APP_ROOT ?>/favicon.png">

	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo APP_ROOT ?>/tema/css/listefi-fuentes.css"/>
    <link rel="stylesheet" href="<?php echo APP_ROOT ?>/tema/css/estilos.css"/>

	<?php if ( event::apply('siteInfoLink', site::getInfo('url')) == site::getInfo('url').'/acercade' ): ?>
	<link rel="stylesheet" href="<?php echo APP_ROOT ?>/tema/css/baguetteBox.min.css"/>
	<script src="<?php echo APP_ROOT ?>/tema/js/baguetteBox.min.js"></script>
	<?php endif; ?>
</head>
<body>
    <header>
        <div class="gd-40 logo gd-m-100">
            <a title="Ir al inicio" href="<?php echo site::getInfo('url'); ?>"><img src="<?php echo APP_ROOT ?>/tema/images/logo-cinemas2015crop.png" title="<?php echo site::getInfo('title'); ?>" alt="<?php echo site::getInfo('title'); ?>"/></a>
        </div>
        <div class="gd-60 busquedas gd-m-100">
            <form class="tx-center" method="get" action="busqueda">
                <div class="gd-70 gd-m-100">
                    <input type="text" name="b" class="form-in" placeholder="<?php echo $text_site['search_text'];?>"/>
                </div>
                <div class="gd-30 gd-m-100">
                    <button type="submit" class="btn btn-yellow gd-100 buscador"><span class="icon-search"></span></button>
                </div>
            </form>
        </div>
    </header>
	<div id="navcont">
	    <nav id="menu">
	        <button title="Mostrar menú de navegación" id="drop" class="btn btn-yellow">
	            <span class="lineas"></span>
	            <span class="lineas"></span>
	            <span class="lineas"></span>
	        </button>
	        <ul>
	            <li><a title="Ir al inicio" href="<?php echo APP_ROOT ?>"><span class="icon-home3"></span><?php echo $text_site['link_index'] ?></a></li>
	            <li><a title="Ir a la página de promociones" href="promociones"><span class="icon-star-full"></span><?php echo $text_site['link_promo'] ?></a></li>
	            <li><a title="Ir a la página de estrenos" href="estrenos"><span class="icon-power"></span><?php echo $text_site['link_prem'] ?></a></li>
	            <li><a title="Ir a la página de contacto" href="contacto"><span class="icon-envelop"></span><?php echo $text_site['link_contact'] ?></a></li>
				<li><a title="Ir a la página de acerca de" href="acercade"><span class="icon-info"></span><?php echo $text_site['link_about'] ?></a></li>
				<li><a id="btnlang" title="Change Lenguage" href="#"><span class="icon-earth"></span><?php echo $text_site['link_change_l'] ?></a></li>
	        </ul>
	    </nav>
	</div>
