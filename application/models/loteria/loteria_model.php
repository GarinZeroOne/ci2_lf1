<?php
class loteria_model extends CI_Model
{
	private $idGp;
	
	function loteria_model()
	{
		parent::__construct();
		
		// Obtener id del GP
		$hoy = date('Y-m-d');
		
		$sql   = "SELECT id FROM circuitos WHERE fecha >= '{$hoy}' ORDER BY fecha ASC LIMIT 0,1";
		$this->idGp = $this->db->query($sql)->row()->id;
	}
	
	function getIdGp()
	{
		return $this->idGp;
	}
	
	function getBote($modo = '')
	{
		// Obtener bote
		$sql = "SELECT bote FROM loteria_bote";
		$bote = $this->db->query($sql)->row()->bote;
		
		if($modo == 'formateado'){
			return number_format($bote, 0, ",", ".");
		}
		else{
			return $bote;
		}
		
	}
	
	function getMisNumeros()
	{
		$sql = "SELECT * FROM 
							loteria_usuarios
						 WHERE
						 	id_usuario = ?
						 AND
						 	id_gp = ?
						 AND
						 	estado = 'sin procesar'";
		return $this->db->query($sql,array($_SESSION['id_usuario'],$this->idGp))->result();
	}
	
	// Guardar los numeros seleccionados y restar dinero
	
	function guardar_loteria($datos)
	{
		// Contador para el numero de "numeros" comprados :_)
		$cont = 0;
		
		// Variable para validar que un numero ha sido encontrado
		$encontrado = FALSE;
		// Comprobar que tiene dinero suficiente
		
		$dinero_gastado = count($datos['numero'])*5000;
		$fondos_usuario = $this->db->query("SELECT fondos FROM usuarios_banco WHERE id_usuario = ?",
											array($_SESSION['id_usuario']))->row()->fondos;
		
		if( $fondos_usuario > $dinero_gastado )
		{
			// Tiene dinero para pagarse los nums seleccionados
			// Vamos a comprobar que no haya comprado anteriormente este numero
				
			$sqlCheckNumero = "SELECT numero_loteria FROM loteria_usuarios WHERE id_usuario = ? AND id_gp = ? AND estado ='sin procesar'";
			$numerosComprados = $this->db->query($sqlCheckNumero,array($_SESSION['id_usuario'],$this->idGp))->result_array();
			
			// Recorremos los numeros seleccionados
			
			foreach( $datos['numero'] as $num )
			{
				// Comprobamos si tenemos numeros comprados anteriormente
				
				if($numerosComprados)
				{
					// Recorremos los numeros comprados y guardamos los nuevos
					// siempre y cuando sean diferentes a los que tenemos
					
					foreach($numerosComprados as $x)
					{	
						// echo $num." != ".$x['numero_loteria']."<br>";
						if($num == $x['numero_loteria'])
						{
								$encontrado = TRUE;
						}
						
					}
					
					// Si no se ha encontrado se guarda el nuevo numero
					
					if(!$encontrado)
					{
						// Guardamos el numero y contabilizamos con el contador
						// para luego cobrarle solo los numeros que hemos guardado
							
						$sql = "INSERT INTO loteria_usuarios VALUES('',?,?,?,?,'sin procesar')";
						$this->db->query($sql,array($_SESSION['id_usuario'],$this->idGp,$num,date('Y-m-d')));
							
						$cont++;
						
					}
					
					$encontrado = FALSE;
				}
				else
				{
					// Guardamos los numeors, es la primera compra de loteria
					
					$sql = "INSERT INTO loteria_usuarios VALUES('',?,?,?,?,'sin procesar')";
					$this->db->query($sql,array($_SESSION['id_usuario'],$this->idGp,$num,date('Y-m-d')));
					
					$cont++;
				}
				
				
			}
			
			// Ya hemos guardado los numeros
			// ahora hay que restarle la cantidad
			// y sumarla al bote de la loteria
			
			$pastizal = $cont * 5000;
			
			// Actualizamos sus datos bancarios, le cobramos vaya...
			
			$this->db->query("UPDATE usuarios_banco 
							 SET fondos=fondos - {$pastizal}
							 WHERE id_usuario = {$_SESSION['id_usuario']}");
			
			// Actualizamos el bote de la loteria
			
			$this->db->query("UPDATE loteria_bote 
							  SET bote = bote + {$pastizal}");
			
			return "<div class='msgOk'>Loteria comprada satisfactoriamente. Te has gastado {$pastizal}€, suerte!</div>";
		}
		else
		{
			return "<div class='msgErr'>No dispones de dinero suficiente para los numeros comprados.</div>";	
		}
		
	}
}
