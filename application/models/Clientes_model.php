<?php

class Clientes_model extends CI_Model {

    function __construct(){
        parent::__construct();

        $this->db = $this->load->database($this->session->userdata('d_chatbot'), TRUE);
    }

    function get_by($condition)
    {
        $this->db->select('c.*,v.telefono');
        $this->db->from('clientes as c');
        $this->db->join('vendedores as v','c.vendedor_id = v.id','left');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->row_array();
    }
}
