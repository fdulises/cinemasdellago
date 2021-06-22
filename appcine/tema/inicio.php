<?php
	namespace wecor;
	require APP_ROOT_DIR.'/tema/header.php'
?>
	<?php if( count( $lista_principal ) ): ?>
    <div class="container cont-1000 jcslidecont">
        <ul class="jcslideshow" id="JCSlideshow">
			<?php foreach( $lista_principal as $e ): ?>
            <li>
                <a href="<?php echo $e['link'] ?>" title="<?php echo $e['title'] ?>">
					<img src="<?php echo site::getInfo('url').'/tema/images/default.jpg' ?>" data-echo="<?php echo $e['cover'] ?>" title="<?php echo $e['title'] ?>" alt="<?php echo $e['title'] ?>" >
                </a>
            </li>
			<?php endforeach; ?>
        </ul>
        <button id="JCSbtna" class="btnslidenav atras">&laquo;</button>
        <button id="JCSbtnb" class="btnslidenav adelante">&raquo;</button>
		<script>var jcslideshow=function(e){var t=e.ulslideshow||!1,n=e.banterior,o=e.bsiguiente,r=e.intervalo||5,c=document.querySelector(n),l=document.querySelector(o),s=document.querySelector(t),u={},a=0,d=0,v=function(){u=s.querySelectorAll("li"),a=u.length},f=function(){if(d==a-1)var e=0;else var e=d+1;for(i=0;i<a;i++)u[i].style.opacity=e==i?1:0;d=e},y=function(){if(0==d)var e=a-1;else var e=d-1;for(i=0;i<a;i++)u[i].style.opacity=e==i?1:0;d=e},m=function(){jcstiempo=setInterval(f,1e3*r)},p=function(){window.clearInterval(jcstiempo)};v(),m(),c.addEventListener("click",f,!1),l.addEventListener("click",y,!1),s.addEventListener("mouseover",p,!1),s.addEventListener("mouseout",m,!1)};
		var mislideshow = new jcslideshow({ulslideshow: "#JCSlideshow", bsiguiente: "#JCSbtna", banterior: "#JCSbtnb"});</script>
    </div>
	<?php endif; ?>
	<?php if( count( $lista_principal ) ): ?>
    <!--Seccion de Cartelera-------------------->
    <div class="container">
		<?php foreach( $lista_principal as $e ): ?>
        <div class="gd-33 espacio-33-alto gd-m-100 ">
            <div class="espacio-33 card-relative">
				<img src="<?php echo site::getInfo('url').'/tema/images/default.jpg' ?>" data-echo="<?php echo $e['cover'] ?>" title="<?php echo $e['title'] ?>" alt="<?php echo $e['title'] ?>" >
                <a href="<?php echo $e['link'] ?>" class="caja-enlace">
                    <div class="sep-pel-cont">
                        <h3 class="tx-center f-fuerte"><?php echo $e['title'] ?></h3>
						<?php if( !empty($e['descrip']) ): ?>
						<h4 class="tx-center f-fuerte"><?php echo $text_site['card_descrip'] ?>:</h4>
                        <p class="tx-center f-calido"><?php echo $e['descrip'] ?></p>
						<?php endif; ?>
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
	<?php if( count( $lista_promociones ) ): ?>
    <a title="Ir a la página de promociones" href="<?php echo site::getInfo('url'); ?>/promociones"><h2 class="tx-center"><?php echo $text_site['promo_h'] ?></h2></a>
    <div class="container">
		<?php foreach( $lista_promociones as $e ): ?>
        <div class="gd-33 espacio-33-alto gd-m-100 ">
            <div class="espacio-33 card-relative">
                <img src="<?php echo site::getInfo('url').'/tema/images/default.jpg' ?>" data-echo="<?php echo $e['cover'] ?>" title="<?php echo $e['title'] ?>" alt="<?php echo $e['title'] ?>" >
                <a href="<?php echo $e['link'] ?>" class="caja-enlace">
                    <div class="sep-pel-cont">
                        <h3 class="tx-center f-fuerte"><?php echo $e['title'] ?></h3>
						<?php if( !empty($e['descrip']) ): ?>
						<h4 class="tx-center f-fuerte"><?php echo $text_site['card_descrip'] ?>:</h4>
                        <p class="tx-center f-calido"><?php echo $e['descrip'] ?></p>
						<?php endif; ?>
                    </div>
                </a>
            </div>
        </div>
		<?php endforeach; ?>
    </div>
	<?php endif; ?>
	<?php if( count( $lista_estrenos ) ): ?>
    <a title="Ir a la página de estrenos" href="<?php echo site::getInfo('url'); ?>/estrenos"><h2 class="tx-center"><?php echo $text_site['prem_h'] ?></h2></a>
    <div class="container">
		<?php foreach( $lista_estrenos as $e ): ?>
        <div class="gd-33 espacio-33-alto gd-m-100 ">
            <div class="espacio-33 card-relative">
                <img src="<?php echo site::getInfo('url').'/tema/images/default.jpg' ?>" data-echo="<?php echo $e['cover'] ?>" title="<?php echo $e['title'] ?>" alt="<?php echo $e['title'] ?>" >
                <a href="<?php echo $e['link'] ?>" class="caja-enlace">
                    <div class="sep-pel-cont">
                        <h3 class="tx-center f-fuerte"><?php echo $e['title'] ?></h3>
						<?php if( !empty($e['descrip']) ): ?>
                        <h4 class="tx-center f-fuerte"><?php echo $text_site['card_descrip'] ?>:</h4>
                        <p class="tx-center f-calido"><?php echo $e['descrip'] ?></p>
						<?php endif; ?>
                    </div>
                </a>
            </div>
        </div>
		<?php endforeach; ?>
    </div>
<?php endif; ?>
<?php require APP_ROOT_DIR.'/tema/footer.php' ?>
