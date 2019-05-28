<?php

class Vendedores_model extends CI_Model {

    function __construct(){
        parent::__construct();

        if($this->session->userdata('d_chatbot') != ""){
            $this->db = $this->load->database($this->session->userdata('d_chatbot'), TRUE);
        }
        
    }

    function get_by_proyecto($condition,$database = null)
    {
        if($database != null){
            $this->db = $this->load->database($database, TRUE);
        }

        $this->db->select('pv.*,v.id as vendedor,v.telefono');
        $this->db->from('proyecto_vendedor as pv');
        $this->db->join('vendedores as v','pv.vendedor_id = v.id','left');
        $this->db->where('v.habilitado',1);
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_by_orden($condition,$database = null)
    {
        if($database != null){
            $this->db = $this->load->database($database, TRUE);
        }

        $this->db->select('op.*,v.id as vendedor,v.telefono');
        $this->db->from('orden_vendedor as op');
        $this->db->join('vendedores as v','op.vendedor_id = v.id','left');
        $this->db->where('v.habilitado',1);
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }
}