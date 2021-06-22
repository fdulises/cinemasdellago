<?php
	namespace wecor;
	
	//Procesamos formulario de guardado
	if( isset($_GET['guardar']) ){
		$state = [ 'state' => 0, 'error' => [], 'data' => [] ];
		
		if( isset( $_POST['name'], $_POST['slug'], $_POST['descrip'] ) ){
			$data = [			
				'name' => $_POST['name'],
				'slug' => extras::getSlug($_POST['slug']),
				'descrip' => $_POST['descrip'],
			];
			if( cat::create( $data ) ) $state['state'] = 1;
		}
		
		echo json_encode($state);
		exit();
	}
	
	require APP_SEC_DIR.'/header.php';
?>
	<form class="container cont-700 cont-white mg-sec" id="form-catcreate" method="post" action="?guardar">
		<h1><span class="icon-folder"></span> Agregar categoría</h1>
		<div class="form-sec">
			<label for="name">Nombre</label>
			<input type="text" name="name" id="name" class="form-in slug-suggest" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="slug">Slug</label>
			<input type="text" name="slug" id="slug" class="form-in" />
		</div>
		<div class="form-sec">
			<label for="descrip">Descripción</label>
			<textarea name="descrip" id="descrip" class="form-in"></textarea>
		</div>
		<button type="submit" class="btn btn-primary size-l">Enviar</button>
	</form>
<?php require APP_SEC_DIR.'/footer.php'; ?>,