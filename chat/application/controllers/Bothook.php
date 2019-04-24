<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bothook extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		
		redirect('https://www.google.com.pe');
	}

	function chatbot($key){

		//validar ingreso al chat
		if(!isset($key) || $key == ""){
			exit;
		}

		$data_empresa = empresas::get_empresa($key);

		//validar que la halla conseguido y esté habilitada

		if($data_empresa == false || $data_empresa['status'] == 0){
			exit;
		}

		/////////////////
		//Cargar libreria
		/////////////////
		/////////////////

		$this->load->library('applib',array('database' => $data_empresa['database']));

		$this->load->library('FbBot');

		$tokken = $_REQUEST['hub_verify_token'];

		$hubVerifyToken = 'tecnicombesco';

		$challange = $_REQUEST['hub_challenge'];

		$accessToken = 'EAAdBn252UPwBAINKNLB5JKSGKopwZBfZC3bIaTYUl8CiaT0qMoTgZBiN9LTwGE9AVlyjIp4AKeazXuZAHWMqK74dRyAjM351zmCtFZA7atloZCqAHHGoS1ZAo23rdyNL14q2P8Tb3hKyzMozsCyZBbzXMxYfVWkh3Hg8zas7d5ZBCidEpNh6ZCrmge';

		$this->fbbot->setHubVerifyToken($hubVerifyToken);

		$this->fbbot->setaccessToken($accessToken);

		echo $this->fbbot->verifyTokken($tokken,$challange);

		$input = json_decode(file_get_contents('php://input'), true);

		//Leer mensaje

		$message = $this->fbbot->readMessage($input);

		//Obtener usuario

		$cliente = applib::get_table_field(applib::$clientes_table,array('fb_id' => $message['senderid']),'*');

		if($cliente == ""){

			$cliente = array(
				'ip_address'	=> applib::get_ip(),
				'fecha_ingreso'	=> applib::fecha(),
				'fb_id'			=> $message['senderid'],
				'proyecto_id'	=> null
			);

			$cliente['id'] = applib::create(applib::$clientes_table,$cliente);
		}

		//Enviar que ya está visto

		$this->fbbot->actions_sender($message,'mark_seen');

		//Enviar que ya está escribiendo

		$this->fbbot->actions_sender($message,'typing_on');

		//tiempo apra escribir

		sleep(1.5);

		//Quitar escribiendo

		$this->fbbot->actions_sender($message,'typing_off');

		//Empezar a evaluar el mensaje

		$messageText = strtolower($message['message']);

		//Si el usuario escribe lima

		if(preg_match("/Empezar/i",$messageText)){

			//Obtener nombre de la persona

			$nombre = $this->get_nombre($cliente['fb_id']);

			$mensaje_inicio = MENSAJE_INICIO;

			if($nombre != false){
				$mensaje_inicio = 'Hola '.$nombre.', como podemos ayudarte?';
			}

			$this->fbbot->sendMessage($cliente['fb_id'],'texto',array('texto' => $mensaje_inicio));
        	exit;
		}

		//Frases comunes

		if(preg_match("/buenos dias/i",$messageText)){
			$this->fbbot->sendMessage($cliente['fb_id'],'texto',array('texto' => 'Buenos días'));
		}

		if(preg_match("/buen dia/i",$messageText)){
			$this->fbbot->sendMessage($cliente['fb_id'],'texto',array('texto' => 'Buenos días'));
		}

		if(preg_match("/buenas noches/i",$messageText)){
			$this->fbbot->sendMessage($cliente['fb_id'],'texto',array('texto' => 'Buenas noches'));
		}

		if(preg_match("/buenas tardes/i",$messageText)){
			$this->fbbot->sendMessage($cliente['fb_id'],'texto',array('texto' => 'Buenas tardes'));
		}

		if(preg_match("/Hola/i",$messageText)){
			$this->fbbot->sendMessage($cliente['fb_id'],'texto',array('texto' => 'Hola'));
		}

		////////////////////////////////////////////////////////////////////////////////////////////

		if(preg_match("/lima/i",$messageText)){

			//Actualizar lugar en base de datos

			applib::update(array('id' => $cliente['id']),applib::$clientes_table,array('lugar' => 1));

			//Guardar mensaje que envió el usuario

			$data_in = array('from_id' => $cliente['id'],'mensaje' => $messageText,'date' => applib::fecha());

        	applib::create(applib::$mensajes_table,$data_in);

        	//Guardar mensaje que se le envía al usuario

        	$texto = 'Estos son los proyectos disponibles en Lima. Escoge alguno para obtener información.';

        	$mensaje_user = $texto.' (Botones proyectos en Lima)';

			$data_in = array('to_id' => $cliente['id'],'mensaje' => $mensaje_user,'date' => applib::fecha());

        	applib::create(applib::$mensajes_table,$data_in);

        	//Obtener botones de lima

        	$botones = $this->get_botones_proyectos(1,$key);

			///Enviar mensaje de facebook al usuario

        	$this->fbbot->sendMessage($cliente['fb_id'],'botones',array('botones' => $botones,'texto' => $texto));
        	exit;

		}

		//Si el usuario escribe piura

		if(preg_match("/piura/i",$messageText)){

			//Actualizar lugar en base de datos

			applib::update(array('id' => $cliente['id']),applib::$clientes_table,array('lugar' => 2));

			//Guardar mensaje que envió el usuario

			$data_in = array('from_id' => $cliente['id'],'mensaje' => $messageText,'date' => applib::fecha());

        	applib::create(applib::$mensajes_table,$data_in);

        	//Guardar mensaje que se le envía al usuario

        	$texto = 'Estos son los proyectos disponibles en Piura. Escoge alguno para obtener información.';

        	$mensaje_user = $texto.' (Botones proyectos en Piura)';

			$data_in = array('to_id' => $cliente['id'],'mensaje' => $mensaje_user,'date' => applib::fecha());

        	applib::create(applib::$mensajes_table,$data_in);

        	//Obtener botones de lima

        	$botones = $this->get_botones_proyectos(2,$key);

			///Enviar mensaje de facebook al usuario

        	$this->fbbot->sendMessage($cliente['fb_id'],'botones',array('botones' => $botones,'texto' => $texto));
        	exit;
		}

		//Si el cliente escribe el nombre de alguno de los proyectos

		$proyectos = applib::get_all('*',applib::$proyectos_table,array('status' => 1));

		foreach ($proyectos as $p) {
						
			if(preg_match("/".$p['name']."/i", $messageText)){
				
				//Si se encontró el nombre del proyecto se debbe asignar el lugar y el proyecto al usuario

				applib::update(array('id' => $cliente['id']),applib::$clientes_table,array('lugar' => $p['departamento_id'] == 15?1:2,'proyecto_id' => $p['id'],'desc_enviada' => 1));

				//asignar vendedor al usuario

				$vendedor = applib::get_vendedor($p['id']);

				applib::update(array('id' => $cliente['id']),applib::$clientes_table,array('vendedor_id' => $vendedor['vendedor_id']));

				//Guardar mensaje que envió el usuario

				$data_in = array('from_id' => $cliente['id'],'mensaje' => $messageText,'date' => applib::fecha());

	        	applib::create(applib::$mensajes_table,$data_in);

	        	//Guardar mensaje que se le envia al usuario

	        	$texto = $p['descripcion'];

	        	$mensaje_user = $texto.' (Bloque desea saber algo mas)';

	        	$data_in = array('to_id' => $cliente['id'],'mensaje' => $mensaje_user,'date' => applib::fecha());

        		applib::create(applib::$mensajes_table,$data_in);

        		//Enviar mensaje a facebook

        		$this->fbbot->sendMessage($cliente['fb_id'],'texto',array('texto' => $texto));

        		$this->send_bloque_saber_mas($cliente['fb_id'],$key);
        		exit;
			}
		}

		//habla acerca de alguna cualidad y ya ha elegido el proyecto y lugar

		if($cliente['proyecto_id'] != ""){

			//Obtener cualdiades
			$cualidades = applib::get_all('*','opciones_cualidades',array('status' => 1));

			foreach ($cualidades as $p) {
						
				if(preg_match("/".$p['cualidad']."/i", $messageText)){

					//Obtener respuesta de la cualidad para este proyecto

					if($p['id'] != 2){
						$texto = applib::get_field(applib::$res_cualidades_table,array('cualidad_id' => $p['id'],'proyecto_id' => $cliente['proyecto_id']),'respuesta');
					} 
					else{
						$texto = '(Imagenes de metraje)';
					}

					//Guardar mensaje que envió el usuario

					$data_in = array('from_id' => $cliente['id'],'mensaje' => $messageText,'date' => applib::fecha());

		        	applib::create(applib::$mensajes_table,$data_in);

		        	//Guardar mensaje que se le envia al usuario

		        	$mensaje_user = $texto.' (Bloque desea saber algo mas)';

		        	$data_in = array('to_id' => $cliente['id'],'mensaje' => $mensaje_user,'date' => applib::fecha());

	        		applib::create(applib::$mensajes_table,$data_in);

	        		//Enviar mensaje a facebook

	        		if($p['id'] != 2){

	        			$this->fbbot->sendMessage($cliente['fb_id'],'texto',array('texto' => $texto));

	        			$this->send_bloque_saber_mas($cliente['fb_id'],$key);
	        			exit;
	        		}
	        		else{

	        			$elementos = $this->get_metraje($cliente['proyecto_id'],$key);

	        			$this->fbbot->sendMessage($cliente['fb_id'],'imagen',array('elementos' => $elementos));

	        			$this->send_bloque_saber_mas($cliente['fb_id'],$key);
	        			exit;
	        		}


				}
			}

			//Si pude hablar con un asesor

			if(preg_match("/Hablar con un Asesor/i",$messageText)){
				
				$this->send_comunicar_asesor($cliente['fb_id'],$key);
				exit;
			}
		}

		//Enviar mensaje por default

		$botones_default = $this->get_botones_default($key);

		$this->fbbot->sendMessage($cliente['fb_id'],'botones',array('botones' => $botones_default,'texto' => 'Para brindarles más información, por favor indique la ubicación del proyecto en el que está interesado.'));

		//$textmessage = $this->fbbot->sendMessage($message);
	}

	private function get_botones_proyectos($id,$key){

		//Cargar libreria

		$data_empresa = empresas::get_empresa($key);

		$this->load->library('applib',array('database' => $data_empresa['database']));

		//Buscar proyectos

		$condition = $id == 1?'departamento_id = 15 AND status = 1':'departamento_id != 15 AND status = 1';

		$proyectos = applib::get_all('*',applib::$proyectos_table,$condition);

		$botones = [];

		foreach ($proyectos as $p) {
			
			$botones[] =  [
                "content_type"  => "text",
                "title"         => $p['name'],
                "payload"       => $p['seo'],
            ];
		}

		return $botones;
	}

	private function send_bloque_saber_mas($sender,$key){

		//Cargar libreria

		$data_empresa = empresas::get_empresa($key);

		$this->load->library('applib',array('database' => $data_empresa['database']));

		//Enviar desea saber algo mas y boton de hablar con un asesor

		$botones = [];

		$botones[] = [
            "type"  		=> "postback",
            "title"         => 'Hablar con un Asesor',
            "payload"       => 'Hablar con un Asesor',
        ];

		$this->fbbot->sendMessage($sender,'postback',array('texto' => '¿Deseas saber algo más?','botones' => $botones));

		//Enviar opciones con botones para cualidades

		$botones_cualidades = $this->get_botones_cualidades($key);

		$this->fbbot->sendMessage($sender,'botones',array('botones' => $botones_cualidades,'texto' => 'O elige una opción:'));

	}

	private function get_botones_cualidades($key){

		//Cargar libreria

		$data_empresa = empresas::get_empresa($key);

		$this->load->library('applib',array('database' => $data_empresa['database']));

		//Obtener cualidades

		$cualidades = applib::get_all('*','opciones_cualidades',array('status' => 1));

		//Cargar botones

		$botones = [];

		foreach ($cualidades as $p) {
			
			$botones[] =  [
                "content_type"  => "text",
                "title"         => $p['cualidad'],
                "payload"       => $p['cualidad'],
            ];
		}

		return $botones;
	}

	private function send_comunicar_asesor($sender,$key){

		//Cargar libreria

		$data_empresa = empresas::get_empresa($key);

		$this->load->library('applib',array('database' => $data_empresa['database']));

		//Obtener datos del cliente

		$cliente = applib::get_table_field(applib::$clientes_table,array('fb_id' => $sender),'*');

		//Obtener datos del proyecto

		$proyecto = applib::get_table_field(applib::$proyectos_table,array('id' => $cliente['proyecto_id']),'*');

		//Crear botones

		$this->fbbot->sendMessage($sender,'texto',array('texto' => ''));

		$botones = [];
/*
		$botones[] = [
           	"type"					=> "web_url",
			"url" 					=> applib::get_whatsapp(applib::get_field(applib::$vendedores_table,array('id' => $cliente['vendedor_id']),'telefono')),
			"title"					=> "Escribir a WhatsApp"
        ];
*/
        $botones[] = [
           	"type"					=> "web_url",
			"url" 					=> 'https://chat.tecnicom.pe/index.php/sender/contacto/'.$proyecto['seo'].'/L5437788',
			"title"					=> "Dejar Datos Contacto",
			'messenger_extensions' 	=> true
        ];
/*
        if($proyecto['aceptar_llamadas'] == 1){

        	$botones[] = [
           		"type"					=> "web_url",
				"url" 					=> 'https://chat.tecnicom.pe/index.php/sender/llamada/'.$proyecto['seo'].'/L5437788',
				"title"					=> "¡Llámanos Gratis!",
				'messenger_extensions' 	=> true
        	];
        } */

		$this->fbbot->sendMessage($sender,'postback',array('texto' => 'Elige como deseas comunicarte:','botones' => $botones));

	}

	//Obtener metrajes

	private function get_metraje($id,$key){

		//Cargar libreria

		$data_empresa = empresas::get_empresa($key);

		$this->load->library('applib',array('database' => $data_empresa['database']));

		//Obtener metraje segun el proyecto

		$metrajes = applib::get_all('*','metrajes',array('proyecto_id' => $id,'status' => 1));

		//Cargar metrajes

		$elements = [];

		foreach ($metrajes as $p) {
			
			$elements[] =  [
               "title"				 	=> $p['name'],
                "image_url" 			=> $p['url_imagen'],
                "subtitle"  			=> $p['descripcion'],
                "default_action" 		=>  [
                  "type" 					=> "web_url",
                  "url" 					=> $p['url_web'],
                  "messenger_extensions" 	=> true,
                  "webview_height_ratio" 	=> "tall",
                  "fallback_url" 			=> $p['url_web'],
                ]
            ];
		}

		return $elements;
	}

	//Funcion para obtener los botones por default

	private function get_botones_default($key){

		//Cargar libreria

		$data_empresa = empresas::get_empresa($key);

		$this->load->library('applib',array('database' => $data_empresa['database']));

		//Cargar botones default

		$botones = [];

		$botones[] =  [
            "content_type"  => "text",
            "title"         => "Lima",
            "payload"       => "Lima",
        ];

        $botones[] =  [
            "content_type"  => "text",
            "title"         => "Piura",
            "payload"       => "Piura",
        ];
		

		return $botones;
	}

	function boton_empezar(){
		 
		//API URL
		$url = 'https://graph.facebook.com/v2.6/me/messenger_profile?access_token=EAAdBn252UPwBAJPH8wVIL7bniEExp2O09F0YJ8C8JfBRLlvgUZAy9hqGPrZCJ1CvIz7cfktJmSGlzMxJ8NuSCh4VCT9JQg22ZCDEhlHb9BbEIDvWjOenV1lzVLn2xUshJAquXZBFdqLNnBmEeMQEKMnvdxShR27EMHCZAQNZBVkQZDZD';

		//create a new cURL resource
		$ch = curl_init($url);

		//setup request to send json via POST
		$data = [
		    'payload' => 'Empezar'
		];

		$payload = json_encode(array("get_started" => $data));

		//attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

		//set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

		//return response instead of outputting
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//execute the POST request
		$result = curl_exec($ch);

		//close cURL resource
		curl_close($ch);

		echo "listo";
	}

	//Funcion para obtener datos de la persona

	private function get_nombre($id){

		//API URL
		$url = 'https://graph.facebook.com/'.$id.'?fields=first_name,last_name,profile_pic&access_token=EAAdBn252UPwBAJPH8wVIL7bniEExp2O09F0YJ8C8JfBRLlvgUZAy9hqGPrZCJ1CvIz7cfktJmSGlzMxJ8NuSCh4VCT9JQg22ZCDEhlHb9BbEIDvWjOenV1lzVLn2xUshJAquXZBFdqLNnBmEeMQEKMnvdxShR27EMHCZAQNZBVkQZDZD';

		//create a new cURL resource
		$ch = curl_init($url);

		//return response instead of outputting
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//execute the POST request
		$result = curl_exec($ch);

		//close cURL resource
		curl_close($ch);

		if($result != ""){

			$result = json_decode($result);

			if(isset($result->first_name)){
				return $result->first_name;
			}
		}

		return false;
		
	}
}
