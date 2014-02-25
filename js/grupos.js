/**
 * @author mikelats
 */
//Funcion que muestra la lista de miembros de un grupo
function miembrosGrupo(item){
    $("#grupoPropio").empty();
    console.log(item);
    //Se oculta el formularioCrear
    $("#formulario").hide();
    var numLineas = item.getElementsByTagName("miembroGrupo").length ;
    var nombreGrupo = item.getElementsByTagName("nombreGrupo")[0].firstChild.nodeValue;
    var idGrupo = item.getElementsByTagName("idGrupo")[0].firstChild.nodeValue;
    var lista = "<span class='titNombreGrupo'>" + nombreGrupo + "</span><span class='titMiembros'>Miembros del grupo</span>";
    var numeroMostrar;

    //Se pone el grupo en el div del grupo seleccionado
    $("#grupoSeleccionado").empty();
    $("#grupoSeleccionado").text(nombreGrupo);

    lista = lista + "<table class=\"tabla\"><th>#</th><th>Usuario</th>";
    for (i=0;i<numLineas;i++) {
        numeroMostrar = i + 1;
        lista = lista + "<tr>";
        var usuarioNick = item.getElementsByTagName("miembroGrupo")[i].firstChild.nodeValue;
        //Se genera la nueva tabla
        lista = lista + "<td>" + numeroMostrar + "</td>";
        lista = lista + "<td>" + usuarioNick + "</td>";
        lista = lista + "</tr>";
    }
    lista = lista + "</table>";
    //Se añade la opcion de borrar el grupo
    var borrarGrupo = "<br><a onclick=\"doAjax('" + site_url + "grupos/borrarGrupo','idGrupo=" + idGrupo + "','borrarGrupo','post',1)\" class='btn btn-danger'>Borrar grupo</a>";
    lista = lista + borrarGrupo;
    $("#grupoPropio").html(lista);
}

//Funcion que genera un formulario en el div grupoPropio
function mostrarFormulario(){
    $("#grupoPropio").empty();
    //Si hay algun mensaje anterior se borra
    $("#mensajeSpan").remove();
    //Se muestra el formulario
    $("#formularioCrear").show();
}

//Funcion que genera un formulario en el div grupoPropio
function crearGrupo(item){
    var hayMensaje = item.getElementsByTagName("mensaje").length ;
    $("#grupoPropio").empty();
    //Si hay algun mensaje anterior se borra
    $("#mensajeSpan").remove();
    //En el caso de haber algun mensaje se inserta antes de la tabla
    if (hayMensaje > 0) {
        var mensaje = item.getElementsByTagName("mensaje")[0].firstChild.nodeValue;
        $('<span id="mensajeSpan" >'+ mensaje +'</span>').insertBefore($("table"));
    }
    //Se llama a la funcion que genera la lista de grupos
    crearListaGrupo(item);

    //Se muestra el formulario
    $("#formularioCrear").show();
}

//Se genera de nuevo la lista de grupos
function crearListaGrupo(item){
    //Se vacia la lista
    $("#listaGruposPropios").empty();
    //Se genera la lista
    var lista = "";
    var numeroMostrar;
    var numLineas = item.getElementsByTagName("gruposFuncion").length ;
    for (i=0;i<numLineas;i++) {
        numeroMostrar = i + 1;
        var grupoFuncion = item.getElementsByTagName("gruposFuncion")[i].firstChild.nodeValue;
        //Se genera la nueva tabla
        lista = lista + grupoFuncion;
    }
    //Si no ha creado mas de 4 grupos se da la opcion de crear mas grupos
    if(numLineas < 5 ){
        var crearGrupo = "<div id=\"menuPropio" + numLineas + "\" class=\"mitadRanking\">" +
        "<b>" +
        "<a onClick=\"mostrarFormulario()\"> Crear grupo</a>" +
        "</b>" +
        "</div>";
        lista = lista + crearGrupo;
    }
    //Se introduce la lista en el div correspondiente
    $("#listaGruposPropios").html(lista);
}

//Funcion que genera el contenido de la pagina cuando se borra un grupo
function borrarGrupo(item){
    //Se llama a la funcion que genera la lista de grupos
    crearListaGrupo(item);

    //Se vacia el contenido del div donde se muestra la lista de miembros
    $("#grupoPropio").empty();

    //Se muestra el formulario
    $("#formularioCrear").show();
}

function optionUsuarioGrupo(item){
    $("#selectUsuario").empty();
    $("#mensajeSpan").empty();

    var numLineas = item.getElementsByTagName("miembroGrupo").length ;

    var lista ="";
    for (i=0;i<numLineas;i++) {
        var usuarioNick = item.getElementsByTagName("miembroGrupo")[i].firstChild.nodeValue;
        var idUsuario = item.getElementsByTagName("idUsuario")[i].firstChild.nodeValue;
        //Se genera la nueva tabla
        lista = lista + "<option value=" + idUsuario + ">" + usuarioNick + "</option>";
    }
    var mensaje = $(item).find('mensaje').text();
    alert(mensaje);
    //$('<span id="mensajeSpan" >'+mensaje+'</span>').insertAfter($("#formBorrarUsuario"));
    $("#mensajeSpan").text(mensaje);
    $("#selectUsuario").html(lista);
}

function grupoInvitacion(item){
    //Si hay algun mensaje de un grupo anterior se borra
    $("#mensajeSpan").remove();

    //Se borra el contenido del nick
    $("#nickGrupoFormulario").attr('value','');

    //Se guarda el id del grupo
    var idGrupo = item.getElementsByTagName("idGrupo")[0].firstChild.nodeValue;
    $("#idGrupoFormulario").attr('value',idGrupo)

    //Se guarda el nombre del grupo
    var nombreGrupo = item.getElementsByTagName("nombreGrupo")[0].firstChild.nodeValue;
    //Se pone el grupo en el div del grupo seleccionado
    $("#grupoSeleccionadoInvitaciones").empty();
    $("#grupoSeleccionadoInvitaciones").text(nombreGrupo);

    //Se llama a la funcion que genera la lista de invitaciones
    crearListaInvitaciones(item);
}

//Funcion que genera el contenido de la pagina cuando se crea una nueva invitacion
function nuevaInvitacion(item){
    //Si hay algun mensaje de un grupo anterior se borra
    $("#mensajeSpan").remove();

    //Se obtiene el mensaje a mostrar
    var mensaje = item.getElementsByTagName("mensaje")[0].firstChild.nodeValue;
    $('<span id="mensajeSpan" >'+ mensaje +'</span>').insertAfter($("#formNuevaInvitacion"));

    //Se llama a la funcion que genera la lista de invitaciones
    crearListaInvitaciones(item);
}

//Funcion que crea la lista de invitaciones no aceptadas
function crearListaInvitaciones(item){
    //Se vacia el div donde esta la tabla de invitaciones no aceptadas
    $("#listaInvitacionesNoAceptadas").empty();

    var numLineas = item.getElementsByTagName("usuarioInvitacion").length ;
    var lista = "<br><b>Invitaciones realizadas:</b>";
    if (numLineas == 0){
        lista = lista + "<br>No tienes invitaciones pendientes.";
    }else{
        lista = lista + "<ol>";
        for (i=0;i<numLineas;i++) {
            var usuarioInvitacion = item.getElementsByTagName("usuarioInvitacion")[i].firstChild.nodeValue;
            //Se genera la nueva lista
            lista = lista + "<li>" + usuarioInvitacion + "</li>";
        }
        lista = lista + "</ol>";
    }

    //Se introduce la lista en el div correspondiente
    $("#listaInvitacionesNoAceptadas").html(lista);
}

//Funcion procesada cuando se acepta una invitacion
function aceptaInvitacion(item){
    //Se vacia el div donde esta la tabla de invitaciones no aceptadas
    $("#listaInvitacionesRecibidas").empty();

    var numLineas = item.getElementsByTagName("nickInvitacion").length ;
    var lista = "<br><b>Invitaciones recibidas:</b><br><ol>";
    if (numLineas==0){
        lista = lista + "No tienes nuevas invitaciones."
    }
    for (i=0;i<numLineas;i++) {
        numeroMostrar = i + 1;
        var nickInvitacion = item.getElementsByTagName("nickInvitacion")[i].firstChild.nodeValue;
        var nombreGrupo = item.getElementsByTagName("nombreGrupo")[i].firstChild.nodeValue;
        var idInvitacion = item.getElementsByTagName("idInvitacion")[i].firstChild.nodeValue;
        //Se genera la nueva tabla
        lista = lista + "<li>" + nickInvitacion +
        " te invita a su grupo " + nombreGrupo + "<br>" +
        "<a onclick=\"doAjax('" + site_url + "grupos/aceptaInvitacion','idInvitacion=" + idInvitacion + "'," +
        "'aceptaInvitacion','post',1)\">Aceptar</a>" +
        " - " +
        "<a onclick=\"doAjax('" + site_url + "grupos/rechazaInvitacion','idInvitacion=" + idInvitacion + "'," +
        "'aceptaInvitacion','post',1)\">Rechazar</a></li>";
    }
    lista = lista + "</ol>";
    //Se introduce la lista en el div correspondiente
    $("#listaInvitacionesRecibidas").html(lista);
}

//Funcion procesada cuando se realiza una nueva peticion
function nuevaPeticion(item){
    //Se vacia el div donde esta la tabla de peticiones realizadas
    $("#peticionesRealizadas").empty();

    var numLineas = item.getElementsByTagName("nombreGrupo").length ;
    var lista = "<br><b>Peticiones realizadas:</b>";
    if (numLineas == 0){
        lista = lista + "<br>No tienes peticiones pendientes.";
    }else{
        lista = lista + "<ol>";
        for (i=0;i<numLineas;i++) {
            numeroMostrar = i + 1;
            var nombreGrupo = item.getElementsByTagName("nombreGrupo")[i].firstChild.nodeValue;
            //Se genera la lista
            lista = lista + "<li>" + nombreGrupo + "</li>";
        }
        lista = lista + "</ol>";
    }
    //Se introduce la lista en el div correspondiente
    $("#peticionesRealizadas").html(lista);
}


//Funcion procesada cuando se acepta una peticion
function aceptaPeticion(item){
    //Se vacia el div donde esta la tabla de invitaciones no aceptadas
    $("#peticionesRecibidas").empty();

    var numLineas = item.getElementsByTagName("nickInvitacion").length ;
    var lista = "<br><b>Peticiones recibidas:</b><br><ol>";
    if (numLineas==0){
        lista = lista + "No tienes nuevas peticiones."
    }
    for (i=0;i<numLineas;i++) {
        numeroMostrar = i + 1;
        var nickInvitacion = item.getElementsByTagName("nickInvitacion")[i].firstChild.nodeValue;
        var nombreGrupo = item.getElementsByTagName("nombreGrupo")[i].firstChild.nodeValue;
        var idPeticion = item.getElementsByTagName("idPeticion")[i].firstChild.nodeValue;
        //Se genera la nueva tabla
        lista = lista + "<li>" + nickInvitacion +
        " quiere entrar en tu grupo " + nombreGrupo + "<br>" +
        "<a onclick=\"doAjax('" + site_url + "grupos/aceptaPeticion','idPeticion=" + idInvitacion + "'," +
        "'aceptaPeticion','post',1)\">Aceptar</a>" +
        " - " +
        "<a onclick=\"doAjax('" + site_url + "grupos/rechazaPeticion','idPeticion=" + idInvitacion + "'," +
        "'aceptaPeticion','post',1)\">Rechazar</a></li>";
    }
    lista = lista + "</ol>";
    //Se introduce la lista en el div correspondiente
    $("#peticionesRecibidas").html(lista);
}

function clasificacionGrupos(item){

    console.log(item);

    //Se obtiene el numero de lineas del ranking
    var numLineas = item.getElementsByTagName("posicion").length;

    //Se quita el contenido del los div enlaces y ranking_gp
    $("#clasificacionGrupo").empty();

    //Se guardan el circuito y el pais
    //var circuito = item.getElementsByTagName("circuito")[0].firstChild.nodeValue;
    //var pais = item.getElementsByTagName("pais")[0].firstChild.nodeValue;

    var circuito = $(item).find("circuito").text();
    var pais = $(item).find("pais").text();

    //Se guarda el nombre del grupo
    //var nombreGrupo = item.getElementsByTagName("nombreGrupo")[0].firstChild.nodeValue;
    var nombreGrupo = $(item).find("nombreGrupo").text();

    //Se pone el grupo en el div del grupo seleccionado
    $("#grupoSeleccionado").empty();
    $("#grupoSeleccionado").text(nombreGrupo);

    //Se genera la tabla con la clasificacion
    var rankingGp = "<h3>Resultado GP <br>" + circuito + "(" + pais + ")</h3>";

    rankingGp = rankingGp + "<table>";
    rankingGp = rankingGp + "<th>#</th><th>Avatar</th><th>Usuario</th><th>Puntos</th>";

    var i = 0;
    numLineas = parseInt(numLineas);
    for (i = 0; i < numLineas; i++) {
        var posicion = i + 1 ;
        rankingGp = rankingGp + "<tr>";
        var avatarPath = item.getElementsByTagName("avatarPath")[i].firstChild.nodeValue;
        var nick = item.getElementsByTagName("nick")[i].firstChild.nodeValue;
        var puntos = item.getElementsByTagName("puntos")[i].firstChild.nodeValue;
        //var puntosStiki = item.getElementsByTagName("puntosStiki")[i].firstChild.nodeValue;

        //Se genera la nueva tabla
        rankingGp = rankingGp + "<td class=\"posicion\">" + posicion + "</td>";
        rankingGp = rankingGp + "<td><img class=\"avatar\" src=\"" +base_url + "img/avatares/" + avatarPath + "\"/></td>";
        rankingGp = rankingGp + "<td class=\"nick\">" + nick + "</td>";
        rankingGp = rankingGp + "<td class=\"puntos\">" + puntos + "</td>";
        rankingGp = rankingGp + "</tr>";
    }
    rankingGp = rankingGp + "</table>";
    $("#clasificacionGrupo").html(rankingGp);
    mostrarMensajes(item);
}


function clasificacionGeneralGrupos(item){
    //Se obtiene el numero de lineas del ranking
    //var numLineas = item.getElementsByTagName("nick").length;

    //Se quita el contenido del los div enlaces y ranking_gp
    $("#clasificacionGrupo").empty();

    //Se guarda el nombre del grupo
    //var nombreGrupo = item.getElementsByTagName("nombreGrupo")[0].firstChild.nodeValue;
    var nombreGrupo = $(item).find("nombreGrupo").text();

    //Se pone el grupo en el div del grupo seleccionado
    $("#grupoSeleccionado").empty();
    $("#grupoSeleccionado").text(nombreGrupo);

    //Se genera la tabla con la clasificacion
    var rankingGp = "<h3>Clasificacion General<br></h3>";

    rankingGp = rankingGp + "<table>";
    rankingGp = rankingGp + "<th>#</th><th>Avatar</th><th>Usuario</th><th>Puntos</th>";

    var i = 0;
    /*numLineas = parseInt(numLineas);
    for (i = 0; i < numLineas; i++) {
        var posicion = i + 1 ;
        rankingGp = rankingGp + "<tr>";
        var avatarPath = item.getElementsByTagName("avatarPath")[i].firstChild.nodeValue;
        var nick = item.getElementsByTagName("nick")[i].firstChild.nodeValue;
        var puntos = item.getElementsByTagName("puntos")[i].firstChild.nodeValue;

        //Se genera la nueva tabla
        rankingGp = rankingGp + "<td class=\"posicion\">" + posicion + "</td>";
        rankingGp = rankingGp + "<td><img class=\"avatar\" src=\"" + base_url + "img/avatares/" + avatarPath + "\"/></td>";
        rankingGp = rankingGp + "<td class=\"nick\">" + nick + "</td>";
        rankingGp = rankingGp + "<td class=\"puntos\">" + puntos + "</td>";
        rankingGp = rankingGp + "</tr>";

    }*/
    $(item).find('datosUsuario').each(function(){
        posicion = i + 1 ;
        nick = $(this).find("nick").text();
        avatarPath = $(this).find("avatarPath").text();
        puntos = $(this).find("puntos").text();
        avatar = $(this).find("avatar").text();
        //Se genera la nueva tabla
        rankingGp = rankingGp + "<tr>";
        rankingGp = rankingGp + "<td class=\"posicion\">" + posicion + "</td>";
        rankingGp = rankingGp + "<td><img class=\"avatar\" src=\"" + base_url + "img/avatares/" + avatarPath + "\"/></td>";
        rankingGp = rankingGp + "<td class=\"nick\">" + nick + "</td>";
        rankingGp = rankingGp + "<td class=\"puntos\">" + puntos + "</td>";
        rankingGp = rankingGp + "</tr>";
        i++;
    });

    rankingGp = rankingGp + "</table>";
    $("#clasificacionGrupo").html(rankingGp);
    mostrarMensajes(item);
}

//Funcion para controla el maximo numero de digitos en un textarea
function maximaLongitud(texto,maxlong)
{
    var tecla, int_value, out_value;

    if (texto.value.length > maxlong)
    {
        /*con estas 3 sentencias se consigue que el texto se reduzca
al tamaño maximo permitido, sustituyendo lo que se haya
introducido, por los primeros caracteres hasta dicho limite*/
        in_value = texto.value;
        out_value = in_value.substring(0,maxlong);
        texto.value = out_value;
        /*alert("La longitud máxima es de " + maxlong + " caractéres");*/
        return false;
    }
    return true;
}

function mostrarMensajes(item)
{
    //Se vacia el div
    $("#mensajes").empty();

    var grupo = $(item).find("grupo").text();
    var idGrupo = $(item).find("idGrupo").text();

    var nick;
    tablaMensajes = "<br><br><fieldset><legend>Mensajes del grupo</legend>";
    tablaMensajes = tablaMensajes + "<table class='table table-striped'>";

    $(item).find('mensaje').each(function(){
        nick = $(this).find("nick").text();
        fechaMensaje = $(this).find("fechaMensaje").text();
        contenido = $(this).find("contenido").text();
        avatar = $(this).find("avatar").text();
        tablaMensajes =  tablaMensajes + "<tr>";
        tablaMensajes =  tablaMensajes + "<td width='10'>";
        tablaMensajes =  tablaMensajes + "<img class='avatar' src= " + base_url + "img/avatares/" + avatar + ">";
        tablaMensajes =  tablaMensajes + "</td>";
        tablaMensajes =  tablaMensajes + "<td>";
        tablaMensajes =  tablaMensajes + "<span>" + nick + "</span> - " + fechaMensaje  + " <br>" + contenido + "<br>";
        tablaMensajes =  tablaMensajes + "</td>";
        tablaMensajes =  tablaMensajes + "</tr>";
    });

    tablaMensajes =  tablaMensajes + "</table>";
    tablaMensajes =  tablaMensajes + "</fieldset>";

    formEnvio = '<form id="formMensaje">';
    formEnvio = formEnvio + '<textarea name="mensaje" onkeyPress="return maximaLongitud(this,200)" rows="2" cols="70" ></textarea>';
    formEnvio = formEnvio + '<input type="hidden" name="idGrupo" value="'+idGrupo+'" />';
    formEnvio = formEnvio + '<a class="btn btn-success" onclick="enviarFormulario(\''+site_url+'grupos/enviarMensajes\',\'formMensaje\',\'mostrarMensajes\',1)" > Enviar </a>';
    formEnvio = formEnvio + '</form>';

    mensajes = tablaMensajes + formEnvio;



    $("#mensajes").html(mensajes);
}

$(document).ready(function(){
    //Al ponerser encima de GRUPOS
    $('div.seleccionaGrupo').toggle(
        function(){
            $('div.listaGrupos').slideDown();
        },
        function(){
            $('div.listaGrupos').slideUp();
        }
        );


    /*
    //Al quitarse de encima de GRUPOS
    $('div#listaGruposPropios').mouseout(
        function(){
            $('div.listaGrupos').slideUp();
        }
        );


    //Al ponerser encima de los GRUPOS
    $('div.listaGruposDesplegada').mouseover(
        function(){
            $('div.listaGrupos').show();
        }
        );
    //Al quitarse de encima de los GRUPOS
    $('div.listaGruposDesplegada').mouseout(
        function(){
            $('div.listaGrupos').hide();
        }
        );
    */

    var grupoSel = $("#content > div").attr("id");
    if (grupoSel == 'formulario_grupo'){
        $("#clasficaciones").css("background-color","#3C3C3E");
    }else if(grupoSel == 'invitaciones'){
        $("#invitacionPeticion").css("background-color","#3C3C3E");
    }else if(grupoSel == 'gestionGrupos'){
        $("#gestionGrupos").css("background-color","#3C3C3E");
    }
})
