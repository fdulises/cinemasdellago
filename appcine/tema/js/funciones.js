echo.init();

var DropDown = function(menu,boton){
    var menu = document.querySelector(menu);
    var boton = document.querySelector(boton);
    boton.setAttribute('menu-estado','oculto');
    boton.addEventListener('click',function(){
    var attr = this.getAttribute('menu-estado');
        if( attr == 'oculto' ){
            this.setAttribute('menu-estado','visible');
            menu.setAttribute('menu','bloque');
        }else{
             menu.removeAttribute('menu','bloque');
             this.setAttribute('menu-estado','oculto');
        }
    });
}

document.addEventListener("DOMContentLoaded",function(){
    new DropDown('ul','#drop');

	var contacForm = document.querySelector("#form_site_update") || document.createElement("div");
	contacForm.addEventListener('submit',function(evt){
		evt.preventDefault();
		listefi.ajax({
			url:this.action,
			method:this.method,
			data: new FormData(this),
			success:function(result){
				if( result == 1 ){
					listefi.alert("Mensaje enviado correctamente.","Éxito");
					contacForm.reset();
				}else if ( result == 2 ) {
					listefi.alert("Todos los campos del formulario son requeridos.","Error");
				}else listefi.alert("Ocurrio un error al procesar el formulario, por favor intente de nuevo más tarde.","Error");
			},
		});
	});

	document.querySelector('#btnlang').addEventListener('click',function(e){
		e.preventDefault();
		var siteLang = listefi.getCookie('sitelang');
		if( siteLang == null ){
			listefi.setCookie('sitelang','es');
			siteLang = 'es';
		}
		if( siteLang == 'es' ) listefi.setCookie('sitelang','en');
		else if( siteLang == 'en' ) listefi.setCookie('sitelang','es');
		window.location = window.location;
	});
});
window.addEventListener("load",function(){
	var menu = document.querySelector("#menu");
	var altoMenu = menu.offsetTop;
	window.addEventListener('scroll',function(){
		var altoPag = document.documentElement.scrollTop ||
			document.body.parentNode.scrollTop ||
			document.body.scrollTop;
		if( altoPag > altoMenu ) menu.setAttribute('data-estado','pegajoso');
		else menu.removeAttribute('data-estado','pegajoso');
	});
});
