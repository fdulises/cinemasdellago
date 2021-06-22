<?php require APP_ROOT_DIR.'/tema/header.php' ?>
    <form action="contactar" method="post" class="container cont-white cont-700" id="form_site_update">
		<h1><?php echo $text_site['contact_h'] ?></h1>
		<div class="form-sec">
			<label for="nombre"><?php echo $text_site['contact_name'] ?></label>
			<input type="text" name="nombre"  class="form-in" id="nombre">
		</div>
		<div class="form-sec">
			<label for="telefono"><?php echo $text_site['contact_tel'] ?></label>
			<input type="text" name="telefono" class="form-in" id="telefono">
		</div>
		<div class="form-sec">
			<label for="email"><?php echo $text_site['contact_mail'] ?></label>
			<input type="text" name="email"  class="form-in" id="email">
		</div>
		<div class="form-sec">
			<label for="mensaje"><?php echo $text_site['contact_text'] ?></label>
			<textarea name="mensaje" class="form-in" id="mensaje"></textarea>
		</div>
		<button type="submit" name="button" class="btn btn-yellow size-l"><?php echo $text_site['contact_btn'] ?></button>
	</form>
<?php require APP_ROOT_DIR.'/tema/footer.php' ?>
