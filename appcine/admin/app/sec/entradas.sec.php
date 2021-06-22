<?php
	namespace wecor;

	//Definimos datos para la paginacion
	$per_page = 20;
	$current_page = isset($_GET['p']) ? (INT) $_GET['p'] : 1;
	$offset = $per_page*($current_page-1);

	//Obtenemos lista de elementos
	$lista = extras::htmlentities(post::getList(array(
		'columns' => [
			'p.id',
			'p.title',
			'p.slug',
			'p.descrip',
			'p.cat as cat_id',
			'p.updated',
			'c.name as cat_name',
			'c.slug as cat_slug'
		],
		'type' => 2,
		'limit' => $per_page,
		'offset' => $offset,
		'order' => 'updated DESC',
	)));
	//Agregamos datos extra a los elementos de la lista
	foreach($lista as $k => $v){
		//Definimos el link de cada elemento
		$lista[$k]['link'] = site::getInfo('url').'/'.$v['slug'];
		if( $v['cat_id'] == 0 )
			$lista[$k]['cat_name'] = 'Sin Categoría';
		$lista[$k]['updated'] = extras::formatoDate($v['updated'],'d/m/Y');
	}

	//Generamos la paginacion
	$pagination = post::pagination([
		'per_page' => $per_page,
		'current_page' => $current_page,
	]);

	require APP_SEC_DIR.'/header.php';
?>
	<div class="container listable">
		<div class="gd-100">
			<div class="gd-60 gd-m-100"><h1><span class="icon-file-text"></span> Listado de entradas</h1></div>
			<div class="gd-40 gd-m-100 tx-right">
				<a href="entradas/crear"><button type="button" class="btn btn-primary"><span class="icon-plus"></span></button></a>
			</div>
		</div>
		<div class="container">
			<div class="gd-30 gd-m-50"><h4>Titulo</h4></div>
			<div class="gd-30 hide-m"><h4>Última Actualización</h4></div>
			<div class="gd-20 hide-m"><h4>Categoría</h4></div>
			<div class="gd-20 gd-m-50 tx-right"><h4>Acciones</h4></div>
		</div>
		<?php foreach( $lista as $c ): ?>
		<div class="container">
			<div class="gd-30 gd-m-50">
				<a href="<?php echo $c['link']; ?>"><?php echo $c['title']; ?></a>
			</div>
			<div class="gd-30 hide-m">
				<span class="icon-calendar"></span> <?php echo $c['updated']; ?>
			</div>
			<div class="gd-20 hide-m">
				<span>
					<span class="icon-folder"></span> <?php echo $c['cat_name']; ?>
				</span>
			</div>
			<div class="gd-20 gd-m-50 tx-right">
				<a href="entradas/editar/<?php echo $c['id']; ?>"><button class="btn btn-primary size-s"><span class="icon-pencil"></span></button></a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="pagination_s1">
		<?php if( $pagination->hasPrev() ): ?>
		<a href='<?php echo $pagination->result('prev_page_url'); ?>'>&laquo; Anterior</a>
		<?php endif; ?>
		<?php echo $pagination->getLinks(); ?>
		<?php if( $pagination->hasNext() ): ?>
		<a href='<?php echo $pagination->result('next_page_url'); ?>'>Siguiente &raquo;</a>
		<?php endif; ?>
	</div>
<?php require APP_SEC_DIR.'/footer.php'; ?>
