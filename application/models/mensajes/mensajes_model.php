<?php

class Mensajes_model extends CI_Model {

	public $dbx;

	function __construct()
	{
		parent::__construct();

	}

	/**
	 * Devuelve numero de alertas no leidas
	 *
	 * @return void
	 * @author 
	 **/
	function contador_alertas_no_leidas($id_usuario)
	{
		
		$this->dbx = $this->load->database('local', TRUE);
		$q = $this->dbx->select('id')
					  ->from('usuarios_alertas')
					  ->where('id_usuario',$id_usuario)
					  ->where('leida',0)
					  ->get();


		$num_alertas = $q->num_rows();

		return $num_alertas;
	}

	/**
	 * Devuelve HTML con las alertas no leidas
	 *
	 * @return void
	 * @author 
	 **/
	function mostrar_mis_alertas($id_usuario)
	{

		$this->dbx = $this->load->database('local', TRUE);

		$q = $this->dbx->select('*')->from('usuarios_alertas')->where('id_usuario',$id_usuario)->where('leida',0)->order_by('fecha_modificada','DESC')->get();

		if($q->num_rows())
		{

			foreach($q->result()  as  $alerta)
			{
				$html .= '<li>
		                    <div class="alert alert-warning clearfix">
		                        
		                        <div class="noti-info">
		                            '.$alerta->texto.'
		                        </div>
		                    </div>
	                	</li>';
			}

			return $html;
			
		}

	}

	/**
	 * Devuelve todas las alertas de un usuario
	 *
	 * @return void
	 * @author 
	 **/
	function get_alertas_usuario($id_usuario)
	{
		//Poner todas como leidas
		$this->db->where('id_usuario',$id_usuario);
		$this->db->update('usuarios_alertas',array('leida'=>1));
		
		$q = $this->db->select('*')->from('usuarios_alertas')->where('id_usuario',$id_usuario)->order_by('fecha_modificada','desc')->get();

		return $q->result();
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function get_notificaciones_usuario($id_usuario)
	{
		$q = $this->db->select('*')->from('notificaciones')->order_by('fecha_notificacion','desc')->get();

		return $q->result();
	}

	function generar_html_alertas($datos)
	{

		$html = '';

		foreach($datos  as  $alerta)
		{
			$html .= '<li>
	                    <div class="alert alert-info clearfix">
	                        
	                        <div class="noti-info">
	                            '.$alerta->texto.'
	                        </div>
	                    </div>
                	</li>';
		}

		return $html;
	}
}