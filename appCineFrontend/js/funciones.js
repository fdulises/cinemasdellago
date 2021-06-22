//jcslideshow Slideshow
var jcslideshow=function(e){var t=e.ulslideshow||!1,n=e.banterior,o=e.bsiguiente,r=e.intervalo||5,c=document.querySelector(n),l=document.querySelector(o),s=document.querySelector(t),u={},a=0,d=0,v=function(){u=s.querySelectorAll("li"),a=u.length},f=function(){if(d==a-1)var e=0;else var e=d+1;for(i=0;i<a;i++)u[i].style.opacity=e==i?1:0;d=e},y=function(){if(0==d)var e=a-1;else var e=d-1;for(i=0;i<a;i++)u[i].style.opacity=e==i?1:0;d=e},m=function(){jcstiempo=setInterval(f,1e3*r)},p=function(){window.clearInterval(jcstiempo)};v(),m(),c.addEventListener("click",f,!1),l.addEventListener("click",y,!1),s.addEventListener("mouseover",p,!1),s.addEventListener("mouseout",m,!1)};
function activarSlideshow(){var mislideshow = new jcslideshow({ulslideshow: "#JCSlideshow", bsiguiente: "#JCSbtna", banterior: "#JCSbtnb"});}


var pegajoso = function(nodos){
	var menu = document.querySelector(nodos.menu);
    var altoMenu = menu.offsetTop;
    window.addEventListener('scroll',function(){
        var altoPag = document.documentElement.scrollTop;
        if( altoPag > altoMenu )
            menu.setAttribute('data-estado','pegajoso');
         else
             menu.removeAttribute('data-estado','pegajoso');
    });
};

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
    new pegajoso({
        menu:'#menu'
    });
    
    new DropDown('ul','#drop');
    activarSlideshow();
});
