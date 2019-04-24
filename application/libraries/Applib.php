<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class AppLib {

	private static $db;

	private static $code;

    private static $datab;

	// Define system tables

    public static $clientes_table = 'clientes';

    public static $mensajes_table = 'mensajes';

    public static $proyectos_table = 'proyectos';

    public static $proyecto_vendedor_table = 'proyecto_vendedor';

    public static $orden_vendedor_table = 'orden_vendedor';

    public static $prefijos_table = 'prefijos';

    public static $datos_contacto_table = 'datos_contacto';

    public static $res_cualidades_table = 'respuestas_cualidades';

    public static $cliente_respuesta_table = 'cliente_respuesta';

    public static $llamado_vendedor_table = 'llamado_vendedor';

    public static $ubdepartamento_table = 'ubdepartamento';

    public static $vendedores_table = 'vendedores';

    public static $mensajebienvenida_table = 'mensaje_bienvenida';

    public static $llamadas_table = 'llamadas';

	function __construct($params = array())
	{
        
		self::$code =& get_instance();

        $data_b = self::$code->session->userdata('d_chatbot') == ""?'default':self::$code->session->userdata('d_chatbot');

        $data_b = (isset($params['database']))?$params['database']:$data_b;
        
		self::$db = self::$code->load->database($data_b, TRUE);

        self::$datab = $data_b;

        //self::$code->load->database();

	    //self::$db = &get_instance()->db;
	}

    //CONTAR REGISTROS

    public static function count_table_rows($table,$where)
    {
        $query = self::$db->where($where)->get($table);

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        }
    }

	//CREATE REGISTER

	static function create($table,$data = array()) {  

	 	self::$db->insert($table,$data);  

	 	return self::$db->insert_id();                          
	}

	//UPDATE REGISTER

    static function update($where = array(),$table,$data = array()) {  

        self::$db->where($where);

        self::$db->update($table,$data);  

        return true;                          

    }

    //DELETE REGISTER

    static function delete($table,$where = array()) 
    {  
        self::$db->delete($table, $where);  

        return true;                          

    }

	//GET ALL ROW

    static function get_all($select,$table,$where, $orderby = NULL,$limit = NULL)
    {

        self::$db->select($select);

       	self::$db->from($table);

        self::$db->where($where);

        if($orderby != NULL)
        {
            self::$db->order_by($orderby);
        }

        if($limit != NULL)
        {
            self::$db->limit($limit['porpagina'],$limit['pagina']);
        }

        $query = self::$db->get();
        
        return $query->result_array();
    }

	//GET ONE ROW

	static function get_table_field($table, $where_criteria, $table_field,$orderby = NULL) 
	{

        self::$db->select($table_field);

        self::$db->from($table);

        self::$db->where($where_criteria);

        if($orderby != NULL)
        {
            self::$db->order_by($orderby);
        }


        $query = self::$db->get();
        
        return $query->row_array();
	}

    //GET ONLY THE FIELD

    static function get_field($table, $where_criteria = array(), $table_field) 
    {

        self::$db->select($table_field);

        self::$db->from($table);

        self::$db->where($where_criteria);

        $query = self::$db->get();
        
        $valor = $query->row_array();

        if(isset($valor[$table_field]))
        {
            return $valor[$table_field];
        }
        else
        {
            return false;
        }
    }

    static function get_all_uni($table,$where,$id,$orderby = NULL,$limit = NULL,$group_by = null)
    {

        self::$db->select('*');

        self::$db->from($table);

        self::$db->where($where);

        if($group_by != NULL)
        {
            self::$db->group_by($group_by);
        }

        if($orderby != NULL)
        {
            self::$db->order_by($orderby);
        }

        if($limit != NULL)
        {
            self::$db->limit($limit['porpagina'],$limit['pagina']);
        }

        $query = self::$db->get();

        $result = $query->result_array();

        $datos = array();
        
        if(count($result) > 0)
        {
            foreach ($result as $r) {
                array_push($datos, $r[$id]);
            }
        }
        return $datos;
    }

    //Formatear fecha

    static function format_fecha($fecha,$formato)
    {
        $date = date_create($fecha);

        return date_format($date, $formato);
    }

	//FLASH DATA

	static function flash($type,$message,$url)
    {
        self::$code->session->set_flashdata('msg', '<div class="alert alert-'.$type.'" style="margin-bottom: 10px;">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        '.$message.'</div>');
        redirect(base_url() . $url, 301);
    }

    //SET ENCRIPTED PASSWROD

    static function set_password($pass)
    {
        self::$code->load->library('bcrypt');

        $password = self::$code->bcrypt->hash_password($pass);

        return $password;
    }

    //Mostrar costos

    static function format_costo($num)
    {
        $final = number_format($num, 0, '', '.');

        return $final;
    }

    //OBTENER FECHA ACTUAL

    static function fecha()
    {
        return date('Y-m-d H:i:s');
    }

    //TIME AGO

    static function time_ago($datetime, $full = false) 
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'Año',
            'm' => 'Mes',
            'w' => 'Semana',
            'd' => 'Dia',
            'h' => 'Hora',
            'i' => 'Minuto',
            's' => 'Segundo',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ?  'Hace '.implode(', ', $string) : 'Ahora';
    }

    static function dias_restantes($fecha_final) 
    {  
        $fecha_actual = date("Y-m-d H:i:s");  
        $s = strtotime($fecha_final)-strtotime($fecha_actual);  
        $d = intval($s/86400);  
        $diferencia = $d;  
        return $diferencia;  
    }

    static function meses_restantes($fecha_final) 
    {  
        $fechainicial = new DateTime(self::fecha());

        $fechafinal = new DateTime($fecha_final);

        $diferencia = $fechainicial->diff($fechafinal);

        $meses = ( $diferencia->y * 12 ) + $diferencia->m;

        return $meses;  
    }

    static function get_fecha_completa($fecha)
    {
        ///FECHA EN FORMATO yyyy-mm-dd

        $meses = array(
            '01'    => 'Enero',
            '02'    => 'Febrero',
            '03'    => 'Marzo',
            '04'    => 'Abril',
            '05'    => 'Mayo',
            '06'    => 'Junio',
            '07'    => 'Julio',
            '08'    => 'Agosto',
            '09'    => 'Septiembre',
            '10'    => 'Octubre',
            '11'    => 'Noviembre',
            '12'    => 'Diciembre'
        );

        $tiempo = explode('-', $fecha);

        return $tiempo[2].' de '.$meses[$tiempo[1]].' del '.$tiempo[0];

    }

    //DEVUELVE FECHA DE INCIO Y FIN DE LA SEMANA

    static function semana()
    {
        $diaInicio="Monday";
        $diaFin="Sunday";

        $strFecha = strtotime(date('Y-m-d'));

        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        $fechaFin = date('Y-m-d',strtotime('next '.$diaFin,$strFecha));

        if(date("l",$strFecha)==$diaInicio){
            $fechaInicio= date("Y-m-d",$strFecha);
        }
        if(date("l",$strFecha)==$diaFin){
            $fechaFin= date("Y-m-d",$strFecha);
        }
        return array("inicio"=>$fechaInicio,"fin"=>$fechaFin);
    }

    static function titulo($var)
    {
        return ucfirst(strtolower($var));
    }

    static function fecha_mas($fecha,$tiempo)
    {
        //Obtener fecha mas o menos dias u horas o segundos

        $nuevafecha = strtotime ($tiempo , strtotime ( $fecha ) ) ;

        return date ( 'Y-m-d H:i:s' , $nuevafecha );
    }

    static function get_token()
    {
        return md5(sha1(time())).rand(100,10000);
    }

    //Validar q una url sea correcta

    static function validar_url($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) 
        {
            return false;
        }
        else 
        {
           return true;
        }
    }

    static function set_seo($var)
    {
        self::$code->load->helper('text');

        return url_title(convert_accented_characters($var),'-',TRUE);
    }

    static function get_ip()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        $ip  = null;

        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }

        return $ip;
    }

    //funcion para obtener el vendedor segun el random

    static function get_vendedor($proyecto_id){

        self::$code->load->model('vendedores_model');

        //Revisar si está hecha la lista del orden de vendedores

        $orden = self::$code->vendedores_model->get_by_orden(array('op.proyecto_id' => $proyecto_id,'op.status' => 0,'v.status' => 1),self::$datab);

        if(count($orden) == 0){

            //Eliminar orden existente

            self::delete(self::$orden_vendedor_table,array('proyecto_id' => $proyecto_id));

            //Crear orden de vendedores

            $vendedores = self::$code->vendedores_model->get_by_proyecto(array('pv.proyecto_id' => $proyecto_id,'v.status' => 1),self::$datab);

            shuffle($vendedores);

            $orden  = array();

            //Guardar en tabla de orden

            foreach ($vendedores as $v) {
                
                $data_in = array('proyecto_id' => $proyecto_id,'vendedor_id' => $v['vendedor'],'date' => self::fecha());

                self::create(self::$orden_vendedor_table,$data_in);

                $data_in['telefono'] = $v['telefono'];

                $orden[] = $data_in;
            }
        }

        $vendedor_turno = $orden[0];

        return $vendedor_turno;
    }

    //Dar formato al telefono

    static function format_telefono($codigo,$numero){

        //Si es un código de Perú

        if($codigo == '+51'){

            if(strlen($numero) == 7){
                $numero = '1'.$numero;
            }
        }

        //Quiitar + del codigo

        $codigo = str_replace("+","",$codigo);

        $telefono = $codigo.trim($numero);

        return $telefono;
    }

    //Obtener whatsappme

    static function get_whatsapp($telefono){

        return 'https://wa.me/51'.$telefono;
    }

    //Saber si hora esta en el rango

    static function horaEntre($from, $to, $input) {
        $dateFrom = DateTime::createFromFormat('!H:i', $from);
        $dateTo = DateTime::createFromFormat('!H:i', $to);
        $dateInput = DateTime::createFromFormat('!H:i', $input);
        if ($dateFrom > $dateTo) $dateTo->modify('+1 day');
        return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
    }

    //Saber si se puede llamar según el proyecto

    static function poder_llamar($proyecto_id){

        //verifica si el proyecto permite llamadas

        $proyecto = self::get_table_field(self::$proyectos_table,array('id' => $proyecto_id),'*');

        if($proyecto == "" || $proyecto['aceptar_llamadas'] == 0){
            return false;
        }

        //Verificar si está dentro del horario de atención

        return self::horaEntre($proyecto['horario_atencion_inicio'],$proyecto['horario_atencion_fin'],date('H:i'));
    }

    static function es_par($numero){
        
        return ($numero%2==0)?true:false;
        
    }

    //Funcion de datos de empresa

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