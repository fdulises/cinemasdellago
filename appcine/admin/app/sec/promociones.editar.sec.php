<?php
	namespace wecor;

	//Obtenemos el id del elemento a editar
	$actualid = (INT) routes::$params[1];

	//Obtenemos los datos del elemento a editar
	$actualudata = extras::htmlentities(post::get([
		'id' => $actualid,
		'columns' => [
			'p.id', 'p.title', 'p.slug', 'p.descrip', 'p.content', 'p.state', 'p.cover', 'p.title_en', 'p.descrip_en', 'p.content_en'
		]
	]));
	$actualudata['cover'] = site::getInfo('url').'/media/covers/'.$actualudata['cover'];

	//Si no se encuentra el elemento mostramos la pagina de error
	if( !count($actualudata) ) event::fire('e404');

	//Procesamos formulario de guardado
	if( isset($_GET['guardar']) ){
		$state = [ 'state' => 0, 'error' => [], 'data' => [] ];

		$data = [];
		$data['type'] = 3;
		if( isset( $_POST['title'] ) ) $data['title'] = $_POST['title'];
		if( isset( $_POST['title_en'] ) ) $data['title_en'] = $_POST['title_en'];
		if( isset( $_POST['descrip_en'] ) ) $data['descrip_en'] = $_POST['descrip_en'];
		if( isset( $_POST['content_en'] ) ) $data['content_en'] = $_POST['content_en'];
		if( isset( $_POST['slug'] ) ) $data['slug'] = extras::getSlug($_POST['slug']);
		if( isset( $_POST['descrip'] ) ) $data['descrip'] = $_POST['descrip'];
		if( isset( $_POST['content'] ) ) $data['content'] = $_POST['content'];
		if( isset( $_POST['state'] ) ) $data['state'] = (int) $_POST['state'];
		$data['updated'] = date('Y-m-d H:i:s');

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

	require APP_SEC_DIR.'/header.php';
?>
	<form class="container cont-700 cont-white mg-sec simpleform" method="post" action="?guardar">
		<h1><span class="icon-file-text"></span> Editar promoción</h1>
		<div class="form-sec">
			<label for="title">Titulo</label>
			<input type="text" name="title" id="title" class="form-in slug-suggest" value="<?php echo $actualudata['title'] ?>" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="title_en">Titulo en Ingles</label>
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
			<label for="content_en">Contenido en Ingles</label>
			<textarea placeholder="Escriba el contenido principal de la entrada" name="content_en" id="content_en" class="form-in" rows="15"><?php echo $actualudata['content_en'] ?></textarea>
		</div>
		<div class="form-sec">
			<label for="descrip">Descripción</label>
			<textarea placeholder="Escriba una descripción corta para la entrada"  name="descrip" id="descrip" class="form-in"><?php echo $actualudata['descrip'] ?></textarea>
		</div>
		<div class="form-sec">
			<label for="descrip_en">Descripción en Ingles</label>
			<textarea placeholder="Escriba una descripción corta para la entrada"  name="descrip_en" id="descrip_en" class="form-in"><?php echo $actualudata['descrip_en'] ?></textarea>
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
		<button type="submit" class="btn btn-primary size-l">Guardar Cambios</button>
	</form>
<?php require APP_SEC_DIR.'/footer.php'; ?>
