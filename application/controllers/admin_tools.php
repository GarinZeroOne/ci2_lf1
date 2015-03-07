<?php 
class Admin_tools extends CI_Controller {

	function Admin_tools(){

		parent::__construct();

		$this->load->database();
		$this->load->model('sesiones/control_session');
		$this->load->model('calendario/calendario_model');
		$this->load->model('usuarios/usuarios_model');
		$this->load->model('admin/admin_model');

		if($_SESSION['id_usuario']!= '177')
			die("#dafuk");
	}

	function index()
	{
		$this->load->view('admin_tools/vista_admin');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function nueva_notificacion()
	{
		if(!$_POST) die('oO');

		dump($_POST);

		$data_insert = array(
								'id'		=>			'',
								'tipo'		=>			$_POST['tipo'],
								'titulo'	=>			$_POST['titulo'],
								'texto'		=>			$_POST['texto'],
								'fecha_notificacion'	=>	date('Y-m-d H:i:s'),
								'activa' => 1
								);
		$this->db->insert('notificaciones',$data_insert);

		$this->session->set_flashdata('ok_msg','Notificacion creada');

		redirect_lf1('admin_tools');
	}
}
