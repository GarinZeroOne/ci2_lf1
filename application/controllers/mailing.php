<?php

class Mailing extends CI_Controller {

    function Mailing() {

        parent::__construct();
        session_start();
        $this->load->helper('url');
        $this->load->database();
        //$this->load->model('sesiones/control_session');
        //$this->load->model('calendario/calendario_model');
        //$this->load->model('usuarios/usuarios_model');
        //$this->load->model('admin/admin_model');
       

    }

    function index()
    {
        
        if($_SESSION['id_usuario'] != '177')
        {
            redirect_lf1('dashboard');
        }   
        else
        {
            $this->load->view('mailing/mails');   
        }
    	
    }

    function enviar()
    {
        if($_SESSION['id_usuario'] != '177')
        {
            redirect_lf1('dashboard');
        }   

        if($_POST)
        {
            $mail_desde = $_POST['udesde'];

            $datos['mail_titulo'] = $_POST['mtitulo'];
            $datos['texto'] = $_POST['mtexto'];

            $contenido_mail = $this->load->view('mailing/mail_template',$datos,TRUE);

            $this->load->library('email');

            $usuarios = $this->db->query("SELECT * FROM usuarios order by id asc limit {$mail_desde},300")->result();

            $i = 0;

            foreach($usuarios as $usuario)
            {
                $this->email->from('ligaformula1@ligaformula1.com', 'Ligaformula1.com');
                $this->email->to($usuario->email);
                $this->email->subject('Liga formula 1 - '.$datos['mail_titulo']);
                $this->email->message($contenido_mail);

                $this->email->send();

                ++$i;
            }
            //dump($usuarios);

            echo 'Se han enviado '.$i.' emails.';
            
        }

    }
}