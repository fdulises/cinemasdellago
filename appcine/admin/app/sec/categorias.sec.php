<?php
	namespace wecor;

	//Definimos datos para la paginacion
	$per_page = 20;
	$current_page = isset($_GET['p']) ? (INT) $_GET['p'] : 1;
	$offset = $per_page*($current_page-1);

	//Obtenemos lista de elementos
	$lista_c = extras::htmlentities(cat::getList(array(
		'columns' => ['id', 'name', 'slug', 'descrip'],
		'type' => 1,
		'limit' => $per_page,
		'offset' => $offset,
		'order' => 'name DESC',
	)));
	//Agregamos datos extra a los elementos de la lista
	foreach($lista_c as $k => $v){
		//Definimos el link de cada elemento
		$lista_c[$k]['link'] = site::getInfo('url').'/'.$v['slug'];
	}

	//Generamos la paginacion
	$pagination = cat::pagination([
		'per_page' => $per_page,
		'current_page' => $current_page,
	]);

	require APP_SEC_DIR.'/header.php';
?>
	<div class="container listable">
		<div class="gd-100">
			<div class="gd-60 gd-m-100"><h1><span class="icon-folder"></span> Listado de categorias</h1></div>
			<div class="gd-40 gd-m-100 tx-right">
				<a href="categorias/crear"><button type="button" class="btn btn-primary"><span class="icon-plus"></span></button></a>
			</div>
		</div>
		<div class="container">
			<div class="gd-40 gd-m-50"><h4>Nombre</h4></div>
			<div class="gd-40 hide-m"><h4>Descripción</h4></div>
			<div class="gd-20 gd-m-50 tx-right"><h4>Acciones</h4></div>
		</div>
		<?php foreach( $lista_c as $c ): ?>
		<div class="container">
			<div class="gd-40 gd-m-50">
				<a href="<?php echo $c['link']; ?>"><?php echo $c['name']; ?></a>
			</div>
			<div class="gd-40 hide-m">
				<?php echo $c['descrip']; ?>
			</div>
			<div class="gd-20 gd-m-50 tx-right">
				<a href="categorias/editar/<?php echo $c['id']; ?>"><button class="btn btn-primary size-s"><span class="icon-pencil"></span></button></a>
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
