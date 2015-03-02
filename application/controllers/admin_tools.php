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
}
