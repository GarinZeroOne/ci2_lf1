<div id="listado_circuitos">
	<div id="circuitos">
		<h3><? echo $this->lang->line('calendario_ttl_calendario')?></h3>
		<table>
			
		<th><? echo $this->lang->line('calendario_lbl_circuito')?></th>
                <th><? echo $this->lang->line('calendario_lbl_pais')?></th>
                <th><? echo $this->lang->line('calendario_lbl_fecha')?></th>
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
				
				// Parche shakir 2011,cancelado
				if( $linea->circuito == 'SakhirNOEN2012')
				{
					echo "<td>".$linea->circuito."( Cancelado ) </td>";
				}
				else
				{
					echo "<td>".anchor('/ranking/gp/'.$linea->id,$linea -> circuito)."</td>";	
				}
				
				
				
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


