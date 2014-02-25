<div id="listado_circuitos">
	<div id="circuitos">
		<h3>Listado de circuitos:</h3>
		<table>
			
		<th>Circuito</th><th>Pais</th><th>Fecha</th>
		<? 
		foreach ($circuitos as $linea){
			
			if($linea->fecha == date('Y-m-d')){
				$color = 'style="background-color:#00ff40;"';
				echo "<tr {$color}>";
				echo "<td>".$linea -> circuito."</td>";
				echo "<td>".$linea -> pais."</td>";
				echo "<td>".$linea -> fecha."</td>";
				echo "</tr>";
			}
			elseif($linea->fecha < date('Y-m-d')){
				$color = ' style="background-color:#ff0000;"';
				echo "<tr {$color}>";
				echo "<td>".anchor('/ranking/gp/'.$linea->id,$linea -> circuito)."</td>";
				echo "<td>".$linea -> pais."</td>";
				echo "<td>".$linea -> fecha."</td>";
				echo "</tr>";
			}
			else{
				$color = '';
				echo "<tr {$color}>";
				echo "<td>".$linea -> circuito."</td>";
				echo "<td>".$linea -> pais."</td>";
				echo "<td>".$linea -> fecha."</td>";
				echo "</tr>";
			}
			
			
		}
		 ?>	
		 </table>
	</div>
</div>
	
