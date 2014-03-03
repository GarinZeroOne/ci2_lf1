<?
class Control_session extends CI_Model {
		
	
	
    function Control_session()
    {
        parent::__construct();
		session_start();
		// 2013 - Logear usuario en foro para PHPBB
        // Cargar funciones phpbb para CI
    	$this->load->helper('phpbb_helper');
    	$this->load->model('usuarios/usuarios_model');
    }
	
	function iniciar($user,$user_id){

		session_unset();
		session_destroy();
		session_start();
		$_SESSION['id_usuario'  ] = $user_id;
		$_SESSION['usuario'	    ] = $user;
		$_SESSION["ultimoAcceso"] =	date("Y-n-j H:i:s");
		$_SESSION['direccion_ip'] = $_SERVER['REMOTE_ADDR'];

		 

    	login_to_phpbb($user, 'l1g4formul41r4nd0mp455');

		
	}
	
	function destruir_sesion(){

		

    	logout_from_phpbb();

		session_destroy();
		redirect_lf1('inicio/acceso','location');
	}
	
	function comprobar_sesion(){
		

		if( isset($_SESSION['id_usuario']) ){

			// Comprobar que  tenga la comunidad introducida
			// Evitar que viejos usuarios puedan navegar sin estar
			// dentro del grupo de su comunidad - 2014

			$comunidad = $this->usuarios_model->check_comunidad_autonoma($_SESSION['id_usuario']);

			if($comunidad == 0)
			{
				redirect_lf1('inicio/sel_comunidad');
			}
			// Si intenta entrar a la pagina de login cuando ya esta logeado le mandamos
			// al dashboard
			if($this->uri->uri_string() == 'inicio/acceso')
			{
				redirect_lf1('dashboard');
			}
			
			// Compruebo tiempo desde ultima actividad
			// si supera el tiempo maximo establecido (7200s)
			// se elimina la sesion, si no se actualiza
			$fechaGuardada 		 = $_SESSION["ultimoAcceso"];
    		$ahora 		         = date("Y-n-j H:i:s");
   			$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
			
    		if($tiempo_transcurrido >= $this->config->item('sess_expiration')) {
    			
	    	 	logout_from_phpbb();
	    	 	session_destroy();

	    		redirect_lf1('inicio/acceso','location');
				return;

			} else {
		   		 
				 //actualizo la fecha de la sesión
				 $_SESSION["ultimoAcceso"] = $ahora;
			}
			
		}
		else{

			// Si no tiene session y esta en la pagina de login|alta, no redireccionamos, para no generar  bucle.Pero si no
			// esta en la pagina de acceso, le redireccionamos
			if($this->uri->uri_string() != 'inicio/acceso' && $this->uri->uri_string() != 'inicio/alta')
			{
				
				redirect_lf1('inicio/acceso','location');
			}
			
		}
		
	}
}
?>