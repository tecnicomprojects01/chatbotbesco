<?php

class Cualidades_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->db = $this->load->database($this->session->userdata('d_chatbot'), TRUE);
    }

    function get_by_proyecto($condition)
    {
        $this->db->select('rc.*,oc.cualidad');
        $this->db->from('respuestas_cualidades as rc');
        $this->db->join('opciones_cualidades as oc','rc.cualidad_id = oc.id','left');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    //metodo para validar si se han dado todas las respuestas posibles al usuario

    function todas_respuestas($proyecto_id,$cliente = null){

        $cliente = $cliente != null?$cliente:$this->session->userdata('cliente_id');

        $this->db->select('rc.cualidad_id');
        $this->db->from('respuestas_cualidades as rc');
        $this->db->where(array('proyecto_id' => $proyecto_id,'status' => 1));
        $query = $this->db->get();
        $cualidades = $query->result_array();
        
        $id_in = 'cliente_id = '.$cliente.'';

        if(count($cualidades) > 0){

            //Guardar ids en condicion

            $id_in .= ' AND cualidad_id IN(';

            foreach ($cualidades as $c) {
                $id_in .= $c['cualidad_id'].',';
            }

            $id_in = rtrim($id_in,',');
            $id_in .= ')';
        }

        //hacer busqueda

        $this->db->select('cr.cualidad_id');
        $this->db->from('cliente_respuesta as cr');
        $this->db->where($id_in);
        $query = $this->db->get();
        $total = $query->result_array();

        //Si las dos son iguales, significa que ya ha respondido todas
        
        return (count($total) == count($cualidades))?true:false;
    }

    //Funcion para obtener preguntas faltantes para el usuario

    function get_faltantas($proyecto_id,$cliente = null){

        //buscar las preguntas que ya estan respondidas

        $cliente = $cliente != null?$cliente:$this->session->userdata('cliente_id');

        $this->db->select('cr.cualidad_id');
        $this->db->from('cliente_respuesta as cr');
        $this->db->where(array('cr.cliente_id' => $cliente));
        $query = $this->db->get();
        $respondidas = $query->result_array();

        $condition = 'rc.proyecto_id = '.$proyecto_id.' AND oc.status = 1';

        if(count($respondidas) > 0){
            $condition .= ' AND rc.cualidad_id NOT IN(';
            foreach ($respondidas as $r) {
                $condition .= $r['cualidad_id'].',';
            }

            $condition = trim($condition,',');

            $condition .= ')';
        }

        $this->db->select('rc.*,oc.cualidad');
        $this->db->from('respuestas_cualidades as rc');
        $this->db->join('opciones_cualidades as oc','rc.cualidad_id = oc.id','left');
        $this->db->where($condition);
        $query = $this->db->get();
        $preguntas = $query->result_array();

        return $preguntas;
    }
}
