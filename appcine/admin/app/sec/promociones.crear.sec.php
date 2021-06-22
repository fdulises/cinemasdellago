<?php
	namespace wecor;

	//Procesamos formulario de guardado
	if( isset($_GET['guardar']) ){
		$state = [ 'state' => 0, 'error' => [], 'data' => [] ];

		if( isset( $_POST['title'], $_POST['slug'], $_POST['content'], $_POST['descrip'], $_FILES['cover'], $_POST['title_en'], $_POST['descrip_en'], $_POST['content_en'] ) ){

			$cover = post::coverProcess([
				'filename' => 'cover',
				'uri' => APP_ROOT_DIR.'/../media/covers',
			]);
			if( $cover ){
				$data = [
					'title' => $_POST['title'],
					'slug' => extras::getSlug($_POST['slug']),
					'descrip' => $_POST['descrip'],
					'content' => $_POST['content'],
					'type' => 3,
					'state' => 1,
					'cover' => $cover,
					'title_en' => $_POST['title_en'],
					'descrip_en' => $_POST['descrip_en'],
					'content_en' => $_POST['content_en']
				];
				if( !empty($data['title']) && !empty($data['slug']) ){
					$insertId = post::create( $data );
					if( $insertId ){
						$state['state'] = 1;
						$state['data']['id'] = $insertId;
					}
				}else $data['error'][] = 'campos_vacios';
			}else $state['error'][] = 'cover_error';
		}

		echo json_encode($state);
		exit();
	}

	require APP_SEC_DIR.'/header.php';
?>
	<form class="container cont-700 cont-white mg-sec" id="form-entrycreate" method="post" action="?guardar">
		<h1><span class="icon-file-text"></span> Agregar promoción</h1>
		<div class="form-sec">
			<label for="title">Titulo</label>
			<input type="text" name="title" id="title" class="form-in slug-suggest" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="title_en">Titulo en Ingles</label>
			<input type="text" name="title_en" id="title_en" class="form-in" />
		</div>
		<div class="form-sec">
			<label for="slug">Slug</label>
			<input type="text" name="slug" id="slug" class="form-in" />
		</div>
		<div class="form-sec">
			<label for="content">Contenido</label>
			<textarea name="content" id="content" class="form-in" rows="15"></textarea>
		</div>
		<div class="form-sec">
			<label for="content_en">Contenido en Ingles</label>
			<textarea name="content_en" id="content_en" class="form-in" rows="15"></textarea>
		</div>
		<div class="form-sec">
			<label for="descrip">Descripción</label>
			<textarea name="descrip" id="descrip" class="form-in"></textarea>
		</div>
		<div class="form-sec">
			<label for="descrip_en">Descripción en Ingles</label>
			<textarea name="descrip_en" id="descrip_en" class="form-in"></textarea>
		</div>
		<div class="form-sec">
			<label for="cover">Imagen de portada</label>
			<input type="file" name="cover" id="cover" class="form-in" />
			<div id="cover-preview"></div>
			<script>imgupload({filein: '#cover', container: '#cover-preview'});</script>
		</div>
		<button type="submit" class="btn btn-primary size-l">Enviar</button>
	</form>
<?php require APP_SEC_DIR.'/footer.php'; ?>,
