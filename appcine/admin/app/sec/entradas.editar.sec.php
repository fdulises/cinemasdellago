<?php
	namespace wecor;

	//Obtenemos el id del elemento a editar
	$actualid = (INT) routes::$params[1];

	//Obtenemos los datos del elemento a editar
	$actualudata = extras::htmlentities(post::get([
		'id' => $actualid,
		'columns' => [
			'p.id',
			'p.title',
			'p.title_en',
			'p.slug',
			'p.descrip',
			'p.content',
			'p.descrip_en',
			'p.content_en',
			'p.state',
			'p.cover',
			'p.cat',
			'p.trailer',
			'p.directores',
			'p.reparto',
			'p.clasificacion',
			'p.duracion'
		]
	]));
	$actualudata['cover'] = site::getInfo('url').'/media/covers/'.$actualudata['cover'];

	//Si no se encuentra el elemento mostramos la pagina de error
	if( !count($actualudata) ) event::fire('e404');

	//Procesamos formulario de guardado
	if( isset($_GET['guardar']) ){
		$state = [ 'state' => 0, 'error' => [], 'data' => [] ];

		$data = [];
		$data['type'] = 2;
		if( isset( $_POST['title'] ) ) $data['title'] = $_POST['title'];
		if( isset( $_POST['title_en'] ) ) $data['title_en'] = $_POST['title_en'];
		if( isset( $_POST['slug'] ) ) $data['slug'] = extras::getSlug($_POST['slug']);
		if( isset( $_POST['descrip'] ) ) $data['descrip'] = $_POST['descrip'];
		if( isset( $_POST['descrip_en'] ) ) $data['descrip_en'] = $_POST['descrip_en'];
		if( isset( $_POST['content'] ) ) $data['content'] = $_POST['content'];
		if( isset( $_POST['content_en'] ) ) $data['content_en'] = $_POST['content_en'];
		if( isset( $_POST['state'] ) ) $data['state'] = (int) $_POST['state'];
		if( isset( $_POST['cat'] ) ) $data['cat'] = (int) $_POST['cat'];
		if( isset( $_POST['trailer'] ) ) $data['trailer'] = $_POST['trailer'];
		if( isset( $_POST['reparto'] ) ) $data['reparto'] = $_POST['reparto'];
		if( isset( $_POST['directores'] ) ) $data['directores'] = $_POST['directores'];

		$data['clasificacion'] = isset($_POST['clasificacion']) ? $_POST['clasificacion'] : 0;
		$data['duracion'] = isset($_POST['duracion']) ? $_POST['duracion'] : 0;

		if( isset( $_FILES['cover'] ) ){
			$cover = post::coverProcess([
				'filename' => 'cover',
				'uri' => APP_ROOT_DIR.'/../media/covers',
			]);
			if( $cover ) $data['cover'] = $cover;
		}

		if( post::update( $actualid, $data ) ) $state['state'] = 1;

		echo json_encode($state);

		exit();
	}

	$lista_categorias = cat::getList(['columns'=>['id', 'name']]);


	require APP_SEC_DIR.'/header.php';
?>
	<form class="container cont-700 cont-white mg-sec simpleform" method="post" action="?guardar">
		<h1><span class="icon-file-text"></span> Editar entrada</h1>
		<div class="form-sec">
			<label for="title">Titulo</label>
			<input type="text" name="title" id="title" class="form-in slug-suggest" value="<?php echo $actualudata['title'] ?>" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="title_en">Titulo en Inglés</label>
			<input type="text" name="title_en" id="title_en" class="form-in" value="<?php echo $actualudata['title_en'] ?>" />
		</div>
		<div class="form-sec">
			<label for="slug">Slug</label>
			<input placeholder="Escriba un nombre para el enlace de la entrada" type="text" name="slug" id="slug" class="form-in" value="<?php echo $actualudata['slug'] ?>" />
		</div>
		<div class="form-sec">
			<label for="content">Contenido</label>
			<textarea placeholder="Escriba el contenido principal de la entrada" name="content" id="content" class="form-in" rows="15"><?php echo $actualudata['content'] ?></textarea>
		</div>
		<div class="form-sec">
			<label for="content_en">Contenido en Inglés</label>
			<textarea placeholder="Escriba el contenido principal de la entrada" name="content_en" id="content_en" class="form-in" rows="15"><?php echo $actualudata['content_en'] ?></textarea>
		</div>
		<div class="form-sec">
			<label for="descrip">Descripción</label>
			<textarea placeholder="Escriba una descripción corta para la entrada"  name="descrip" id="descrip" class="form-in"><?php echo $actualudata['descrip'] ?></textarea>
		</div>
		<div class="form-sec">
			<label for="descrip_en">Descripción en Inglés</label>
			<textarea placeholder="Escriba una descripción corta para la entrada"  name="descrip_en" id="descrip_en" class="form-in"><?php echo $actualudata['descrip_en'] ?></textarea>
		</div>
		<div class="form-sec">
			<label for="cat">Categoría</label>
			<select name="cat" id="cat" class="form-in" data-selected="<?php echo $actualudata['cat'] ?>">
				<option value="0">Sin Categoría</option>
				<?php foreach( $lista_categorias as $cat ): ?>
				<option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-sec">
			<label for="state">Estado</label>
			<select name="state" id="state" class="form-in" data-selected="<?php echo $actualudata['state'] ?>">
				<option value="1">Activo</option>
				<option value="0">Eliminado</option>
			</select>
		</div>
		<div class="form-sec">
			<label for="cover">Imagen de portada</label>
			<input type="file" name="cover" id="cover" class="form-in" />
			<div id="cover-preview"><img src="<?php echo $actualudata['cover'] ?>"></div>
			<script>imgupload({filein: '#cover', container: '#cover-preview'});</script>
		</div>
		<div class="form-sec">
			<label for="trailer">Trailer</label>
			<textarea name="trailer" id="trailer" class="form-in" placeholder="Codigo del Video del trailer"><?php echo $actualudata['trailer'] ?></textarea>
		</div>
		<div class="form-sec">
			<label for="director">Director</label>
			<input type="text" name="directores" id="director" class="form-in slug-suggest" data-sluginput="#slug" value="<?php echo $actualudata['directores'] ?>"/>
		</div>
		<div class="form-sec">
			<label for="reparto">Reparto</label>
			<input type="text" name="reparto" id="reparto" class="form-in slug-suggest" data-sluginput="#slug" value="<?php echo $actualudata['reparto'] ?>"/>
		</div>
		<div class="form-sec">
			<label for="duracion">Duración (minutos)</label>
			<input type="number" value="<?php echo $actualudata['duracion'] ?>" name="duracion" id="duracion" class="form-in slug-suggest" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="clasificacion">Clasificación</label>
			<select name="clasificacion" id="clasificacion" class="form-in" data-selected="<?php echo $actualudata['clasificacion'] ?>">
				<?php foreach( $opclas as $k => $v ): ?>

				<option value="<?php echo $k ?>" <?php if( $actualudata['clasificacion'] == $k ) echo 'selected' ?>><?php echo $v ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<button type="submit" class="btn btn-primary size-l">Guardar Cambios</button>
	</form>
	<form id="shceduleadd" data-id="<?php echo $actualudata['id'] ?>" class="container cont-700 cont-white mg-sec">
		<h2>Agregar horarios</h2>
		<select class="form-in" name="sc_type">
			<<?php foreach ($opfunctype as $k => $v): ?>
				<option value="<?php echo $k ?>"><?php echo $v; ?></option>
			<?php endforeach; ?>
		</select>
		<button type="submit" class="btn btn-default size-s"><span class="icon-plus"></span> Agregar</button>
	</form>
	<?php
		$sches = post::getListSchedule([
			'post_id' => $actualudata['id'],
			'columns' => ['id', 'post_id', 'state', 'sc_d', 'sc_h', 'sc_m', 'type'],
			'order' => 'sc_d ASC',
		]);
		$sc_g = [];
		if( count($sches) > 0 ){
			foreach ($sches as $k => $v) {
				if( !isset($sc_g[$v['type']]) ) $sc_g[$v['type']] = [$v];
				else $sc_g[$v['type']][] = $v;
			}
			unset($sches);
		}
	?>
	<div class="container cont-700 cont-white mg-sec">
		<h3 class="tx-center">Configurar horarios</h3>
		<div id="sc_groups">
			<?php if ( count($sc_g) > 0 ): ?>
			<?php foreach ($sc_g as $type => $scv): ?>
			<div class="schedulessec" data-type="0">
				<h4><?php echo $opfunctype[$type] ?></h4>
				<?php foreach( $scv as $sc ): ?>
				<form class="display-flex form-sche" data-id="<?php echo $sc['id']?>">
					<select data-selected="<?php echo $sc['sc_d']?>" name="sc_d" class="form-in bx-left">
						<?php foreach( $opdias as $k => $v ): ?>
						<option value="<?php echo $k ?>"><?php echo $v ?></option>
						<?php endforeach; ?>
					</select>
					<select data-selected="<?php echo $sc['sc_h']?>" name="sc_h" class="form-in">
						<?php for( $i = 0; $i<24; $i++ ): ?>
						<option value="<?php echo $i ?>"><?php echo (strlen($i)<2) ? '0'.$i : $i, ' hrs'?></option>
						<?php endfor; ?>
					</select>
					<select data-selected="<?php echo $sc['sc_m']?>" name="sc_m" class="form-in">
						<?php for( $i = 0; $i<60; $i+=15 ): ?>
						<option value="<?php echo $i ?>"><?php echo (strlen($i)<2) ? '0'.$i : $i ?></option>
						<?php endfor; ?>
					</select>
					<input type="hidden" name="id" value="<?php echo $sc['id']?>" />
					<input type="hidden" name="post_id" value="<?php echo $sc['post_id']?>" />
					<input type="hidden" name="type" value="<?php echo $sc['type']?>" />
					<button class="mw-close size-l sche-close" type="button"><span class="icon-cross"></span></button>
				</form>
				<?php endforeach; ?>
			</div>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>

<?php require APP_SEC_DIR.'/footer.php'; ?>
