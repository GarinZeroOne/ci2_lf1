<?php

class Noticias_model extends CI_Model {

    function Noticias_model() {
        parent::__construct();
    }

    function getNews() {

        // recoger las ultimas 10 noticias
        $sql = "SELECT * FROM noticias ORDER BY id DESC LIMIT 0,15";
        return $this->db->query($sql)->result();
    }

    function get_feed_news() {

        // Mostraremos un feed o otro dependiendo del idioma
        if ($this->config->item('language') == 'spanish') {
            // URL location of your feed
            $feedUrl = "http://feeds.noxvo.com/f1aldia?format=xml";
        } else {
            $feedUrl = "http://www.planetf1.com/rss/3213";
        }

        // ingles
        //$feedUrl = "http://www.formula1.com/rss/news/latest.rss";

        $feedContent = "";

        // Fetch feed from URL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $feedUrl);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        // FeedBurner requires a proper USER-AGENT...
        curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
        curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");

        $feedContent = curl_exec($curl);
        curl_close($curl);

        // Did we get feed content?
        if ($feedContent && !empty($feedContent))
            $feedXml = @simplexml_load_string($feedContent);

        if ($feedXml)
            return $feedXml;
    }

    function getFeedNews() {

        // URL location of your feed
        $feedUrl = "http://feeds.noxvo.com/f1aldia?format=xml";

        $feedContent = "";        
        
        // Fetch feed from URL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $feedUrl);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        
        // FeedBurner requires a proper USER-AGENT...
        curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
        curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");

        
        
        $feedContent = curl_exec($curl);
        curl_close($curl);

        // Did we get feed content?
        if ($feedContent && !empty($feedContent)){
            $feedXml = @simplexml_load_string($feedContent);
        }                                

        if ($feedXml)
            return $feedXml;
    }

    /**
     * Obtiene las noticicaciones de la home 2013
     *
     * @return void
     * @author
     * */
    function get_lf1news() {

        $q = $this->db->select('titulo,texto')->from('lf1news')->where('activo', 1)->order_by('id', 'desc')->get();

        if ($q->num_rows()) {
            return $q->result();
        }
    }

}
