<?php
	namespace wecor;

	$data = [
		'columns' => [
			'p.id', 'p.slug', 'p.updated', 'p.cover'
		],
		'type' => 3,
		'limit' => 9,
		'order' => 'p.id DESC',
	];
	if( site::getLenguage() == 'en' ){
		$data['columns'][] = 'p.title_en as title';
		$data['columns'][] = 'p.descrip_en as descrip';
	}else{
		$data['columns'][] = 'p.title';
		$data['columns'][] = 'p.descrip';
	}
	$lista_promociones = post::getList($data);

	foreach( $lista_promociones as $k => $v ){
		$lista_promociones[$k]['cover'] = APP_ROOT.'/media/covers/'.$v['cover'];
		$lista_promociones[$k]['link'] = APP_ROOT.'/'.$v['slug'];
	}

	require APP_ROOT_DIR.'/tema/header.php'
?>
<?php if( count( $lista_promociones ) ): ?>
<h2 class="tx-center"><?php echo $text_site['promo_h'] ?></h2>
<div class="container">
	<?php foreach( $lista_promociones as $e ): ?>
	<div class="gd-33 espacio-33-alto gd-m-100 ">
		<div class="espacio-33 card-relative">
			<img src="<?php echo site::getInfo('url').'/tema/images/default.jpg' ?>" data-echo="<?php echo $e['cover'] ?>" title="<?php echo $e['title'] ?>" alt="<?php echo $e['title'] ?>" >
			<a href="<?php echo $e['link'] ?>" class="caja-enlace">
				<div class="sep-pel-cont">
					<h3 class="tx-center f-fuerte"><?php echo $e['title'] ?></h3>
					<h4 class="tx-center f-fuerte"><?php echo $text_site['card_descrip'] ?>:</h4>
					<p class="tx-center f-calido"><?php echo $e['descrip'] ?></p>
				</div>
			</a>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php else: ?>
<div class="container mg-sec">
	<div class="alert"><strong><span class="icon-info"></span> &nbsp; <?php echo $text_site['pagination_notfound'] ?></strong></div>
</div>
<?php endif; ?>
<?php require APP_ROOT_DIR.'/tema/footer.php' ?>
