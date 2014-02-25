/**
 * @author mikelats
 */


//Funcion que carga en el formulario los valores de la cancion a modificar
function clasificacionGp(item){
	//Se obtiene el numero de lineas del ranking
	var numLineas = item.getElementsByTagName("posicion").length ;

	//Se quita el contenido del los div enlaces y ranking_gp
	$("#ranking_gp").empty();
	$("#enlaces").empty();
	
	//Se guardan el circuito y el pais
	var circuito = item.getElementsByTagName("circuito")[0].firstChild.nodeValue;
	var pais = item.getElementsByTagName("pais")[0].firstChild.nodeValue;
	
	//Obtengo mis datos
	var miPosicion = item.getElementsByTagName("miPosicion")[0].firstChild.nodeValue;
	var miAvatarPath = item.getElementsByTagName("miAvatarPath")[0].firstChild.nodeValue;
	var miNick = item.getElementsByTagName("miNick")[0].firstChild.nodeValue;
	var miPuntos = item.getElementsByTagName("miPuntos")[0].firstChild.nodeValue;
	var miPuntosStiki = item.getElementsByTagName("miPuntosStiki")[0].firstChild.nodeValue;
	
	//Se genera la tabla con la clasificacion
	var rankingGp = "<h3>Resultado GP <br>" + circuito + "(" + pais + ")</h3>";
	
	rankingGp = rankingGp + "<table>";
	
	//Si tengo una posicion estoy logueado
	if (!isNaN(miPosicion)){
		rankingGp = rankingGp + "<tr>";
		rankingGp = rankingGp + "<td class=\"posicion\">" + miPosicion + "</td>";	
		rankingGp = rankingGp + "<td><img class=\"avatar\" src=\"" + miAvatarPath + "\"/></td>";
		rankingGp = rankingGp + "<td class=\"nick\">" + miNick + "</td>";
		rankingGp = rankingGp + "<td class=\"puntos\">" + miPuntos + "+" + miPuntosStiki + "</td>";
		rankingGp = rankingGp + "</tr>";
	}
	
	rankingGp = rankingGp + "<th>#</th><th>Avatar</th><th>Usuario</th><th>Puntos</th>";
	
	var i=0;
	numLineas = parseInt(numLineas);
	for (i=0;i<numLineas;i++) {
		rankingGp = rankingGp + "<tr>";
		var posicion = item.getElementsByTagName("posicion")[i].firstChild.nodeValue;
		var avatarPath = item.getElementsByTagName("avatarPath")[i].firstChild.nodeValue;
		var nick = item.getElementsByTagName("nick")[i].firstChild.nodeValue;
		var puntos = item.getElementsByTagName("puntos")[i].firstChild.nodeValue;
		var puntosStiki = item.getElementsByTagName("puntosStiki")[i].firstChild.nodeValue;
		
		//Se genera la nueva tabla
		rankingGp = rankingGp + "<td class=\"posicion\">" + posicion + "</td>";	
		rankingGp = rankingGp + "<td><img class=\"avatar\" src=\"" + avatarPath + "\"/></td>";
		rankingGp = rankingGp + "<td class=\"nick\">" + nick + "</td>";
		rankingGp = rankingGp + "<td class=\"puntos\">" + puntos + "+" + puntosStiki + "</td>";
		rankingGp = rankingGp + "</tr>";
	}
	rankingGp = rankingGp + "</table>";	
	$("#ranking_gp").html(rankingGp);
	
	//Se genera la lista de enlaces
	var listaEnlaces ="";
	var numEnlaces = item.getElementsByTagName("numEnlace").length ;
	for(j=0;j<numEnlaces;j++){
		var enlace = item.getElementsByTagName("numEnlace")[j].firstChild.nodeValue;
		if(j == numEnlaces-1){
			var listaEnlaces = listaEnlaces + enlace;	
		}
		else{
			var listaEnlaces = listaEnlaces + enlace + "-";
		}
	}
	$("#enlaces").html(listaEnlaces);
}

function clasificacionGeneral(item){
	var kLineasPantalla = 30;
	//Se obtiene el numero de lineas del ranking
	var numLineas = item.getElementsByTagName("nick").length ;

	//Se quita el contenido del los div enlaces y ranking_gp
	$("#ranking").empty();
	$("#enlaces").empty();
	
	//Obtengo mis datos
	var miPosicion = item.getElementsByTagName("miPosicion")[0].firstChild.nodeValue;
	var miAvatarPath = item.getElementsByTagName("miAvatarPath")[0].firstChild.nodeValue;
	var miNick = item.getElementsByTagName("miNick")[0].firstChild.nodeValue;
	var miPuntos = item.getElementsByTagName("miPuntos")[0].firstChild.nodeValue;
	
	var rankingGeneral = "<h3>General Usuarios </h3><table>";
	
	rankingGeneral = rankingGeneral + "<tr>";
	rankingGeneral = rankingGeneral + "<td class=\"posicion\">" + miPosicion + "</td>";	
	rankingGeneral = rankingGeneral + "<td><img class=\"avatar\" src=\"" + miAvatarPath + "\"/></td>";
	rankingGeneral = rankingGeneral + "<td class=\"nick\">" + miNick + "</td>";
	rankingGeneral = rankingGeneral + "<td class=\"puntos\">" + miPuntos + "</td>";
	rankingGeneral = rankingGeneral + "</tr>";
	
	//Se genera la tabla con la clasificacion
	var i=0;
	rankingGeneral = rankingGeneral + "<th>#</th><th>Avatar</th><th>Usuario</th><th>Puntos</th>";
	
	numLineas = parseInt(numLineas);
	for (i=0;i<numLineas;i++) {
		rankingGeneral = rankingGeneral + "<tr>";
		var posicion = item.getElementsByTagName("posicion")[i].firstChild.nodeValue;
		var avatarPath = item.getElementsByTagName("avatarPath")[i].firstChild.nodeValue;
		var nick = item.getElementsByTagName("nick")[i].firstChild.nodeValue;
		var puntos = item.getElementsByTagName("puntos")[i].firstChild.nodeValue;
		
		//Se genera la nueva tabla
		rankingGeneral = rankingGeneral + "<td class=\"posicion\">"+posicion+"</td>";	
		rankingGeneral = rankingGeneral + "<td><img class=\"avatar\" src=\""+avatarPath+"\"/></td>";
		rankingGeneral = rankingGeneral + "<td class=\"nick\">"+nick+"</td>";
		rankingGeneral = rankingGeneral + "<td class=\"puntos\">"+puntos+"</td>";
		rankingGeneral = rankingGeneral + "</tr>";
	}
	rankingGeneral = rankingGeneral + "</table>";	
	
	$("#ranking").html(rankingGeneral);
	
	//Se genera la lista de enlaces
	var listaEnlaces ="";
	var numEnlaces = item.getElementsByTagName("numEnlace").length ;
	for(j=0;j<numEnlaces;j++){
		var enlace = item.getElementsByTagName("numEnlace")[j].firstChild.nodeValue;
		//Si es el ultimo no se pone guion
		if(j == numEnlaces - 1){
			var listaEnlaces = listaEnlaces + enlace;	
		}
		else{
			var listaEnlaces = listaEnlaces + enlace + "-";
		}
	}
	
	$("#enlaces").html(listaEnlaces);
}




