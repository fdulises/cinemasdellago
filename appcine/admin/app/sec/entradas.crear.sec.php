<?php
	namespace wecor;

	//Procesamos formulario de guardado
	if( isset($_GET['guardar']) ){
		$state = [ 'state' => 0, 'error' => [], 'data' => [] ];

		if( isset( $_POST['title'], $_POST['slug'], $_POST['content'], $_POST['descrip'], $_FILES['cover'], $_POST['cat'], $_POST['trailer'], $_POST['reparto'], $_POST['directores'], $_POST['title_en'],  $_POST['descrip_en'], $_POST['content_en'] ) ){

			$cover = post::coverProcess([
				'filename' => 'cover',
				'uri' => APP_ROOT_DIR.'/../media/covers',
			]);
			if( $cover ){
				$data = [
					'title' => $_POST['title'],
					'title_en' => $_POST['title_en'],
					'slug' => extras::getSlug($_POST['slug']),
					'descrip' => $_POST['descrip'],
					'descrip_en' => $_POST['descrip_en'],
					'content' => $_POST['content'],
					'content_en' => $_POST['content_en'],
					'type' => 2,
					'state' => 1,
					'cover' => $cover,
					'cat'=>$_POST['cat'],
					'trailer'=>$_POST['trailer'],
					'directores'=>$_POST['directores'],
					'reparto'=>$_POST['reparto'],
				];

				$data['clasificacion'] = isset($_POST['clasificacion']) ? $_POST['clasificacion'] : 0;
				$data['duracion'] = isset($_POST['duracion']) ? $_POST['duracion'] : 0;

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

	//Obtenemos la lista de categorias
	$lista_categorias = cat::getList(['columns'=>['id', 'name']]);

	require APP_SEC_DIR.'/header.php';
?>
	<form class="container cont-700 cont-white mg-sec" id="form-entrycreate" method="post" action="?guardar">
		<h1><span class="icon-file-text"></span> Agregar entrada</h1>
		<div class="form-sec">
			<label for="title">Titulo</label>
			<input type="text" name="title" id="title" class="form-in slug-suggest" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="title_en">Titulo en Inglés</label>
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
			<label for="content_en">Contenido en Inglés</label>
			<textarea name="content_en" id="content_en" class="form-in" rows="15"></textarea>
		</div>
		<div class="form-sec">
			<label for="descrip">Descripción</label>
			<textarea name="descrip" id="descrip" class="form-in"></textarea>
		</div>
		<div class="form-sec">
			<label for="descrip_en">Descripción en Inglés</label>
			<textarea name="descrip_en" id="descrip_en" class="form-in"></textarea>
		</div>
		<div class="form-sec">
			<label for="cat">Categoría</label>
			<select name="cat" id="cat" class="form-in">
				<option value="0">Sin Categoría</option>
				<?php foreach( $lista_categorias as $cat ): ?>
				<option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-sec">
			<label for="cover">Imagen de portada</label>
			<input type="file" name="cover" id="cover" class="form-in" />
			<div id="cover-preview"></div>
			<script>imgupload({filein: '#cover', container: '#cover-preview'});</script>
		</div>
		<div class="form-sec">
			<label for="trailer">Trailer</label>
			<textarea name="trailer" id="trailer" class="form-in" placeholder="Codigo del Video del trailer"></textarea>
		</div>
		<div class="form-sec">
			<label for="director">Director</label>
			<input type="text" name="directores" id="director" class="form-in slug-suggest" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="reparto">Reparto</label>
			<input type="text" name="reparto" id="reparto" class="form-in slug-suggest" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="duracion">Duración (minutos)</label>
			<input type="number" value="0" name="duracion" id="duracion" class="form-in slug-suggest" data-sluginput="#slug" />
		</div>
		<div class="form-sec">
			<label for="clasificacion">Clasificación</label>
			<select name="clasificacion" id="clasificacion" class="form-in">
				<?php foreach( $opclas as $k => $v ): ?>
				<option value="<?php echo $k ?>"><?php echo $v ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<button type="submit" class="btn btn-primary size-l">Enviar</button>
	</form>
<?php require APP_SEC_DIR.'/footer.php'; ?>,
