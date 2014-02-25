<?php
class Forophpbb_model extends CI_model{


	function __construct(){

	}

	function get_last_topics()
	{
		
		$this->load->helper('timeago');
		$dbforo = $this->load->database('foro',TRUE);

		$res = $dbforo->select('*')->from('phpbb_topics')->order_by('topic_id','desc')->limit('6')->get()->result();


		foreach( $res as $topic )
		{
			
			$t = $topic->topic_id;
			$forum_id = $topic->forum_id;
			$usuario = $topic->topic_last_poster_name;
			$fecha = $topic->topic_last_post_time;

			$res_foro = $dbforo->select('*')->from('phpbb_forums')->where('forum_id',$forum_id)->get()->row();
			
			$forum_name = $res_foro->forum_name;
			
			$html = $html.'<li>
			            
			                <div class="post-foro">
			                    <a href="'.site_url().'foro/indice/'.$t.'" >'.$topic->topic_title.'</a>
			                    <p>
			                       <i><b>'.$forum_name.'</b></i>  por '.$usuario.' ('.timeago($fecha).')
			                    </p>
			                </div>
			            
			            
			            
			        </li>';
			

			/*$html = $html.'<font face="verdana" size="1">»&nbsp;<a href="'.site_url().'foro/indice/'.$t.'" >'.$topic->topic_title.'</a><br>&nbsp;&nbsp;en <i><b>'.$forum_name.'</b></i>  por '.$usuario.' ('.timeago($fecha).')</font><br>';*/
			
			
		}

		return $html;
		

	}
}