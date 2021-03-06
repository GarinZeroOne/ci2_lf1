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
		                    <div class="alert alert-success clearfix">
		                        
		                        <div class="noti-info">
		                            '.$alerta->texto.'
		                        </div>
		                    </div>
	                	</li>';
			}

			
			
		}
		else
		{
			$html = '<li>
                    <p class="">No tienes alertas</p>
	                </li>';
		}

		return $html;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function notificaciones_activas()
	{
		$this->dbx = $this->load->database('local', TRUE);
		$noti = $this->dbx->select('id_notificacion')->from('usuarios_notificaciones')->where('leida',0)->where('id_usuario',$_SESSION['id_usuario'])->order_by('fecha','desc')->get();

		if($noti->num_rows())
		{


			$html = '<li>
                    <p class="">Tienes '.$noti->num_rows().' notificaciones</p>
	                </li>';

			foreach($noti->result() as $rownoti)
			{
				$notificacion = $this->db->select('*')->from('notificaciones')->where('id',$rownoti->id_notificacion)->get()->row();
				$html .= '
	                <li>
	                	<div style="position:relative">
	                		
	                	
	                	<span class="xLeida" onclick="marcarNotifiLeida(this)"  data-id="'.$rownoti->id_notificacion.'">x</span>
	                    <span class="cont-noti">
	                        <div class="task-info clearfix">
	                            <div class="desc pull-left">
	                                <h5>'.$notificacion->titulo.'</h5>
	                                '.$notificacion->texto.'

	                            </div>
	                                    
	                        </div>
	                    </span>

	                    </div>
	                </li>';
			}
		}
		else
		{
			$html = '<li>
                    <p class="">No hay ninguna notificación</p>
	                </li>';
		}

		return $html;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function notificaciones_contador()
	{
		$this->dbx = $this->load->database('local', TRUE);

		// Agregar notificaciones activas nuevas que el usuario no tenga
		$notificaciones_activas = $this->dbx->select('*')
											->from('notificaciones')
											->where('activa',1)
											->order_by('fecha_notificacion','desc')
											->get()->result();
		if(count($notificaciones_activas))
		{

			foreach($notificaciones_activas as $notificacion)
			{
				
				$registrada = $this->dbx->select('id')
							   ->from('usuarios_notificaciones')
							   ->where('id_notificacion',$notificacion->id)
							   ->where('id_usuario',$_SESSION['id_usuario'])
							   ->get()->num_rows();

				if(!$registrada)
				{

					// insert al usuario de la notificacion
					$data_insert = array('id'=>'','id_usuario'=>$_SESSION['id_usuario'],'id_notificacion'=>$notificacion->id,'leida'=>0,'fecha'=>date('Y-m-d H:i:s'));
					$this->db->insert('usuarios_notificaciones',$data_insert);
				}
				
			}
	
		}
		

		// Contar notificaciones sin leer del usuario
		$q = $this->dbx->select('id')->from('usuarios_notificaciones')->where('leida',0)->where('id_usuario',$_SESSION['id_usuario'])->order_by('fecha','desc')->get();
		

		return $q->num_rows();
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

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function set_notificacion_leida($id_notificacion)
	{
		if(!$_SESSION['id_usuario'])
			return 0;

		$data_update = array('leida'  => 1);

		$this->db->where('id_usuario',$_SESSION['id_usuario']);
		$this->db->where('id_notificacion',$id_notificacion);

		$this->db->update('usuarios_notificaciones',$data_update);
	}


}