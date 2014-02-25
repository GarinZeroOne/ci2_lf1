<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class Noticias extends REST_Controller {

    const ID_MEJORA_OJEADORES = 1;

    function Noticias() {
        parent::REST_Controller();
        $this->load->helper('url');
        $this->load->database();
    }

    function data_get() {
        $this->load->model('noticias/noticias_model');

        // noticias de feed rss
        $noticiasFeed = $this->noticias_model->getFeedNews()->channel;

        $noticias = array();
        $i = 0;
        foreach ($noticiasFeed->item as $new) {

            $descripcion = preg_replace("/<img[^>]+\>/i", "", $new->description);
            $descripcion = preg_replace ("/<a[^>]+\>(.*?)<\/a>/i", "", $descripcion);
            $descripcion = preg_replace ("/<br[^>]+\>/i", "", $descripcion);
            
            $link = $new->link;
            $title = $new->title;
            
            $datosNoticia = array(
                'link' => strip_tags($link),
                'subtitle' => strip_tags($title),
                //'description' => strip_tags($new->description));
                'description' => strip_tags($descripcion,'<br>'));
            $noticias[$i] = $datosNoticia;
            $i++;
        }

        $this->response($noticias);
    }

}
