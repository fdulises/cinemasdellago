<?php
	namespace wecor;

	//Definimos cadena de busqueda
	$busqueda = isset( $_GET['b'] ) ? $_GET['b'] : '';

	//Definimos datos para la paginacion
	$per_page = 9;
	$current_page = isset($_GET['p']) ? (INT) $_GET['p'] : 1;
	$offset = $per_page*($current_page-1);

	$data = [
		'columns' => [
			'p.id',
			'p.slug',
			'p.updated',
			'p.cover',
			'p.hits',
			'p.cat as cat_id',
			'c.name as cat_name',
		],
		'limit' => $per_page,
		'offset' => $offset,
		'order' => 'p.id DESC',
	];
	if( site::getLenguage() == 'en' ){
		$data['columns'][] = 'p.title_en as title';
		$data['columns'][] = 'p.descrip_en as descrip';
	}else{
		$data['columns'][] = 'p.title';
		$data['columns'][] = 'p.descrip';
	}
	if( $busqueda ) $data['search'] = $busqueda;
	$lista_promociones = post::getList($data);

	foreach( $lista_promociones as $k => $v ){
		$lista_promociones[$k]['cover'] = APP_ROOT.'/media/covers/'.$v['cover'];
		$lista_promociones[$k]['link'] = APP_ROOT.'/'.$v['slug'];
	}

	$busqueda = htmlentities($busqueda);

	//Generamos la paginacion
	$pagination = post::pagination([
		'per_page' => $per_page,
		'current_page' => $current_page,
		'url_base' => '?b='.$busqueda,
	]);


	require APP_ROOT_DIR.'/tema/header.php'
?>
<h2 class="tx-center"><?php echo $text_site['search_h'] ?>: <?php echo $busqueda ?></h2>
<?php if( count( $lista_promociones ) ): ?>
<div class="container">
	<?php foreach( $lista_promociones as $e ): ?>
	<div class="gd-33 espacio-33-alto gd-m-100 ">
		<div class="espacio-33 card-relative">
			<img src="<?php echo site::getInfo('url').'/tema/images/default.jpg' ?>" data-echo="<?php echo $e['cover'] ?>" title="<?php echo $e['title'] ?>" alt="<?php echo $e['title'] ?>" >
			<a href="<?php echo $e['link'] ?>" class="caja-enlace">
				<div class="sep-pel-cont">
					<h3 class="tx-center f-fuerte"><?php echo $e['title'] ?></h3>
					<h4 class="tx-center f-fuerte">Descripcion:</h4>
					<p class="tx-center f-calido"><?php echo $e['descrip'] ?></p>
				</div>
			</a>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<div class="pagination_s1">
	<?php if( $pagination->hasPrev() ): ?>
	<a href='<?php echo $pagination->result('prev_page_url'); ?>'>&laquo; <?php echo $text_site['pagination_prev'] ?></a>
	<?php endif; ?>
	<?php echo $pagination->getLinks(); ?>
	<?php if( $pagination->hasNext() ): ?>
	<a href='<?php echo $pagination->result('next_page_url'); ?>'><?php echo $text_site['pagination_next'] ?> &raquo;</a>
	<?php endif; ?>
</div>
<?php else: ?>
<div class="container mg-sec">
	<div class="alert"><strong><span class="icon-info"></span> &nbsp; <?php echo $pagination->result('pagination_notfound'); ?></strong></div>
</div>
<?php endif; ?>
<?php require APP_ROOT_DIR.'/tema/footer.php' ?>
