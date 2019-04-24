<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->library('applib',array());
	}

	public function index(){
		
		redirect(base_url());
	}

	function start_chat(){

		if($this->input->post()){

			//Si ya ha iniciado la conversacion

			if($this->session->userdata('cliente_id') != ""){
				echo json_encode(array('res' => 'error'));
			}

			//Registrar nuevo usuario para conversacion

			$save = applib::create(applib::$clientes_table,array('ip_address' => applib::get_ip(),'fecha_ingreso' => applib::fecha()));
			
			//Iniciar conversacion con el usuario

			$data_con = array(
				'from_id'	=> 0,
				'to_id'		=> $save,
				'mensaje'	=> MENSAJE_INICIO,
				'date'		=> applib::fecha()
			);

			applib::create(applib::$mensajes_table,$data_con);

			//iniciar session de usuario

			$this->session->set_userdata('cliente_id',$save);

			//Enviar respuesta

			echo json_encode(array('res' => 'success'));
		}
	}

	function mostrar_chat(){

		if($this->input->post()){

			$user = $this->session->userdata('cliente_id');

			//obtener conversacion del usuario

			$this->load->model('mensajes_model');

			$condition = '(m.from_id = '.$user.' OR m.to_id = '.$user.') AND status = 1';

			$mensajes = $this->mensajes_model->get_all($condition);

			$cuerpo = "";

			$vistos = 0;

			if(count($mensajes) > 0){

				//Recorrer para saber si hay sin ver

				foreach ($mensajes as $m) {
					
					if($m['visto'] == 0){
						$vistos++;
					}
				}

				$cuerpo = $this->load->view('frontend/comunes/mensajes',compact("mensajes"),true);

				//Actualizar como vistos

				if($vistos > 0){
					applib::update('(to_id = '.$user.' OR from_id = '.$user.') AND visto = 0',applib::$mensajes_table,array('visto' => 1));
				}

				
			}

			echo json_encode(array('res' => 'success','cuerpo' => $cuerpo,'vistos' => $vistos));
			exit;

		}
	}

	function send_msg(){

		if($this->input->post()){

			$mensaje = $this->input->post('mensaje',true);

            $user = $this->session->userdata('cliente_id');

            if($mensaje == "" OR $user == "")
            {
                echo json_encode(array('res' => 'error'));
                exit;
            }

            //Guardar mensaje

            $data_in = array(
                'from_id' 	=> $user,
                'to_id'   	=> 0,
                'mensaje'   => $mensaje,
                'date'		=> applib::fecha()
            );

            applib::create(applib::$mensajes_table,$data_in);

            echo json_encode(array('res' => 'success'));
          

		}
	}

	//Respuesta del bot según lo que halla escrito el usuario

	function escribir_bot(){

		if($this->input->post()){

			$user = $this->session->userdata('cliente_id');

			//datos del cliente

			$cliente = applib::get_table_field(applib::$clientes_table,array('id' => $user),'*');

			//Averiguar si ha escrito

			$condition = 'from_id = '.$user.' AND status = 1';

			$respuestas = applib::get_all('*',applib::$mensajes_table,$condition);

			//Si la persona aún no ha elegido un lugar o la pregunta contiene algun caso

			if($cliente['lugar'] == null AND count($respuestas) > 0){

				//Buscar ultimo mensaje del robot

				$ultima = applib::get_table_field(applib::$mensajes_table,array('from_id' => 0,'to_id' => $user,'status' => 1),'*','id Desc');

				if($ultima != ""){
					$condition .= ' AND id >'.$ultima['id'];

					//Buscar mensajes a partir del ultimo mensaje del robot

					$respuestas = applib::get_all('*',applib::$mensajes_table,$condition);
				}

				//Obtener nombres de proyectos

				$proyectos = applib::get_all('*',applib::$proyectos_table,array('status' => 1));

				$this->load->helper("text");

				$conseguir_proyecto = false;

				$mensaje = array();

				//Buscar dentro de los mensajes si el usuario nombró el proyecto.

				foreach ($respuestas as $r) {

					foreach ($proyectos as $p) {
						
						if(preg_match("/".$p['name']."/i", convert_accented_characters($r['mensaje']))){
							
							//Si se encontró el nombre del proyecto se debbe asignar el lugar y el proyecto al usuario

							$mensaje[]= $p['descripcion'];

							applib::update(array('id' => $user),applib::$clientes_table,array('lugar' => $p['departamento_id'],'proyecto_id' => $p['id'],'desc_enviada' => 1));

							$conseguir_proyecto = true;

							$proyecto_id = $p['id'];
						}
					}
				}

				//si no encontró el proyecto, filtrar por departamentos y estados.

				if($conseguir_proyecto == false){

					//Obtener departamemntos

					$departamentos = applib::get_all('*',applib::$ubdepartamento_table,array());

					//Revisar si consigue el departamento

					foreach ($respuestas as $r) {

						foreach ($departamentos as $p) {
							
							if(preg_match("/".$p['departamento']."/i", convert_accented_characters($r['mensaje']))){
								
								//Si se encuentra el departamento se buscan los proyectos existentes

								$existen = applib::get_all('*',applib::$proyectos_table,array('departamento_id' => $p['id'],'status' => 1));

								if(count($existen) > 0){

									//Actualizar lugar en el cliente

									applib::update(array('id' => $user),applib::$clientes_table,array('lugar' => $p['id'] != 15?2:1));

									//Enviar mensaje con lista de proyectos

									$msg = 'En '.$p['departamento'].' tenemos disponibles los siguientes proyectos, Elije en el que estas interesado.';

									$this->respuesta_proyectos($p['id'] == 15?1:0,$msg);
									echo json_encode(array('res' => 'success'));
									exit;

								}else{

								}
							}
						}
					}
				}

				//En casi de conseguir el proyecto

				if($conseguir_proyecto){

					//Enviar mensajes de proyectos conseguidos

					foreach ($mensaje as $key => $value) {

						$data_in = array(
				            'from_id' 	=> 0,
				            'to_id'   	=> $user,
				            'mensaje'   => $value,
				            'sin_fondo' => 0,
				            'date'		=> applib::fecha()
				        );

			        	applib::create(applib::$mensajes_table,$data_in);
					}

					//recorrer respuestas de nuevo para saber si nombró la palabra banco

					// foreach($respuestas as $r){

					// 	if(preg_match("/banco\b/i", convert_accented_characters($r['mensaje']))){

					// 		//Si se nombra la palabra se le da información del banco

					// 		$mensaje[] = 'Este proyecto trabaja con el banco '.applib::get_field(applib::$proyectos_table,array("id" => $proyecto_id),"banco").'.';
					// 	}
					// }

					//Actualizar vendedor para el usuario

					$vendedor = applib::get_vendedor($proyecto_id);

					applib::update(array('id' => $user),applib::$clientes_table,array('vendedor_id' => $vendedor['vendedor_id']));

					$this->respuesta_detalles(false);
				}

				if($conseguir_proyecto == false){
					$this->respuesta_provincias();
				}

				echo json_encode(array('res' => 'success'));
				exit;
			} 

			//Si la persona tiene lugar y no proyecto

			if($cliente['lugar'] != null AND $cliente['proyecto_id'] == null){
				
				$this->respuesta_proyectos($cliente['lugar']);

				echo json_encode(array('res' => 'success'));
				exit;
			}
			
			//Si la persona tiene lugar, proyecto y no se le ha enviado la descripcion

			if($cliente['lugar'] != null AND $cliente['proyecto_id'] != null AND $cliente['desc_enviada'] == 0){
				
				$this->respuesta_detalles();
				
				echo json_encode(array('res' => 'success'));
				exit;
			}

			//En caso de que venga para comunicarse

			$com = $this->input->post('com',true);

			if($com == 'com'){
				$this->respuesta_final('Elije una opción para comunicarte con nuestros asesores.');
				echo json_encode(array('res' => 'success'));
				exit;
			}

			//En caso de que venga una pregunta 

			$id = $this->input->post('res',true);

			if($id != 0){
				$this->respuesta_preguntas($id);
				echo json_encode(array('res' => 'success'));
				exit;
			}else{

				//verificar si se han respondido todas las preguntas 

				$this->load->model('cualidades_model');

				$todas_respuestas = $this->cualidades_model->todas_respuestas($cliente['proyecto_id']);

				if($todas_respuestas == false){
					$this->mostrar_preguntas();
					echo json_encode(array('res' => 'success'));
					exit;
				}
				else{
					$this->respuesta_final();
					echo json_encode(array('res' => 'success'));
					exit;
				}

			}

			

			// if($cliente['lugar'] != null AND $cliente['proyecto_id'] != null AND $cliente['desc_enviada'] == 1 AND $todas_respuestas == false){
			// 	$this->respuesta_preguntas();
			// }

			//Si la persona tiene las tres cosas

			// if($cliente['lugar'] != null AND $cliente['proyecto_id'] != null AND $cliente['desc_enviada'] == 1){
			// 	$this->respuesta_final();
			// }

		}
	}

	//Crear una respuesta para dar opciones al usuario por provincia

	private function respuesta_provincias(){
		
		$user = $this->session->userdata('cliente_id');

		//Crear mensaje preguntando

		$data_in = array(
            'from_id' 	=> 0,
            'to_id'   	=> $user,
            'mensaje'   => 'Para brindarle más información, por favor indique la ubicación del proyecto en el que está interesado.',
            'date'		=> applib::fecha()
        );

        applib::create(applib::$mensajes_table,$data_in);

		//Crear mensaje de botones

		$mensaje = $this->load->view('frontend/comunes/botones_provincia',null,true);

		$data_in['mensaje'] = $mensaje;
		$data_in['sin_fondo'] = 1;
           
        applib::create(applib::$mensajes_table,$data_in);

        return true;
	}

	//Funcion para devolver el listado de proyectos

	private function respuesta_proyectos($id,$msg = null){

		$user = $this->session->userdata('cliente_id');

		$msg = $msg == null?'Para poder ayudarle por favor haga click en el proyecto que está interesado.':$msg;
		//Crear mensaje preguntando

		$data_in = array(
            'from_id' 	=> 0,
            'to_id'   	=> $user,
            'mensaje'   => $msg,
            'date'		=> applib::fecha()
        );

        applib::create(applib::$mensajes_table,$data_in);

		//Crear mensaje de botones para proyectos

		$condition = $id == 1?'departamento_id = 15 AND status = 1':'departamento_id != 15 AND status = 1';

		$data['proyectos'] = applib::get_all('*',applib::$proyectos_table,$condition);

		$mensaje = $this->load->view('frontend/comunes/botones_proyectos',$data,true);
	
		$data_in['mensaje'] = $mensaje;
		$data_in['sin_fondo'] = 1;
           
        applib::create(applib::$mensajes_table,$data_in);

        return true;
	}

	//Funcion para escribir los detalles de un proyecto y la propuesta para llamar

	private function respuesta_detalles($desc = true){

		$user = $this->session->userdata('cliente_id');

		//Obtener datos del cliente

		$this->load->model('clientes_model');

		$cliente = $this->clientes_model->get_by(array('c.id' => $user));

		//Obtener datos del proyecto

		$proyecto = applib::get_table_field(applib::$proyectos_table,array('id' => $cliente['proyecto_id'],'status' => 1),'*');

		//Asignar vendedor a este proyecto de no tenerlo

		$vendedor = $cliente['vendedor_id'];

		$vendedor_telefono = $cliente['telefono'];

		if($vendedor == ""){

			$vendedor = applib::get_vendedor($cliente['proyecto_id']);

			$vendedor_telefono = $vendedor['telefono'];

			$vendedor = $vendedor['vendedor_id'];

			applib::update(array('id' => $user),applib::$clientes_table,array('vendedor_id' => $vendedor));
		}

		$mensaje = array();

		//Crear mensaje para datos del proyecto

		if($desc == true){
			$mensaje[] = $proyecto['descripcion'];
		}

        //Preguntar que deseas saber

		$mensaje[] = "sin_fondo";

		$this->load->model('cualidades_model');

		$data['cualidades'] = $this->cualidades_model->get_by_proyecto(array('rc.proyecto_id' => $proyecto['id'],'oc.status' => 1));

		$mensaje[] = $this->load->view('frontend/comunes/que_deseas',$data,true);

		$sin_fondo = 0;

		foreach ($mensaje as $key => $value) {
						
			if($value == "sin_fondo"){
				$sin_fondo = 1;
				continue;
			}

			$data_in = array(
		        'from_id' 	=> 0,
		        'to_id'   	=> $user,
		        'mensaje'   => $value,
		        'sin_fondo' => $sin_fondo,
		        'date'		=> applib::fecha()
		    );

	        applib::create(applib::$mensajes_table,$data_in);
		}
        //Guardar descripcion enviada

        applib::update(array('id' => $user),applib::$clientes_table,array('desc_enviada' => 1));

        return true;
	}

	//Funcion para enviar las preguntas de cualidades

	private function respuesta_preguntas($id){

		$user = $this->session->userdata('cliente_id');

		$this->load->model('clientes_model');

		$cliente = $this->clientes_model->get_by(array('c.id' => $user));

		//Responder pregunta del usuario

		$mensaje[] = applib::get_field(applib::$res_cualidades_table,array('id' => $id),'respuesta');

		//Buscar las preguntas que aun no han sido respondidas al usuario

		$this->load->model('cualidades_model');

		$data['cualidades'] = $this->cualidades_model->get_faltantas($cliente['proyecto_id']);
		
		$data['msg'] = '¿Deseas saber algo más?';

		$mensaje[] = "sin_fondo";

		$mensaje[] = $this->load->view('frontend/comunes/mas_pregutas',$data,true);

		$sin_fondo = 0;

		foreach ($mensaje as $key => $value) {
						
			if($value == "sin_fondo"){
				$sin_fondo = 1;
				continue;
			}

			$data_in = array(
		        'from_id' 	=> 0,
		        'to_id'   	=> $user,
		        'mensaje'   => $value,
		        'sin_fondo' => $sin_fondo,
		        'date'		=> applib::fecha()
		    );

	        applib::create(applib::$mensajes_table,$data_in);
		}

		return true;
	}

	//Funcion para mostrar todas las preguntas

	function mostrar_preguntas(){

		$user = $this->session->userdata('cliente_id');

		$this->load->model('clientes_model');

		$cliente = $this->clientes_model->get_by(array('c.id' => $user));

		//Buscar las preguntas que aun no han sido respondidas al usuario

		$this->load->model('cualidades_model');

		$data['cualidades'] = $this->cualidades_model->get_faltantas($cliente['proyecto_id']);

		$data['msg'] = 'Para obtener más información, elije una opción.';

		$mensaje = $this->load->view('frontend/comunes/mas_pregutas',$data,true);

		//Enviar mensaje

		$data_in = array(
	        'from_id' 	=> 0,
	        'to_id'   	=> $user,
	        'mensaje'   => $mensaje,
	        'sin_fondo' => 1,
	        'date'		=> applib::fecha()
	    );

        applib::create(applib::$mensajes_table,$data_in);

		return true;
	}

	//Funcion para crear la respuesta final

	private function respuesta_final($msg = null){

		$user = $this->session->userdata('cliente_id');

		//Obtener datos del cliente

		$this->load->model('clientes_model');

		$cliente = $this->clientes_model->get_by(array('c.id' => $user));

		//Obtener datos del proyecto

		$proyecto = applib::get_table_field(applib::$proyectos_table,array('id' => $cliente['proyecto_id'],'status' => 1),'*');

		//Crear mensaje para info de contacto

		$mensaje = array();

		$mensaje[] = $msg == null?'Para obtener más información, Elije una de las siguientes opciones:':$msg;


		$data['whatsapp'] = applib::get_whatsapp($cliente['telefono']);

		$data['llamada'] = applib::poder_llamar($cliente['proyecto_id']);

		$mensaje[] = 'sin_fondo';

		$mensaje[] = $this->load->view('frontend/comunes/vendedor',$data,true);

		$sin_fondo = 0;

		foreach ($mensaje as $key => $value) {

			if($value == 'sin_fondo'){
				$sin_fondo = 1;
				continue;
			}
			
			$data_in = array(
	            'from_id' 	=> 0,
	            'to_id'   	=> $user,
	            'mensaje'   => $value,
	            'sin_fondo'	=> $sin_fondo,
	            'date'		=> applib::fecha(),
	        );

	        applib::create(applib::$mensajes_table,$data_in);
		}
		

        return true;
	}

	//Funcion para setear la ubicacion

	function set_ubicacion(){

		if($this->input->post('id')){
			
			$id = $this->input->post('id',true);

			$user = $this->session->userdata('cliente_id');

			if($id != 1 AND $id != 2){
				echo json_encode(array('res' => 'error'));
				exit;
			}

			//Verificar si ya tiene la ubicacion colocada para no volver a mostrar 

			$cliente = applib::get_table_field(applib::$clientes_table,array('id' => $user),'*');
			
			if($cliente['lugar'] != null){
				echo json_encode(array('res' => 'error'));
				exit;
			}

			//Colocar ubicacion del proyecto para filtrar

			applib::update(array('id' => $user),applib::$clientes_table,array('lugar' => $id));

			echo json_encode(array('res' => 'success'));
		}
	}

	//Funcion para setear el proyecto

	function set_proyecto(){

		if($this->input->post('id')){
			
			$id = $this->input->post('id',true);

			$user = $this->session->userdata('cliente_id');

			//Validar que existe el proyecto

			$proyecto = applib::get_table_field(applib::$proyectos_table,array('id' => $id,'status' => 1),'*');

			if($proyecto == ""){
				echo json_encode(array('res' => 'error'));
				exit;
			}

			//Verificar si ha seleccionado un proyecto para no volver a mostrar

			$cliente = applib::get_table_field(applib::$clientes_table,array('id' => $user),'*');
			
			if($cliente['proyecto_id'] != null){
				echo json_encode(array('res' => 'error'));
				exit;
			}

			//Colocar proyecto 

			applib::update(array('id' => $user),applib::$clientes_table,array('proyecto_id' => $id));

			echo json_encode(array('res' => 'success'));
		}
	}

	//Funcion de setear datos de contacto

	function set_form_contacto(){

		if($this->input->post('id')){

			$user = $this->session->userdata('cliente_id');

			$mensaje = $this->load->view('frontend/comunes/form_contacto',null,true);

			$data_in = array(
	            'from_id' 	=> 0,
	            'to_id'   	=> $user,
	            'mensaje'   => $mensaje,
	            'sin_fondo'	=> 1,
	            'date'		=> applib::fecha(),
	        );

	        applib::create(applib::$mensajes_table,$data_in);

	        echo json_encode(array('res' => 'success'));

		}

	}

	function save_contacto(){

		if($this->input->post()){

			$user = $this->input->post('id_cliente',true);

			$codigo = $this->input->post('codigo',true);

			$numero = trim($this->input->post('numero',true));

			$nombre = $this->input->post('nombre',true);

			$apellido = $this->input->post('apellido',true);

			$email = $this->input->post('email',true);

			$dni = $this->input->post('dni',true);

			$id_proyecto = $this->input->post('id_proyecto',true);

			//Validar si es un número entero y si tiene pocos números

			if(!is_numeric($numero) || $numero < 7){
				echo json_encode(array('res' => 'error','error' => 'error_numero_c'));
				exit;
			}

			//Validar codigo teléfonico

			$check = applib::get_table_field(applib::$prefijos_table,array('codigo' => $codigo),'*');

			if($check == ""){
				echo json_encode(array('res' => 'error','error' => 'error_numero_c'));
				exit;
			}

			//Validar si es un teléfono del peru y tiene mas de 9 digitos

			if($codigo == '+51'){

				if(strlen($numero) > 9){
					echo json_encode(array('res' => 'error','error' => 'error_numero_c'));
					exit;
				}
			}

			//Obtener datos del usuario 

			$usuario = applib::get_table_field(applib::$clientes_table,array('id' => $user),'*');

			//Validar si ya se guardaron los datos de contacto

			if($usuario['datos_contacto'] == 1){
				echo json_encode(array('res' => 'error','error' => 'datos_contacto','msg' => '<p style="color: #636467;font-weight: bold;" class="no_datos">¡Ya nos has enviado tus datos de contacto!</p>'));
				exit;
			}

			//Dar formato al telefono

			$telefono = applib::format_telefono($codigo,$numero);

			//guardar datos

			$data_in = array(
				'cliente_id'	=> $user,
				'vendedor_id'	=> $usuario['vendedor_id'],
				'telefono'		=> $telefono,
				'nombre'		=> $nombre,
				'apellido'		=> $apellido,
				'email'			=> $email,
				'dni'			=> $dni,
				'date'			=> applib::fecha(),
				'id_proyecto'   => $id_proyecto
			);

			applib::create(applib::$datos_contacto_table,$data_in);

			//Colocar vendedor como enviado

			applib::update(array('vendedor_id' => $data_in['vendedor_id']),applib::$orden_vendedor_table,array('status' => 1));

			//Guardar llamado a vendedor

			applib::create(applib::$llamado_vendedor_table,array('vendedor_id' => $data_in['vendedor_id'],'tipo_llamado_id' => 3,'created_at' => applib::fecha(),'cliente_id' => $user));

			//Actualizar datos como enviados

			applib::update(array('id' => $user),applib::$clientes_table,array('datos_contacto' => 1));

			//Regresar respuesta positiva

			echo json_encode(array('res' => 'success','msg' => '<p style="color: #089208;font-weight: bold;" class="listo_datos">¡Listo! Ya hemos recibidos tus datos. En breve nuestros agentes se comunicaran contigo.</p>'));
			exit;

		}
	}

	//Setear llamado a la accion para el vendedor

	function set_llamado(){

		if($this->input->post()){

			//Obtener datos del cliente

			$cliente = applib::get_table_field(applib::$clientes_table,array('id' => $this->session->userdata('cliente_id')),'*');

			//Guardar llamado

			applib::update(array('vendedor_id' => $cliente['vendedor_id']),applib::$orden_vendedor_table,array('status' => 1));

			//Guardar llamado a vendedor

			applib::create(applib::$llamado_vendedor_table,array('vendedor_id' => $cliente['vendedor_id'],'tipo_llamado_id' => 2,'created_at' => applib::fecha(),'cliente_id' => $cliente['id']));

			echo "success";

		}
	}

	function set_pregunta(){

		if($this->input->post('id')){
			
			$id = $this->input->post('id',true);

			$user = $this->session->userdata('cliente_id');

			//Obtener datos del cliente

			$cliente = applib::get_table_field(applib::$clientes_table,array('id' => $user),'*');

			if($cliente['proyecto_id'] == null){
				echo json_encode(array('res' => 'error'));
				exit;
			}

			//Validar que existe la pregunta

			$pregunta = applib::get_table_field(applib::$res_cualidades_table,array('proyecto_id' => $cliente['proyecto_id'],'id' => $id),'*');

			if($pregunta == ""){
				echo json_encode(array('res' => 'error'));
				exit;
			}

			//Colocar pregunta respondida 

			applib::create(applib::$cliente_respuesta_table,array('cliente_id' => $user,'cualidad_id' => $pregunta['cualidad_id'],'created_at' => applib::fecha()));

			echo json_encode(array('res' => 'success'));
		}
	}

	//Funcion para validar numero y obtener vendedor del proyecto

	function get_vendedor_llamada(){

		if($this->input->post()){

			$user = $this->input->post('cliente_id',true);
			$proyecto_id = $this->input->post('proyecto_id',true);
			$codigo = $this->input->post('codigo',true);
			$numero = trim($this->input->post('numero',true));

			//Validar si es un número entero y si tiene pocos números

			if(!is_numeric($numero) || $numero < 7){
				echo json_encode(array('res' => 'error','error' => 'error_numero_c_llamada'));
				exit;
			}

			//Validar codigo teléfonico

			$check = applib::get_table_field(applib::$prefijos_table,array('codigo' => $codigo),'*');

			if($check == ""){
				echo json_encode(array('res' => 'error','error' => 'error_numero_c_llamada'));
				exit;
			}

			//Validar si es un teléfono del peru y tiene mas de 9 digitos

			if($codigo == '+51'){

				if(strlen($numero) > 9){
					echo json_encode(array('res' => 'error','error' => 'error_numero_c_llamada'));
					exit;
				}
			}

			//Obtener datos del usuario 

			$usuario = applib::get_table_field(applib::$clientes_table,array('id' => $user),'*');

			//obtener datos del vendedor

			$vendedor = applib::get_table_field(applib::$vendedores_table,array('id' => $usuario['vendedor_id']),'*');

			//Dar formato al telefono

			$telefono_cliente = applib::format_telefono($codigo,$numero);

			$telefono_vendedor = '51'.$vendedor['telefono'];

			//Colocar vendedor como enviado

			applib::update(array('vendedor_id' => $vendedor['id']),applib::$orden_vendedor_table,array('status' => 1));

			//Guardar llamado a vendedor

			applib::create(applib::$llamado_vendedor_table,array('vendedor_id' => $vendedor['id'],'tipo_llamado_id' => 1,'created_at' => applib::fecha(),'cliente_id' => $usuario['id'], 'proyecto_id' => $proyecto_id));

			applib::create(applib::$llamadas_table, array('fecha' => applib::fecha(), 'vendedor' => $vendedor['id'], 'proyecto_vendedor' => $proyecto_id, 'numcliente' => $telefono_cliente, 'cliente_id' => $usuario['id']));

			echo json_encode(array('res' => 'success','telefono_cliente' => $telefono_cliente));
			exit;

		}
	}

	
	//Funcion para realizar pruebas eliminando sesiones

	function borrar_session(){
		$this->session->set_userdata('cliente_id','');
		redirect(base_url());
	}

	// function csv(){
	// 	$datos = applib::get_all('*','prefijos',array());

	// 	foreach ($datos as $d) {
			
	// 		applib::update(array('id' => $d['id']),'prefijos',array('codigo' => trim($d['codigo'])));
			
	// 	}
	// }


	// function llenar(){
	// 	$todo = applib::get_all('*','respuestas_cualidades',array('proyecto_id' => 1));

	
	// 	foreach ($todo as $t) {
				
	// 			$data = array(
	// 			'proyecto_id' 	=> 7,
	// 			'cualidad_id' 	=> $t['cualidad_id'],
	// 			'respuesta'		=> $t['respuesta'],
	// 			'created_at'	=> applib::fecha()
 // 			);
			
	// 		applib::create('respuestas_cualidades',$data);
	// 		echo $t['cualidad_id'];
	// 		echo "<br>";

	// 	}
		
	// }
}
