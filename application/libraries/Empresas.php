<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class Empresas {
	function __construct(){

	}

	static function get_empresa($key){

        $empresas = array(
            'L5437788'  => array('name' => 'besco','database' => 'chatbot_besco','status' => 1)
        );

        if(!isset($empresas[$key])){
            return false;
        }

        return $empresas[$key];
    }
}