<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sender extends CI_Controller {

	function __construct(){
		parent::__construct();
	
	}

	public function index(){
		
		redirect('https://www.google.com.pe');
	}

//Funcion para llevar a whatsapp

	function escribir_whatsapp($seo,$key,$cliente_id){

		if($seo == "" || $key == ""){
			redirect('https://www.google.com.pe');
		}

		//Validar el key

		$data_empresa = empresas::get_empresa($key);

		//validar que la halla conseguido y esté habilitada

		if($data_empresa == false || $data_empresa['status'] == 0){
			redirect('https://www.google.com.pe');
		}

		//Seleccionar base de datos segun la empresa

		$this->session->set_userdata('d_chatbot',$data_empresa['database']);

		$this->load->library('applib',array('database' => $data_empresa['database']));

		//Validar seo

		$proyecto = applib::get_table_field(applib::$proyectos_table,array('seo' => $seo,'status' => 1),'*');

		if($proyecto == ""){
			redirect('https://www.google.com.pe');
		}
			
		//Obtener datos de usuario y vendedor

		$user = applib::get_table_field(applib::$clientes_table,array('id' => $cliente_id),'*');

		$vendedor = applib::get_table_field(applib::$vendedores_table,array('id' => $user['vendedor_id']),'*');
		
		//Guardar llamado a la accion de whatsapp

		applib::update(array('vendedor_id' => $user['vendedor_id']),applib::$orden_vendedor_table,array('status' => 1));

		//Guardar llamado a vendedor

		applib::create(applib::$llamado_vendedor_table,array('vendedor_id' => $user['vendedor_id'],'tipo_llamado_id' => 2,'created_at' => applib::fecha(),'cliente_id' => $user['id'], 'proyecto_id' => $proyecto['id']));

		//Redirigir a comunicar con whatsapp

		redirect(applib::get_whatsapp($vendedor['telefono']));
	}

	function contacto($seo,$key,$cliente_id){

		if($seo == "" || $key == ""){
			redirect('https://www.google.com.pe');
		}

		//Validar el key

		$data_empresa = empresas::get_empresa($key);

		//validar que la halla conseguido y esté habilitada

		if($data_empresa == false || $data_empresa['status'] == 0){
			redirect('https://www.google.com.pe');
		}

		//Seleccionar base de datos segun la empresa

		$this->session->set_userdata('d_chatbot',$data_empresa['database']);

		$this->load->library('applib',array('database' => $data_empresa['database']));

		//Validar seo

		$proyecto = applib::get_table_field(applib::$proyectos_table,array('seo' => $seo,'status' => 1),'*');

		if($proyecto == ""){
			redirect('https://www.google.com.pe');
		}

		$data['cliente_id'] = $cliente_id;

		//Obtener prefijos

		$data['prefijos'] = applib::get_all('*',applib::$prefijos_table,array());

		$data['proyecto'] = applib::get_table_field(applib::$proyectos_table, array('seo' => $seo), 'id');

		$data['cliente'] = applib::get_table_field(applib::$clientes_table,array('id' => $cliente_id),'*');

		$this->load->view('frontend/sender/contacto',$data);

	}

	function llamada($seo,$key,$cliente_id){

		if($seo == "" || $key == ""){
			redirect('https://www.google.com.pe');
		}

		//Validar el key

		$data_empresa = empresas::get_empresa($key);

		//validar que la halla conseguido y esté habilitada

		if($data_empresa == false || $data_empresa['status'] == 0){
			redirect('https://www.google.com.pe');
		}

		//Seleccionar base de datos segun la empresa

		$this->session->set_userdata('d_chatbot',$data_empresa['database']);

		$this->load->library('applib',array('database' => $data_empresa['database']));

		//Validar seo

		$proyecto = applib::get_table_field(applib::$proyectos_table,array('seo' => $seo,'status' => 1),'*');

		if($proyecto == ""){
			redirect('https://www.google.com.pe');
		}

		//Si el cliente no ha ingresado al sitio

		/*if($this->session->userdata('cliente_id') == ""){

			//Registrar nuevo usuario para conversacion

			$save = applib::create(applib::$clientes_table,array('ip_address' => applib::get_ip(),'fecha_ingreso' => applib::fecha()));

			//iniciar session de usuario

			$this->session->set_userdata('cliente_id',$save);

			//Asignar el vendedor

			$vendedor = applib::get_vendedor($proyecto['id']);

			applib::update(array('id' => $save),applib::$clientes_table,array('vendedor_id' => $vendedor['vendedor_id']));

		}*/

		//Obtener prefijos
		$data['cliente_id'] = $cliente_id;
		$data['proyecto'] = applib::get_table_field(applib::$proyectos_table, array('seo' => $seo), 'id');
		$data['prefijos'] = applib::get_all('*',applib::$prefijos_table,array());

		$this->load->view('frontend/sender/llamada',$data);
	}




}