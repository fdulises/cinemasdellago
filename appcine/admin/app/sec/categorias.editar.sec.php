<?php
	namespace wecor;
	
	//Obtenemos el id del elemento a editar
	$actualid = (INT) routes::$params[1];
	
	//Obtenemos los datos del elemento editar
	$actualudata = extras::htmlentities(cat::get([
		'id' => $actualid,
		'columns' => [
			'id',
			'name',
			'slug',
			'descrip',
			'state',
		]
	]));
	
	//Si no se encuentra el elemento mostramos la pagina de error
	if( !count($actualudata) ) event::fire('e404');
	
	//Procesamos formulario de guardado
	if( isset($_GET['guardar']) ){
		$state = [ 'state' => 0, 'error' => [], 'data' => [] ];
		
		$data = [];
		if( isset( $_POST['name'] ) ) $data['name'] = $_POST['name'];
		if( isset( $_POST['slug'] ) ) $data['slug'] = extras::getSlug($_POST['slug']);
		if( isset( $_POST['descrip'] ) ) $data['descrip'] = $_POST['descrip'];
		if( isset( $_POST['state'] ) ) $data['state'] = (int) $_POST['state'];
		$data['updated'] = date('Y-m-d H:i:s');
			
		if( cat::update( $actualid, $data ) ) $state['state'] = 1;
		 
		echo json_encode($state);
		
		exit();
	}
	
	require APP_SEC_DIR.'/header.php';
?>
	<form class="container cont-700 cont-white mg-sec simpleform" method="post" action="?guardar">
		<h1><span class="icon-folder"></span> Editar categoría</h1>
		<div class="form-sec">
			<label for="name">Nombre</label>
			<input type="text" name="name" id="name" class="form-in slug-suggest" value="<?php echo $actualudata['name'] ?>" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="slug">Slug</label>
			<input type="text" name="slug" id="slug" class="form-in" value="<?php echo $actualudata['slug'] ?>" />
		</div>
		<div class="form-sec">
			<label for="descrip">Descripción</label>
			<textarea name="descrip" id="descrip" class="form-in"><?php echo $actualudata['descrip'] ?></textarea>
		</div>
		<div class="form-sec">
			<label for="state">Estado</label>
			<select name="state" id="state" class="form-in" data-selected="<?php echo $actualudata['state'] ?>">
				<option value="1">Activo</option>
				<option value="0">Eliminado</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary size-l">Guardar Cambios</button>
	</form>
<?php require APP_SEC_DIR.'/footer.php'; ?>