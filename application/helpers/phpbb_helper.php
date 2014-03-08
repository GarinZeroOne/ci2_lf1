<?php




// use this only for localhost!!
/*
        global $config;
        $config['cookie_domain'] = 'localhost';

        global $auth;
        global $user;
        */
/**
     * Registrar usuarios
     *
     * @return array User groups.
     */
  function reg_from_ci_to_phpbb($name='',$email='',$password='') 
  {
  
          $user_row = array(
         'username'              => strip_tags($name),
         'user_password'         => phpbb_hash($password),
         'user_email'            => $email,
         'group_id'              => 2, // by default, the REGISTERED user group is id 2
         'user_timezone'         => (float) date('T'),
         'user_lang'             => 'ar',
         'user_type'             => '0',
         'user_ip'               => $_SERVER['REMOTE_ADDR'],
         'user_regdate'          => time(),
        );

       //include(ROOT.'/comunidad/includes/functions_user.php');     
       $ci = & get_instance();
       $ci->load->helper('phpbb_funciones');
        
       return user_add($user_row, $cp_data);    
  }

    /*LOGIN & LOGOUT */
    function login_to_phpbb($username, $password, $autologin, $admin)
    {
        

        //include('../../../comunidad/includes/auth.php');
        //$auth = new auth();

        global $config;
        $config['cookie_domain'] = 'localhost';

        global $auth;
        global $user;

        // Attempt authorization.  result can be used to send messages or perform
        // loggin success / fail logic.
        $result = $auth->login($username, $password, $autologin, true, $admin);
    }  

    function logout_from_phpbb()
    {
        global $user;

        $user->session_kill();
        $user->session_begin();
    } 