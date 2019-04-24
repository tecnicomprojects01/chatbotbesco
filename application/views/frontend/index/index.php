
    <link href="<?= base_url()?>public/frontend/css/bootstrap.min.css?v=<?= time()?>" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="<?= base_url()?>public/frontend/css/cb_css.css?v=<?= time()?>">
    <script src="<?= base_url()?>public/frontend/js/jquery.min.js"></script>
    <script src="<?= base_url()?>public/frontend/js/bootstrap.min.js"></script>
    <script>var intervalc = '';</script>
	<script src="<?= base_url()?>public/frontend/js/chat.js?v=<?= time()?>"></script>

	<script>var base_url = "<?= base_url()?>index.php/"</script>
	<script>var base_url_no = "<?= base_url()?>"</script>
    <script>var start_c = "<?= $start?>"</script>
    <script>var USER_PIC = "<?= USER_PIC?>"</script>

    <script type="text/javascript">

        window.alert = function(){};

        var defaultCSS = document.getElementById('bootstrap-css');

        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }

        $( document ).ready(function() {

        	//Guardar datos del chat
        	$('.guardar_datos_c').on('click',function(){
        		guardar_datos_c();
        	});

        	//Hacer llamada
        	$('.enviar_llamada_c').on('click',function(){
        		enviar_llamada_c();
        	});

        	//Hacer general
        	$('.enviar_llamada_c_g').on('click',function(){
        		enviar_llamada_c_g();
        	});

        	
         	
         	
         	//Iniciar chat
         	if(start_c){
         		start_chat();
         	}

         	//Mostrar chat
         	setTimeout("mostrar_chat()",500);
         	setTimeout("bajar_scroll()",1000);
       

         	intervalc = setInterval(mostrar_chat, 3000);
        
         	//mostrar menú 
          	$('#action_menu_btn').click(function(){
				$('.action_menu').toggle();
			});

          	var intervalo  ='';

          	//Verificar si está escribiendo el usuario
			type_msg.addEventListener("keyup", function(){

				
				    clearInterval(intervalo); //Al escribir, limpio el intervalo
				    intervalo = setInterval(function(){ //Y vuelve a iniciar
				        console.log("Has dejado de escribir"); //Cumplido el tiempo, se muestra el mensaje
				        if($('#si_escribio_c').val() == 1){
				        	setTimeout("escribir_bot()",500);
				        }
				        clearInterval(intervalo); //Limpio el intervalo
				    }, 2000);
				

			}, false);


			//hacer llamada
			$('#call_c').on('click',function(){make_call();});

        });
    </script>
  
	<input type="hidden" id="si_escribio_c" value="0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>public/frontend/css/jquery.mCustomScrollbar.min.css">
	<script type="text/javascript" src="<?= base_url()?>public/frontend/js/jquery.mCustomScrollbar.min.js"></script>

			
			<div class="col-md-12 col-xl-12 chat">
				<!-- <a  class="btn btn-primary" href="<?php //base_url('index.php/chat/borrar_session')?>" title="Boton de prueba para eliminar sesión" style="margin-bottom: 10px;color:white">Borrar session</a> -->
				<div class="card">
					<div class="card-header msg_head">

						<div class="d-flex bd-highlight">
							<div class="img_cont">
								<img src="<?= base_url()?>public/frontend/img/<?= ASISTENTE_PIC?>?v=<?= time()?>" class="rounded-circle user_img">
								<span class="online_icon"></span>
							</div>
							<div class="user_info">
								<span><?= BOT_NAME?></span>
								<p>Asesor Comercial</p>
							</div>
							
						</div>
						<!-- <a id="call_c" href="javascript:;" onclick="$('#call_gratis_c_modal').modal('show')" title="¡Llámanos Gratis!"><span style="font-size: 13px;" class="llamanos_gratis_chat">¡Llámanos Gratis!</span> <i class="fas fa-phone" style="font-size: 20px;"></i></a> -->
						<!-- <span id="minimize_c" onclick="minimize_c('<?php// $empresa['name']?>')"><i class="fas fa-window-minimize"></i></span> -->
						<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
						<div class="action_menu">
							<ul>
								<!-- <li  onclick="$('#call_gratis_c_modal').modal('show')" ><i class="fas fa-phone"></i> ¡Llámanos Gratis!</li> -->
								<!-- <li><img src="<?= base_url()?>public/frontend/img/whatsapp_menu.png?v=<?= time()?>" style="width: 27px;margin-left: -5px;margin-right: 5px;margin-bottom: 1px;"> Escribir al WhatsApp</li> -->
								<li onclick="form_contact_c()"><i class="fas fa-envelope"></i> Formulario de contacto</li>
				
							</ul>
						</div>
					</div>
					<div class="card-body msg_card_body" style="height: 500px;overflow-y: scroll;">

						<div class="chatbox">

							

						</div>
					</div>

					<div class="card-footer">
						<div style="padding: 8px;width: 97%;background: transparent;text-align: center;color: white;position: absolute;bottom: 77px;display: none;font-size: 14px" id="escribiendo"><?= BOT_NAME?> está escribiendo...</div>
						<div class="input-group">
							
							<input type="text" class="form-control type_msg" autocomplete="off"  id="type_msg" placeholder="Escriba su mensaje..." onkeypress="if(event.keyCode == 13) send_msg()" style="border-radius: 10px 0 0 10px;"> 
							<div class="input-group-append">
								<span class="input-group-text send_btn" onclick="send_msg()"><i class="fas fa-location-arrow"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
	

<audio id="audio_fb">
	<source src="<?= base_url('public/frontend/notify/chat.wav')?>" type="audio/mpeg"> 
</audio>

<div id="contacto_c_modal" class="modal fade" data-backdrop="true">
  	<div class="modal-dialog animate" id="animate">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" style="text-align: center;width: 100%;"><span style="margin-left: 16px;">Déjanos tus datos</span></h5>
        		  <a class="close" data-dismiss="modal" href="#">&times;</a>
      		</div>
      <div class="modal-body text-center p-lg datos_c_body">

      	<?php if(!isset($cliente['datos_contacto']) OR $cliente['datos_contacto'] == 0): ?>

      		<div class="form-group">
      			<input class="form-control" id="nombre_chat" placeholder="Ingresa tu nombre completo" maxlength="150" onkeypress="return sololetras(event)" onkeyup="$('#error_nombre_c').hide();">
      			<p class="error_c" id="error_nombre_c" style="display: none;">Debes ingresar tu nombre.</p>
      			
      		</div>

      		<div class="form-group">
      			<input class="form-control" id="dni_chat" placeholder="Ingresa tu DNI" maxlength="8" onkeypress="return valida(event)" >
      		</div>

      		<div class="form-group">
      			<select class="form-control" id="codigo_chat" style="width: 20%;display: inline-block;float: left;">
					<?php foreach ($prefijos as $p): ?>
						<option value="<?= $p['codigo']?>" <?=($p['codigo'] == PREFIJO_PRED)?'selected':''?>><?= $p['codigo']?></option>
					<?php endforeach ?>
				</select>

				<input type="text" id="numero_chat" class="form-control" placeholder="Ingresa tu número de teléfono" maxlength="12" onkeypress="return valida(event)" onkeyup="$('#error_numero_c').hide();" style="width: 77%;display: inline-block;float: left;    margin-left: 3%;">

				<p class="error_c" id="error_numero_c" style="display: none;margin-bottom: -58px;">El formato de tu número telefónico es incorrecto.</p>
      		</div>

      		<div class="form-group" style="margin-top: 68px;">
      			<input type="email" class="form-control" id="email_chat" placeholder="Ingresa tu correo electrónico" maxlength="150" >
      		</div>

		<?php endif ?>

		<?php if(isset($cliente['datos_contacto']) AND $cliente['datos_contacto'] == 1): ?>
			<p style="color: #636467;font-weight: bold;">¡Ya nos has enviado tus datos de contacto!</p>
		<?php endif ?>

      </div>
      	<?php if(!isset($cliente['datos_contacto']) OR $cliente['datos_contacto'] == 0): ?>
	      	<div class="modal-footer conctacto_c_guardar">
	      		<div class="col-md-4 col-xs-12"></div>

	      		<div class="col-md-4 col-xs-12 " style="text-align: center;">
	      			<button type="button" class="btn btn-primary p-x-md guardar_datos_c">Guardar</button>
	      		</div>

	      		<div class="col-md-4 col-xs-12"></div>
	        
	      	</div>
  		<?php endif ?>
    </div>
  </div>
</div>


<div id="chat_phone_modal" class="modal fade" data-backdrop="true">
  	<div class="modal-dialog animate" id="animate">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" style="text-align: center;width: 100%;"><span style="margin-left: 16px;">Ingresa tu número de teléfono</span></h5>
        		  <a class="close" data-dismiss="modal" href="#">&times;</a>
      		</div>
      <div class="modal-body text-center p-lg">

      		<div class="form-group">
      			<select class="form-control" id="codigo_chat_llamada" style="width: 20%;display: inline-block;float: left;">
					<?php foreach ($prefijos as $p): ?>
						<option value="<?= $p['codigo']?>" <?=($p['codigo'] == PREFIJO_PRED)?'selected':''?>><?= $p['codigo']?></option>
					<?php endforeach ?>
				</select>

				<input type="text" id="numero_chat_llamada" class="form-control" placeholder="Ingresa tu número de teléfono" maxlength="12" onkeypress="return valida(event)" onkeyup="$('#error_numero_c').hide();" style="width: 77%;display: inline-block;float: left;    margin-left: 3%;">

				<p class="error_c" id="error_numero_c_llamada" style="display: none;">El formato de tu número telefónico es incorrecto.</p>

				<p id="success_numero_c_llamada" style="display: none;color:green">¡Listo! En un momento lo llamaremos.</p>
      		</div>

      </div>
      	<div class="modal-footer conctacto_c_guardar">
      		<div class="col-md-4 col-xs-12"></div>

      		<div class="col-md-4 col-xs-12 " style="text-align: center;">
      			<button type="button" class="btn btn-primary p-x-md enviar_llamada_c">Guardar</button>
      		</div>

      		<div class="col-md-4 col-xs-12"></div>
        
      	</div>
  	
    </div>
  </div>
</div>

<div id="call_gratis_c_modal" class="modal fade" data-backdrop="true">
  	<div class="modal-dialog animate" id="animate">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" style="text-align: center;width: 100%;"><span style="margin-left: 16px;">Ingresa tu número de teléfono</span></h5>
        		  <a class="close" data-dismiss="modal" href="#">&times;</a>
      		</div>
      <div class="modal-body text-center p-lg">

      		<div class="form-group">
      			<select class="form-control" id="codigo_chat_llamada_g" style="width: 20%;display: inline-block;float: left;">
					<?php foreach ($prefijos as $p): ?>
						<option value="<?= $p['codigo']?>" <?=($p['codigo'] == PREFIJO_PRED)?'selected':''?>><?= $p['codigo']?></option>
					<?php endforeach ?>
				</select>

				<input type="text" id="numero_chat_llamada_g" class="form-control" placeholder="Ingresa tu número de teléfono" maxlength="12" onkeypress="return valida(event)" onkeyup="$('#error_numero_c').hide();" style="width: 77%;display: inline-block;float: left;    margin-left: 3%;">

				<p class="error_c" id="error_numero_c_llamada_g" style="display: none;">El formato de tu número telefónico es incorrecto.</p>

				<p id="success_numero_c_llamada_g" style="display: none;color:green">¡Listo! En un momento te llamaremos.</p>
      		</div>

      </div>
      	<div class="modal-footer conctacto_c_guardar">
      		<div class="col-md-4 col-xs-12"></div>

      		<div class="col-md-4 col-xs-12 " style="text-align: center;">
      			<button type="button" class="btn btn-primary p-x-md enviar_llamada_c_g">Llamar Gratis</button>
      		</div>

      		<div class="col-md-4 col-xs-12"></div>
        
      	</div>
  	
    </div>
  </div>
</div>

