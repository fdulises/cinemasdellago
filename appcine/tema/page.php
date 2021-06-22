<?php require APP_ROOT_DIR.'/tema/header.php' ?>
	<h2 class="tx-center alto bott-litt"><?php echo $entrada['title'] ?></h2>
	<div class="container cont-800 tx-center mg-sec">
		<img src="<?php echo $entrada['cover'] ?>" title="<?php echo $entrada['title'] ?>" alt="<?php echo $entrada['title'] ?>"/>
	</div>
    <div class="container cont-700 bott-gd">
		<?php echo nl2br($entrada['content']) ?>
    </div>
<?php require APP_ROOT_DIR.'/tema/footer.php' ?>
