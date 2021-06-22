<?php
	namespace wecor;
	require APP_ROOT_DIR.'/tema/header.php'
?>
    <!--Maquetacion de sipnosis.------------------->
    <h2 class="tx-center alto bott-litt"><?php echo $entrada['title'] ?></h2>
    <div class="container cont-1000 bott-gd">
        <div class="">
            <div class="gd-50 gd-m-100">
				<img src="<?php echo site::getInfo('url').'/tema/images/default.jpg' ?>" data-echo="<?php echo $entrada['cover'] ?>" title="<?php echo $entrada['title'] ?>" alt="<?php echo $entrada['title'] ?>" >
            </div>
            <div class="gd-50 gd-m-100">
                <h3 class="tx-center"><?php echo $text_site['post_info_synopsis'] ?></h3>
                <p class="f-calido">
					<?php echo nl2br($entrada['content']) ?>
				</p>
            </div>
        </div>
    </div>
    <!--Video Trailer.------------------->
    <div class="container cont-1000">
        <div class="cont-iframe">
            <div class="gd-100">
				<?php echo $entrada['trailer']; ?>
            </div>
        </div>
    </div>
	<!--Horarios de las peliculas--------->
	<?php
		$sc = post::getSchedules($entrada['id']);
		if( count($sc) > 0 ):

			$sc_g = [];
			foreach ($sc as $k => $v) {
				if( !isset($sc_g[$v['type']]) ) $sc_g[$v['type']] = [$v];
				else $sc_g[$v['type']][] = $v;
			}
			unset($sc);
	?>
	<div class="container cont-600">
		<div class="alto">
			<div class="gd-100">
				<h2 class="tx-center"><?php echo $text_site['post_info_shce'] ?></h2>
				<?php foreach ($sc_g as $type => $sc): $sc = post::auxSchedules($sc); ?>
				<div class="sc-group">
					<h4><?php echo $opfunctype[$type]; ?></h4>
					<?php foreach($sc as $k => $v):?>
					<p class=""><span class="f-fuerte"> <?php echo $opdias[$k].':</span> '.'<span class="f-calido">'.$v ?> </span></p>
					<?php endforeach; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
    <!--Autor y reparto.------------------->
	<?php if( !empty($entrada['directores']) || !empty($entrada['reparto']) || !empty($entrada['clasificacion']) || !empty($entrada['duracion']) ): ?>
    <div class="container cont-600">
        <div class="alto">
            <div class="gd-100">
                <h2 class="tx-center"><?php echo $text_site['post_info_info'] ?></h2>
				<?php if( !empty($entrada['cat_name']) ): ?>
                <p class="">
					<span class="f-fuerte"><?php echo $text_site['post_info_genre'] ?>: </span><span class="f-calido"><?php echo $entrada['cat_name']?></span>
				</p>
				<?php endif; ?>
				<?php if( !empty($entrada['directores']) ): ?>
                <p class="">
					<span class="f-fuerte"><?php echo $text_site['post_info_director'] ?>: </span><span class="f-calido"><?php echo $entrada['directores']?></span>
				</p>
				<?php endif; ?>
				<?php if( !empty($entrada['reparto']) ): ?>
                <p class="">
					<span class="f-fuerte"><?php echo $text_site['post_info_rep'] ?>: </span><span class="f-calido"><?php echo $entrada['reparto'] ?></span>
				</p>
				<?php endif; ?>
				<?php if( !empty($entrada['duracion']) ): ?>
                <p class="">
					<span class="f-fuerte"><?php echo $text_site['post_info_time'] ?>: </span><span class="f-calido"><?php echo $entrada['duracion']?> min</span>
				</p>
				<?php endif; ?>
				<?php if( !empty($entrada['clasificacion']) ): ?>
                <p class="">
					<span class="f-fuerte"><?php echo $text_site['post_info_clas'] ?>: </span><span class="f-calido"><?php echo $opclas[$entrada['clasificacion']]?></span>
				</p>
				<?php endif; ?>
            </div>
        </div>
    </div>
	<?php endif; ?>
<?php require APP_ROOT_DIR.'/tema/footer.php' ?>
