
var c_url = 'https://tecnicom.pe/apps/c2c/besco/callback.php';

var escribiendo = false;

function start_chat(){
	var url = base_url+'chat/start_chat';
	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'id':true},

	    success: function (data) {

	    	var json = JSON.parse(data);

		    if(json.res == 'success')
		    {
		    	// console.log('empieza');
		    	// $('#audio_fb')[0].load();
		    	// $('#audio_fb')[0].play();
		    	// console.log('done');
		    }
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})
}

function mostrar_chat(){
	var url = base_url+'chat/mostrar_chat';
	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'ver':true},

	    success: function (data) {

	    	var json = JSON.parse(data);

		    if(json.res == 'success')
		    {
		    	$('.chatbox').html(json.cuerpo);

		    	if(parseInt(json.vistos) > 0){
		    		bajar_scroll();
		    	}
		    	
				if(escribiendo == false){
					$('#escribiendo').slideUp(200);
				}
				
			
		    }
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})
}

function send_msg(){

	clearInterval(intervalc);

	var mensaje = $('.type_msg').val();

	if(mensaje == ""){
		return false;
	}

	$('.type_msg').val('');

	var html = '';

    html += '<div class="d-flex justify-content-end mb-4">';
    html += '   <div class="msg_cotainer_send">';
    html += 		htmlEntities(mensaje);
    html += '		<span class="msg_time_send">Ahora</span>';
    html += '	</div>';
    html += '	<div class="img_cont_msg">';
    html += '		<img src="'+base_url_no+'public/frontend/img/'+USER_PIC+'" class="rounded-circle user_img_msg">';
    html += '	</div>';
    html += '</div>';

    $('.chatbox').append(html);

    var ir =  parseInt($(".msg_card_body").scrollTop()) + parseInt($(".chatbox").scrollTop()) + 200;

	$(".msg_card_body").animate({ scrollTop: ir}, "slow");

	var url = base_url+'chat/send_msg';
	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'mensaje':mensaje},

	    success: function (data) {

	    	var json = JSON.parse(data);

		    if(json.res == 'success')
		    {
		    	mostrar_chat();
		    	$('#si_escribio_c').val(1);
		    	intervalc = setInterval(mostrar_chat, 3000);
		    }
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})
}

function escribir_bot(id = 0,com = 0){

	escribiendo_bot();

	var url = base_url+'chat/escribir_bot';
	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'res':id,'com':com},

	    success: function (data) {

	    	var json = JSON.parse(data);

		    if(json.res == 'success')
		    {	
		    	//mostrar_chat();

		    	dejar_escribir_bot();
		    	
		    }
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})
}

function set_ubicacion(id){

	var url = base_url+'chat/set_ubicacion';

	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'id':id},

	    success: function (data) {

	    	var json = JSON.parse(data);

		    if(json.res == 'success')
		    {
		    	setTimeout("escribir_bot()",300); 
		    }
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})
}

function set_proyecto(id){

	var url = base_url+'chat/set_proyecto';

	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'id':id},

	    success: function (data) {

	    	var json = JSON.parse(data);

		    if(json.res == 'success')
		    {
		    	setTimeout("escribir_bot()",300); 
		    }
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})
}

function set_pregunta(id){
	var url = base_url+'chat/set_pregunta';

	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'id':id},

	    success: function (data) {

	    	var json = JSON.parse(data);

		    if(json.res == 'success')
		    {
		    	setTimeout("escribir_bot("+id+")",300); 
		    }
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})
}

function whatsapp_me_c(link){

	//Guardar llamdo a la accion

	var url = base_url+'chat/set_llamado';

	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'id':true},

	    success: function (data) {

	    	
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})

	window.open(link, '_blank');
	
}

// function make_call(){

// 	var url = c_url+'?number=910836615';

// 	$.ajax({

// 	    type: 'GET',

// 	    url:url,

// 	    data:{},

// 	    success: function (data) {

// 	    	console.log(data);
// 	    },
// 	    error: function () {
// 	      console.log('Ocurrio un error por favor intente nuevamente');
// 	    }
// 	})
// }

function form_contact_c(){

	$('#contacto_c_modal').modal('show');
}

//////////////////
//Funciones útiles
//////////////////

function escribiendo_bot(){

	escribiendo = true;

	clearInterval(intervalc);

	$('#escribiendo').slideDown(200);

	return true;
}

function dejar_escribir_bot(){

	setTimeout(function(){$('#escribiendo').slideUp(200);escribiendo = false;},1000);

	intervalc = setInterval(mostrar_chat, 1200);

	return true;
}

function guardar_datos_c(){

	//Asignar variables

	var numero = $('#numero_chat').val();

	var codigo = $('#codigo_chat').val();

	var nombre = $('#nombre_chat').val();

	var apellido = $('#apellido_chat').val();

	var email = $('#email_chat').val();

	var dni = $('#dni_chat').val();

	var id_proyecto = $('#id_proyecto').val();

	var id_cliente = $('#id_cliente').val();
	//validar nombre

	if(nombre == ""){
		$('#error_nombre_c').show(0);
		return false;
	}

	if(apellido == ""){
		$('#error_nombre_c1').show(0);
		return false;
	}

	//Validar número de teléfono
	//Validar que solo sean numeros

	if(numero.isInteger == false){
		$('#error_numero_c').show(100);
		return false;
	}

	//Validar que tenga pocos números

	if(numero.length < 7){
			$('#error_numero_c').show(0);
			return false;
		}

	//Validar número de Perú

	if(codigo == '+51'){

		if(numero.length > 9){
			$('#error_numero_c').show(0);
			return false;
		}
	}

	///Guardar datos de contacto

	var url = base_url+'chat/save_contacto';

	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'codigo':codigo,'numero':numero,'nombre':nombre, 'apellido': apellido, 'email':email,'dni':dni, 'id_proyecto' :id_proyecto, 'id_cliente' :id_cliente},

	    success: function (data) {

	    	var json = JSON.parse(data);

	    	if(json.res == 'error')
		    {
		    	if(json.error == 'error_numero_c'){
		    		$('#error_numero_c').show(0);
					return false;
		    	}
		    }

		    if(json.res == 'error')
		    {
		    	if(json.error == 'datos_contacto'){
		    		$('.datos_c_body').html(json.msg);
		    		$('.conctacto_c_guardar').remove();
					return false;
		    	}
		    }

		    if(json.res == 'success')
		    {
		    	$('.datos_c_body').html(json.msg);
		    	$('.conctacto_c_guardar').remove();
		    	setTimeout(function(){$('#contacto_c_modal').modal('hide');},5000); 
		    }
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})

	return true;
}

function enviar_llamada_c(){

	//Asignar variables

	var numero = $('#numero_chat_llamada').val();
	var codigo = $('#codigo_chat_llamada').val();
	var cliente_id = $('#cliente_id').val();
	var proyecto_id = $('#proyecto_id').val();

	//Validar número de teléfono

	//Validar que solo sean numeros

	if(numero.isInteger == false){
		$('#error_numero_c_llamada').show(100);
		return false;
	}
	//Validar que tenga pocos números

	if(numero.length < 7){
			$('#error_numero_c_llamada').show(0);
			return false;
		}

	//Validar número de Perú
	if(codigo == '+51'){
		if(numero.length > 9){
			$('#error_numero_c_llamada').show(0);
			return false;
		}
	}

	$('#error_numero_c_llamada').hide(0);

	//Realizar peticion del numero del vendedor

	var url = base_url+'chat/get_vendedor_llamada';

	$.ajax({

	    type: 'POST',

	    url:url,

	    data:{'numero':numero,'codigo':codigo,'cliente_id':cliente_id,'proyecto_id':proyecto_id},

	    success: function (data) {

	    	var json = JSON.parse(data);

	    	if(json.res == 'error')
		    {
		    	if(json.error == 'error_numero_c_llamada'){
		    		$('#error_numero_c_llamada').show(0);
					return false;
		    	}
		    }

		    if(json.res == 'success')
		    {
		    	$('#success_numero_c_llamada').show(0);
		    	$('.enviar_llamada_c').attr('disabled',true);
		    	make_call_c(numero,proyecto_id);
		    	setTimeout(function(){$('#chat_phone_modal').modal('hide');},5000); 

		    }
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }
	})
}

function enviar_llamada_c_g(){

	//Asignar variables

	var numero = $('#numero_chat_llamada_g').val();
	var codigo = $('#codigo_chat_llamada_g').val();

	//Validar número de teléfono
	//Validar que solo sean numeros

	if(numero.isInteger == false){
		$('#error_numero_c_llamada_g').show(100);
		return false;
	}

	//Validar que tenga pocos números

	if(numero.length < 7){
			$('#error_numero_c_llamada_g').show(0);
			return false;
		}

	//Validar número de Perú

	if(codigo == '+51'){

		if(numero.length > 9){
			$('#error_numero_c_llamada_g').show(0);
			return false;
		}
	}

	$('#error_numero_c_llamada_g').hide(0);

	//Realizar llamada general

	var telefono_cliente = codigo+numero;
	
	$('#success_numero_c_llamada_g').show(0);
	$('.enviar_llamada_c_g').attr('disabled',true);
	make_call_c(telefono_cliente,'+51968088804');
	setTimeout(function(){$('#call_gratis_c_modal').modal('hide');},5000); 

}
function make_call_c(cliente,proyecto){

	/* antes parametros cliente,proyecto
	var url = c_url+'?dst='+cliente+'&src='+vendedor;

	$.ajax({

	    type: 'GET',

	    url:url,

	    data:{},

	    success: function (data) {

	    	console.log(data);
	    },
	    error: function () {
	      console.log('Ocurrio un error por favor intente nuevamente');
	    }

	    url: "https://35.236.241.218/make_call.php",
	})*/
    var datos = "number=" + cliente +"&proyecto=" + proyecto ;
    if ( cliente.length > 0 && cliente!=999999999) {
        $.ajax({
            type: "POST",
            url: "https://gruposocopur.tecnicom.pe/make_call.php",
            data: datos,
            success: function(data) {                        
              console.log("Correcto");
            }
        });
    }
}
function sololetras(e)
{
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false;

    for(var i in especiales)
    {
        if(key == especiales[i])
        {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

function valida(e)
{
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite

    if (tecla==8)
    {
       return true;
    }

    // Patron de entrada, en este caso solo acepta numeros

    patron =/[0-9]/;

    tecla_final = String.fromCharCode(tecla);
    
    return patron.test(tecla_final);
}



function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function bajar_scroll(){
	var ir =  parseInt($(".msg_card_body").scrollTop()) + parseInt($(".chatbox").height()) + 200;

	$(".msg_card_body").animate({ scrollTop: ir}, "slow");
}