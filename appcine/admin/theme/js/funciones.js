//Definimos funcionamiento de barra de navegacion
document.addEventListener('DOMContentLoaded',function(){
	var btn = document.querySelector('#actionNav');
	var nav = document.querySelector('#leftNav');
	var cont = document.querySelector('#cont');
	function showNav(){
		btn.setAttribute('data-estado','open');
		nav.setAttribute('data-estado','open');
		cont.setAttribute('data-estado','open');
	}
	function hideNav(){
		btn.setAttribute('data-estado','close');
		nav.setAttribute('data-estado','close');
		cont.setAttribute('data-estado','close');
	}
	document.querySelector('#actionNav').addEventListener('click',function(){
		if( btn.getAttribute('data-estado') == "open" ){
			hideNav();
			listefi.setCookie('navshow', 0, 30);
		}else{
			showNav();
			listefi.setCookie('navshow', 1, 30);
		}
	});
	if( listefi.getCookie('navshow') == 1 ) showNav();
	else hideNav();
});

document.addEventListener('DOMContentLoaded',function(){

/* Definimos la logica que se ejecuta en todas las secciones */

//Auxiliar para envio de formularios
addEvent(".simpleform", "submit", function(e){
	e.preventDefault();
	listefi.ajax({
		url:this.action, method:this.method, data:new FormData(this),
		success: function(result){
			result = JSON.parse(result);
			if( result.state == 1 ) listefi.alert("Datos Guardados Correctamente","Éxito");
			else listefi.alert("<p>No se púdo procesar el formulario.</p><p>Intente de nuevo más tarde</p>","Error");
		}
	});
});

//Generamos recomendacion de SLUG
addEvent(".slug-suggest", "blur", function(){
	var sluginput = this.getAttribute("data-sluginput");
	sluginput = document.querySelector(sluginput);
	if( this.value && !sluginput.value ) sluginput.value = getSlug(this.value);
});

//Tildamos checkeds por defecto
selectorMultiple("input[type='checkbox']", function(k,e){
	var estado = e[k].getAttribute("data-estado");
	if(estado == 1) e[k].setAttribute('checked', 'checked');
});

//Agregamos la propiedad selected a los option con el value deseado
selectorMultiple('select[data-selected]', function(k,e){
	var value = e[k].getAttribute('data-selected');
	var option = e[k].querySelector('option[value="'+value+'"]');
	if( option ) option.setAttribute('selected', 'selected');
});

function addScheduleBehavior(schsec, id){
	schsec.querySelector("button").addEventListener("click", function(){
		listefi.ajax({
			url: APP_ROOT+'/schedules?action=delete',
			method: 'post', data: {id: id},
		});
		var nodetodel = this.parentNode;
		nodetodel.parentNode.removeChild(nodetodel);
	});

	var selectlist = schsec.querySelectorAll("select");
	for( i=0; i<selectlist.length; i++ ){
		selectlist[i].addEventListener("change", updateSchedule);
	}
	return schsec;
}
var shcedulehtml = '';
function insertHMTLschedule(result, insertId, post_id, sc_type){
	insertId || (insertId = 0);
	post_id || (post_id = 0);
	sc_type || (sc_type = 0);

	var schsec = document.createElement('form');
	schsec.setAttribute("class", "display-flex form-sche");
	schsec.innerHTML = result;

	schsec.querySelector("input[name='id']").value = insertId;
	schsec.querySelector("input[name='post_id']").value = post_id;
	schsec.querySelector("input[name='type']").value = sc_type;

	schsec = addScheduleBehavior(schsec, insertId);

	document.querySelector(".schedulessec[data-type='"+sc_type+"']").appendChild(schsec);
}
function updateSchedule(){
	listefi.ajax({
		url: APP_ROOT+'/schedules?action=update',
		method: 'post',
		data: new FormData(this.parentNode),
	});
}

function proccessSchedule(post_id, sc_type){
	post_id || (post_id = 0);
	sc_type || (sc_type = 0);
	listefi.ajax({
		url: APP_ROOT+'/schedules?action=create',
		method: 'post', data: {
			post_id: post_id,
			type: sc_type,
		},
		success: function(result){
			result = JSON.parse(result);
			var insertId = result.data.id;
			if( !shcedulehtml ){
				listefi.ajax({
					url: APP_ROOT+'/horarios',
					method: 'get',
					success: function(result){
						shcedulehtml = result;
						insertHMTLschedule(shcedulehtml, insertId, post_id, sc_type);
					},
				});
			}else insertHMTLschedule(shcedulehtml, insertId, post_id, sc_type);
		},
	});
}


/* Definimos la logica que se ejecuta en una seccion especifica */

if( SITIO_SEC == 'categorias.crear' ){
	formProccess({
		selector: "#form-catcreate",
		success: function(result){
			if( result.state != 1 ) listefi.alert("<p>No se púdo procesar el formulario.</p><p>Intente de nuevo más tarde</p>","Error");
			else document.location = APP_ROOT+'/categorias';
		}
	});
}else if( SITIO_SEC == 'entradas.crear' ){
	formProccess({
		selector: "#form-entrycreate",
		success: function(result){
			if( result.state != 1 ) listefi.alert("<p>No se púdo procesar el formulario.</p><p>Intente de nuevo más tarde</p>","Error");
			else document.location = APP_ROOT+'/entradas/editar/'+result.data.id+'?creatednow';
		}
	});
}else if( SITIO_SEC == 'entradas.editar' ){
	var shceduleadd = document.querySelector("#shceduleadd")
	var schpost_id = shceduleadd.getAttribute("data-id");
	shceduleadd.addEventListener("submit", function(e){
		e.preventDefault();
		var sc_type = shceduleadd.sc_type.value;

		if( !document.querySelector(".schedulessec[data-type='"+sc_type+"']") ){
			var sc_type_h = document.createElement("h4");
			sc_type_h.innerHTML = this.querySelector("option[value='"+sc_type+"']").innerHTML;

			var sc_type_cont = document.createElement("div");
			sc_type_cont.setAttribute("data-type", sc_type);
			sc_type_cont.setAttribute("class", "schedulessec");
			sc_type_cont.appendChild(sc_type_h);
			document.querySelector("#sc_groups").appendChild(sc_type_cont);
		}

		proccessSchedule(schpost_id, sc_type);
	});

	selectorMultiple(".form-sche", function(k,e){
		addScheduleBehavior(e[k], e[k].getAttribute("data-id"));
	});

	if( (/creatednow/).test(document.location) ){
		listefi.alert("<p class='alert'><span class='icon-info'></span> Ahora puedes configurar los horarios para esta entrada.</p>", "Entrada guardada correctamente");
		scrollToBottom();
	}
}else if( SITIO_SEC == 'usuarios.crear' ){
	formProccess({
		selector: "#form-usercreate",
		success: function(result){
			if( result.state != 1 ){
				var msg = "";
				var errors = {
					nickname_error: "El nickname es incorrecto",
					email_error: "El E-mail es incorrecto",
					role_error: "El id del grupo es incorrecto",
					email_duplicated: "El E-mail ya se encuentra registrado",
					nickname_duplicated: "El nickname ya se encuentra registrado"
				};
				for( acterr in errors ){
					if( in_array(acterr, result.error) ) msg += "<li>"+errors[acterr]+"</li>";
				}

				listefi.alert(
					"<p>Error al procesar el formulario</p><ul>"+msg+"</ul>","Error"
				);
			}else document.location = APP_ROOT+'/usuarios';
		}
	});
}else if( SITIO_SEC == 'usuarios.editar' ){
	var passchange = document.querySelector('#passchange');
	passchange.addEventListener('submit',function(evt){
		evt.preventDefault();
		if( this.password.value == this.repass.value ){
			listefi.confirm("<p>¿Desea actualizar la contraseña de este usuario?</p><p>Esto cerrara la sesión del usuario seleccionado.</p>", function(respuesta){
				if( respuesta ){
					listefi.ajax({
						url:passchange.action,
						method:passchange.method,
						data: new FormData(passchange),
						success:function(result){
							result = JSON.parse(result);
							if( result.state == 1 ) listefi.alert("La contraseña se ha actualizado correctamente","Éxito");
							else listefi.alert("Ocurrio un error al procesar el formulario, intente de nuevo más tarde","Error");
						},
					});
				}
			});
		}
	});
}else if( SITIO_SEC == 'promociones.crear' ){
	formProccess({
		selector: "#form-entrycreate",
		success: function(result){
			if( result.state != 1 ) listefi.alert("<p>No se púdo procesar el formulario.</p><p>Intente de nuevo más tarde</p>","Error");
			else document.location = APP_ROOT+'/promociones/editar/'+result.data.id+'?creatednow';
		}
	});
}else if( SITIO_SEC == 'promociones.editar' ){
	if( (/creatednow/).test(document.location) ){
		listefi.alert("<span class='icon-info'></span> Entrada guardada correctamente", "Éxito");
		scrollToBottom();
	}
}


});
