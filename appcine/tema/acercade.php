<?php
	namespace wecor;

	require APP_ROOT_DIR.'/tema/header.php';
?>
    <div class="container cont-white cont-700">
		<h2><?php echo $text_site['about_h'] ?></h2>
	</div>
	<div class="container cont-white cont-900">
		<div class="baguetteBoxTwo">
			<a href="<?php echo site::getInfo('url') ?>/tema/images/CDL1.jpg"><img src="<?php echo site::getInfo('url') ?>/tema/images/default.jpg" data-echo="<?php echo site::getInfo('url') ?>/tema/images/CDL1.jpg"></a>
			<a href="<?php echo site::getInfo('url') ?>/tema/images/CDL2.jpg"><img src="<?php echo site::getInfo('url') ?>/tema/images/default.jpg" data-echo="<?php echo site::getInfo('url') ?>/tema/images/CDL2.jpg"></a>
			<a href="<?php echo site::getInfo('url') ?>/tema/images/CDL3.jpg"><img src="<?php echo site::getInfo('url') ?>/tema/images/default.jpg" data-echo="<?php echo site::getInfo('url') ?>/tema/images/CDL3.jpg"></a>
			<a href="<?php echo site::getInfo('url') ?>/tema/images/CDL4.jpg"><img src="<?php echo site::getInfo('url') ?>/tema/images/default.jpg" data-echo="<?php echo site::getInfo('url') ?>/tema/images/CDL4.jpg"></a>
			<a href="<?php echo site::getInfo('url') ?>/tema/images/CDL5.jpg"><img src="<?php echo site::getInfo('url') ?>/tema/images/default.jpg" data-echo="<?php echo site::getInfo('url') ?>/tema/images/CDL5.jpg"></a>
		</div>
		<script>
		baguetteBox.run('.baguetteBoxTwo');
		</script>
	</div>
	<div class="container cont-white cont-900">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3742.0132419766946!2d-103.25762268599773!3d20.299719017643095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86a2794e3238e125%3A0xd5341ecf328813ca!2sCinemas+del+Lago!5e0!3m2!1ses!2smx!4v1498778320477" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
<?php require APP_ROOT_DIR.'/tema/footer.php' ?>
