<?php
class Tareas_cron extends Controller{

	function Tareas_cron()
	{
		parent::Controller();
		$this->load->database();
	}

	function test()
	{

		if($this->input->ip_address() == '92.43.19.150')
		{
			$data_insert = array('id'=>'','texto'=>'Prueba desde el administrador de tareas','fecha'=>date('Y-m-d H:i:s'),'ipadrr'=>$this->input->ip_address());

			$this->db->insert('test_tareas_cron',$data_insert);

			echo "Tarea ejecutada con exito";	
		}
		else
		{
			$data_insert = array('id'=>'','texto'=>'Alguien de fuera del server  ha intentado ejecutar esto (test)','fecha'=>date('Y-m-d H:i:s'),'ipadrr'=>$this->input->ip_address());

			$this->db->insert('test_tareas_cron',$data_insert);
		}

	}

	function api()
	{
		$json = file_get_contents('http://ergast.com/api/f1/2013/last/results.json');
		$obj = json_decode($json);
		dump($obj->MRData->RaceTable->Races[0]->Results);

		$resultados = $obj->MRData->RaceTable->Races[0]->Results;
		/*
		foreach($resultados as $res){

			echo "<br>";
			echo $res->Driver->code;

		}
		*/

	}


}