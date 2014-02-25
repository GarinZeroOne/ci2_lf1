<?php

class Usuarios extends Controller {

    /**
    * Idiomas soportados
    */
    private $languages      = array ('spanish','english');

    function Usuarios() {
        parent::Controller();

        // Configurar idioma
        $this->_set_language();

        $this->load->helper(array('form', 'url'));
        $this->load->library('validation');
        $this->load->database();
        $this->load->model(array('sesiones/control_session', 'estadisticas/estadisticas_model'));
        $this->load->model('calendario/calendario_model');
        $this->load->model('menudata/menudata_model');
    }

    function perfil() {
        //se recoge el nick del usuario
        $nick = $this->uri->segment(3);

        // No hay nick?? GTFO
        if(!$nick)
        {
            redirect_lf1('inicio');
        }

        $this->load->library('session');

        //se obtiene el id del usuario

        // Cargar helper timeago
        $this->load->helper('timeago');

        //Cargamos el modelo de usuarios
        $this->load->model('usuarios/usuarios_model');

        //Obtener los datos del usuario y  sumar la visita
        $datosUser = $this->usuarios_model->userDataNick($nick);

        // Si el user no existe, lo mandamos a la home
        if(!$datosUser)
            redirect_lf1('inicio');


        $userData['usuario'] = $datosUser;

        $userData['ultimas_visitas'] = $this->usuarios_model->get_ultimas_visitas_perfil($datosUser->id);
        $userData['muro'   ] = $this->usuarios_model->get_mensajes_muro($datosUser->id);


        // Posicion r anking general del usuario
        $userData['posicionRanking'] = $this->usuarios_model->get_posicion_ranking($datosUser->id);
        // Estadisticas del usuario y el visitante del perfil (si logeado)
        $this->load->model('estadisticas/estadisticas_model');
        $userData['full_stats'] = $this->estadisticas_model->get_full_stats($datosUser->id);

        if($_SESSION['id_usuario'])
            $userData['full_stats_usuario'] = $this->estadisticas_model->get_full_stats($_SESSION['id_usuario']);


        // Obtener avatar usuario
        $userData['avatar'] = $this->usuarios_model->userAvatar($datosUser->id);

        // Datos del menu estadisticas,posts y countdown
        $datos = $this->menudata_model->get_menu_data();

        // Cargar libreria de graficas
        $this->load->helper('charts');






        // Preparar la vista
        $header['estilos'] = array('usuarios.css','jquery-te-1.3.2.2.css');

        // Menu activo
        $menu['m_act'] = 2;

        $header['javascript'] = array('perfil');

        $this->load->view('base/cabecera', $header);
        $this->load->view('base/page_top', $menu);
        //$this->load->view('base/menu_vertical_inicio', $datos);
        $this->load->view('usuarios/perfil',$userData);
        $this->load->view('base/page_bottom');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    function nueva_firma()
    {

        if($_POST['mensaje']){

            //Cargamos el modelo de usuarios
            $this->load->model('usuarios/usuarios_model');

            $this->usuarios_model->guardar_firma($_POST);

        }
    }


/*Dibujar graficas

  API info : http://www.maani.us/charts4/index.php?menu=Reference
*/
public function rendimiento_pm($usuario){

    // Cargar libreria de graficas
    $this->load->helper('charts');



    $id_usuario = $this->db->select('id')->from('usuarios')->where('nick',$usuario)->get()->row()->id;



    $paises = $this->db->select('id,pais')->from('circuitos')->order_by('id','asc')->get()->result();



    $array_paises[] = " ";
    $array_puntos_usuario_gp[] = "Puntos Manager ".$usuario;
    $array_max_puntos_gp[] = "Puntos TOP 1";

    foreach($paises as $pais){

        // Circuitos
        $array_paises[] = $pais->pais;

        // Puntos usuarios
        $puntos = $this->db->select('puntos_manager_gp')
                            ->from('resultados_usuarios_2011')
                            ->where('id_usuario',$id_usuario)
                            ->where('id_gp',$pais->id)
                            ->get();

        if($puntos->num_rows())
        {
            $array_puntos_usuario_gp[] = $puntos->row()->puntos_manager_gp;
        }
        else
        {
            $array_puntos_usuario_gp[] = 0;
        }

        // Puntos TOP1

        $max_puntos = $this->db->select_max('puntos_manager_gp')
                               ->from('resultados_usuarios_2011')
                               ->where('id_gp',$pais->id)
                               ->get();

        if($max_puntos->row()->puntos_manager_gp)
        {
            $array_max_puntos_gp[] = $max_puntos->row()->puntos_manager_gp;
        }
        else
        {
            $array_max_puntos_gp[] = 0;
        }



    }






    //$rendimiento = $this->usuarios_model->datos_rendimiento( $usuario);


    /*
    $chart[ 'axis_category' ] = array ( 'size'=>8, 'color'=>"000000", 'alpha'=>75, 'font'=>"arial", 'bold'=>true, 'skip'=>0 ,'orientation'=>"horizontal" );
    $chart[ 'axis_value' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ffffff", 'alpha'=>60, 'steps'=>6, 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'show_min'=>false );

    $chart[ 'chart_border' ] = array ( 'color'=>"000000", 'top_thickness'=>1, 'bottom_thickness'=>2, 'left_thickness'=>1, 'right_thickness'=>1 );

    $chart[ 'chart_data' ] = array ( $array_paises,
                                     $array_puntos_usuario_gp,
                                     $array_max_puntos_gp
                                   );

    $chart[ 'chart_grid_h' ] = array ( 'alpha'=>10, 'color'=>"000000", 'thickness'=>1 );
    $chart[ 'chart_rect' ] = array ( 'x'=>50, 'y'=>75, 'width'=>1000, 'height'=>175, 'positive_color'=>"88ff88", 'positive_alpha'=>30, 'negative_color'=>"ff0000",  'negative_alpha'=>10 );
    $chart[ 'chart_transition' ] = array ( 'type'=>"slide_down", 'delay'=>0, 'duration'=>.75, 'order'=>"series" );
    $chart[ 'chart_type' ] = "stacked area";
    $chart[ 'chart_value' ] = array ( 'color'=>"ff8800", 'alpha'=>90, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'position'=>"center", 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>false );

    $chart[ 'draw' ] = array ( array ( 'transition'=>"dissolve", 'delay'=>0, 'duration'=>1, 'type'=>"text", 'color'=>"ffffff", 'alpha'=>15, 'font'=>"arial", 'rotation'=>-5, 'bold'=>true, 'size'=>60, 'x'=>10, 'y'=>-10, 'width'=>500, 'height'=>150, 'text'=>"Puntos Manager", 'h_align'=>"center", 'v_align'=>"middle" ),
                               array ( 'transition'=>"dissolve", 'delay'=>0, 'duration'=>1, 'type'=>"text", 'color'=>"000066", 'alpha'=>5, 'font'=>"arial", 'rotation'=>0, 'bold'=>true, 'size'=>45, 'x'=>0, 'y'=>-15, 'width'=>400, 'height'=>50, 'text'=>"Rendimiento", 'h_align'=>"left", 'v_align'=>"top" ));

    $chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'bullet'=>"circle", 'font'=>"arial", 'bold'=>true, 'size'=>13, 'color'=>"ffffff", 'alpha'=>50 );
    $chart[ 'legend_rect' ] = array ( 'x'=>60, 'y'=>85, 'width'=>10, 'height'=>40, 'margin'=>3, 'line_color'=>"000000", 'fill_alpha'=>10, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );
    $chart[ 'legend_transition' ] = array ( 'type'=>"dissolve", 'delay'=>0, 'duration'=>1 );

    $chart[ 'series_color' ] = array ( "844648", "4d4d4d", "5a4b6e" );

    SendChartData ( $chart );

    */

    /*3D*/
    /*
    $chart[ 'axis_category' ] = array ( 'size'=>10, 'color'=>"000000", 'alpha'=>50, 'font'=>"arial", 'bold'=>true, 'skip'=>0 ,'orientation'=>"horizontal" );
    $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>false, 'category_ticks'=>false );
    $chart[ 'axis_value' ] = array ( 'alpha'=>0 );

    $chart[ 'chart_border' ] = array ( 'top_thickness'=>0, 'bottom_thickness'=>0, 'left_thickness'=>0, 'right_thickness'=>0 );
    $chart[ 'chart_data' ] = array ( $array_paises,
                                         $array_puntos_usuario_gp,
                                         $array_max_puntos_gp
                                    );
    $chart[ 'chart_grid_h' ] = array ( 'thickness'=>0 );
    $chart[ 'chart_pref' ] = array ( 'rotation_x'=>rand(0,0), 'rotation_y'=>rand(0,10) );
    $chart[ 'chart_rect' ] = array ( 'x'=>-5, 'y'=>20, 'width'=>1100, 'height'=>240, 'positive_alpha'=>0, 'negative_alpha'=>25 );
    $chart[ 'chart_type' ] = "3d column" ;
    $chart[ 'chart_value' ] = array ( 'hide_zero'=>true, 'color'=>"000000", 'alpha'=>80, 'size'=>10, 'position'=>"over", 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>true );

    $chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ffffff", 'alpha'=>100 );
    $chart[ 'legend_rect' ] = array ( 'x'=>170, 'y'=>5, 'width'=>400, 'height'=>5, 'margin'=>5, 'fill_color'=>"000066", 'fill_alpha'=>0, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );

    $chart[ 'live_update' ] = array ( 'url'=>"php/Gallery_3D_Column_1.php?time=".time(), 'delay'=>5 );

    $chart[ 'series_color' ] = array ("0580E4","FFA306" );
    $chart[ 'series_gap' ] = array ( 'bar_gap'=>10, 'set_gap'=>20) ;

    SendChartData ( $chart );
    */

     $chart[ 'axis_category' ] = array (  'size'=>10, 'color'=>"000000", 'alpha'=>75, 'skip'=>0 ,'orientation'=>"horizontal" );
        $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>false, 'category_ticks'=>true, 'major_thickness'=>2, 'minor_thickness'=>1, 'minor_count'=>1, 'major_color'=>"000000", 'minor_color'=>"222222" ,'position'=>"inside" );
        $chart[ 'axis_value' ] = array ( 'min'=>-8, 'size'=>10, 'color'=>"ffffff", 'alpha'=>50, 'steps'=>6, 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'show_min'=>false );

        $chart[ 'chart_data' ] = array ( $array_paises,
                                         $array_max_puntos_gp,
                                         $array_puntos_usuario_gp

                                    );
        $chart[ 'chart_grid_h' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1 );
        $chart[ 'chart_grid_v' ] = array ( 'alpha'=>10, 'color'=>"000000", 'thickness'=>1, 'type'=>"solid" );
        $chart[ 'chart_pref' ] = array ( 'line_thickness'=>2, 'point_shape'=>"shape", 'fill_shape'=>true );
        $chart[ 'chart_rect' ] = array ( 'x'=>50, 'y'=>100, 'width'=>1000, 'height'=>150, 'positive_color'=>"ffffff", 'positive_alpha'=>50, 'negative_color'=>"000000", 'negative_alpha'=>10 );
        $chart[ 'chart_transition' ] = array ( 'type'=>"slide_left", 'delay'=>.5, 'duration'=>.5, 'order'=>"series" );
        $chart[ 'chart_type' ] = "Line";
        $chart[ 'chart_value' ] = array ( 'position'=>"cursor", 'size'=>10, 'color'=>"000000", 'background_color'=>"aaff00", 'alpha'=>80 );

        $chart[ 'draw' ] = array ( array ( 'transition'=>"dissolve", 'delay'=>0, 'duration'=>.5, 'type'=>"text", 'color'=>"000000", 'alpha'=>8, 'font'=>"Arial", 'rotation'=>0, 'bold'=>true, 'size'=>48, 'x'=>8, 'y'=>7, 'width'=>600, 'height'=>75, 'text'=>"Historial puntos manager", 'h_align'=>"center", 'v_align'=>"bottom" ) );

        $chart[ 'legend_label' ] = array ( 'layout'=>"horizontal", 'bullet'=>"line", 'font'=>"arial", 'bold'=>true, 'size'=>13, 'color'=>"ffffff", 'alpha'=>100 );
        $chart[ 'legend_rect' ] = array ( 'x'=>50, 'y'=>15, 'width'=>320, 'height'=>25, 'margin'=>5, 'fill_color'=>"000000", 'fill_alpha'=>7, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>1 );
        $chart[ 'legend_transition' ] = array ( 'type'=>"dissolve", 'delay'=>0, 'duration'=>.5 );

        $chart[ 'series_color' ] = array ( "ACFF00", "E32891", "0046A7" );

        $chart [ 'series_explode' ] = array ( 400 );

        SendChartData ( $chart );

}

function ingresos_chart($usuario)
    {

         // Cargar libreria de graficas
        $this->load->helper('charts');


        $id_usuario = $this->db->select('id')->from('usuarios')->where('nick',$usuario)->get()->row()->id;



        $paises = $this->db->select('id,pais')->from('circuitos')->order_by('id','asc')->get()->result();



        $array_paises[] = " ";
        $array_tus_ingresos_gp[] = "Ingresos de ".$usuario;
        $array_max_ingresos_gp[] = "Usuario con mas ingresos";

        foreach($paises as $pais){

            // Circuitos
            $array_paises[] = $pais->pais;

            // Ingresos usuarios
            $sql_tus_ingresos = "select sum(dinero) as dinero from resultados_usuarios_desglose where id_usuario = ? and id_gp= ?";
            $ingresos = $this->db->query($sql_tus_ingresos,array($id_usuario, $pais->id));

            if($ingresos->row()->dinero)
            {
                $array_tus_ingresos_gp[] = $ingresos->row()->dinero;
            }
            else
            {
                $array_tus_ingresos_gp[] = 0;
            }

            // Ingresos MAX

            $sql_max = "select max(dinero) as dinero from
                        (select sum(dinero) dinero from resultados_usuarios_desglose group by id_usuario,id_gp having id_gp = ? )
                        datos;";
            $max_ingresos = $this->db->query($sql_max,array($pais->id));

            if($max_ingresos->row()->dinero)
            {
                $array_max_ingresos_gp[] = $max_ingresos->row()->dinero;
            }
            else
            {
                $array_max_ingresos_gp[] = 0;
            }



        }


        $chart[ 'axis_category' ] = array (  'size'=>10, 'color'=>"000000", 'alpha'=>75, 'skip'=>0 ,'orientation'=>"horizontal" );
        $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>false, 'category_ticks'=>true, 'major_thickness'=>2, 'minor_thickness'=>1, 'minor_count'=>1, 'major_color'=>"000000", 'minor_color'=>"222222" ,'position'=>"inside" );
        $chart[ 'axis_value' ] = array ( 'min'=>-40, 'size'=>10, 'color'=>"ffffff", 'alpha'=>50, 'steps'=>6, 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'show_min'=>false );

        $chart[ 'chart_data' ] = array ( $array_paises,
                                         $array_max_ingresos_gp,
                                         $array_tus_ingresos_gp

                                    );
        $chart[ 'chart_grid_h' ] = array ( 'alpha'=>10, 'color'=>"000000", 'thickness'=>1 );
        $chart[ 'chart_pref' ] = array ( 'line_thickness'=>2, 'point_shape'=>"circle", 'fill_shape'=>false );
        $chart[ 'chart_rect' ] = array ( 'x'=>50, 'y'=>100, 'width'=>1000, 'height'=>150, 'positive_color'=>"ffffff", 'positive_alpha'=>50, 'negative_color'=>"000000", 'negative_alpha'=>10 );
        $chart[ 'chart_transition' ] = array ( 'type'=>"slide_left", 'delay'=>.5, 'duration'=>.5, 'order'=>"series" );
        $chart[ 'chart_type' ] = "Line";
        $chart[ 'chart_value' ] = array ( 'position'=>"cursor", 'size'=>12, 'color'=>"000000", 'background_color'=>"aaff00", 'alpha'=>80 );

        $chart[ 'draw' ] = array ( array ( 'transition'=>"dissolve", 'delay'=>0, 'duration'=>.5, 'type'=>"text", 'color'=>"000000", 'alpha'=>8, 'font'=>"Arial", 'rotation'=>0, 'bold'=>true, 'size'=>48, 'x'=>8, 'y'=>7, 'width'=>500, 'height'=>75, 'text'=>"Reporte de ganancias", 'h_align'=>"center", 'v_align'=>"bottom" ) );

        $chart[ 'legend_label' ] = array ( 'layout'=>"horizontal", 'bullet'=>"line", 'font'=>"arial", 'bold'=>true, 'size'=>13, 'color'=>"ffffff", 'alpha'=>100 );
        $chart[ 'legend_rect' ] = array ( 'x'=>50, 'y'=>15, 'width'=>320, 'height'=>25, 'margin'=>5, 'fill_color'=>"000000", 'fill_alpha'=>7, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );
        $chart[ 'legend_transition' ] = array ( 'type'=>"dissolve", 'delay'=>0, 'duration'=>.5 );

        $chart[ 'series_color' ] = array ( "FFA306", "0580E4", "0046A7" );

        $chart [ 'series_explode' ] = array ( 400 );

        SendChartData ( $chart );
    }

        /**
         * Configurar el idioma que debe cargar
         *
         * @access      private
         * @author      Gorka Garin
         * @return      void
         */
        private function _set_language()
        {



                // Mirar si el idioma esta soportado
                if (in_array($this->session->userdata('language'), $this->languages))
                {

                        // Si esta soportado, lo seteamos
                        $this->config->set_item('language', $this->session->userdata('language'));
                }

                // Cargar el archivo de idioma de la pagina que se ha solicitado
                $lang_file = $this->config->item('language') . '/' . $this->router->class . '_lang';


                // si el archivo fisico existe, cargamos su  contenido
                if (is_file(realpath(dirname(__FILE__) . '/../language/' . $lang_file . EXT)))
                {
                        $this->lang->load($this->router->class);
                }

                // Cargar variables genericas de idioma
                $this->lang->load('global');

        }

}