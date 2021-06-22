<?php
	namespace wecor;

	$siteConf = site::getInfo([
		'total_post', 'total_user', 'total_page'
	]);

	require APP_SEC_DIR.'/header.php';
?>
<div class="container mg-sec">
		<h1>Dashboard</h1>
		<div class="container">
			<div class="gd-33 gd-b-100">
				<div class="cont-info">
					<div class="text">
						<h3>Entradas</h3>
						<p><?php echo $siteConf['total_post'] ?></p>
					</div>
					<div class="cover">
						<span class="icon-file-text"></span>
					</div>
				</div>
			</div>
			<div class="gd-33 gd-b-100">
				<div class="cont-info">
					<div class="text">
						<h3>Promociones</h3>
						<p><?php echo $siteConf['total_page'] ?></p>
					</div>
					<div class="cover">
						<span class="icon-star-empty"></span>
					</div>
				</div>
			</div>
			<div class="gd-33 gd-b-100">
				<div class="cont-info">
					<div class="text">
						<h3>Usuarios</h3>
						<p><?php echo $siteConf['total_user'] ?></p>
					</div>
					<div class="cover">
						<span class="icon-users"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container mg-sec">
	</div>
<?php require APP_SEC_DIR.'/footer.php'; ?>
