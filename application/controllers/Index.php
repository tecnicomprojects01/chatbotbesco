<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->library('applib',array());
	}

	public function index(){
		
		//validar ingreso al chat
		if(!isset($_GET['key']) || $_GET['key'] == ""){
			exit;
		}

		$data_empresa = empresas::get_empresa($_GET['key']);

		//validar que la halla conseguido y esté habilitada

		if($data_empresa == false || $data_empresa['status'] == 0){
			exit;
		}
		
		if($this->session->userdata('d_chatbot') == ""){
			$this->session->set_userdata('d_chatbot',$data_empresa['database']);
		}

		//Obtener prefijos

		$data['prefijos'] = applib::get_all('*',applib::$prefijos_table,array());

		//Definir variable de inicio
		
		$data['start'] = $this->session->userdata('cliente_id') == ""?true:false;

		//Obtener datos del cliente

		$data['cliente'] = array();

		if($this->session->userdata('cliente_id') != ""){
			$data['cliente'] = applib::get_table_field(applib::$clientes_table,array('id' => $this->session->userdata('cliente_id')),'*');
		}

		$data['empresa'] = $data_empresa;
		
		$this->load->view('frontend/index/index',$data);
	}
}
