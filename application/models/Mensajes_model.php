<?php

class Mensajes_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->db = $this->load->database($this->session->userdata('d_chatbot'), TRUE);
    }

    function get_all($condition)
    {
        $this->db->select('m.*');
        $this->db->from('mensajes as m');
        $this->db->where($condition);
        $this->db->order_by('id ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}