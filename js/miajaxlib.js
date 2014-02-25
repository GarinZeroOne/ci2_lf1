function createREQ() {
try {
     req = new XMLHttpRequest(); /* p.e. Firefox */
     } catch(err1) {
       try {
       req = new ActiveXObject('Msxml2.XMLHTTP'); /* algunas versiones IE */
       } catch (err2) {
         try {
         req = new ActiveXObject("Microsoft.XMLHTTP"); /* algunas versiones IE */
         } catch (err3) {
          req = false;
         }
       }
     }
     return req;
}
function requestGET(url, query, req) {
	//alert(query);
	myRand=parseInt(Math.random()*99999999);
	req.open("GET",url+'?'+'query'+'&rand='+myRand,true);
	req.send(null);
}
function requestPOST(url, query, req) {
	//alert(url);
	req.open("POST", url,true);
	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req.send(query);
}
function doCallback(callback,item) {
	//alert(callback);
	eval(callback + '( item )');
}

function doAjax(url,query,callback,reqtype,getxml) {
// crea la instancia del objeto XMLHTTPRequest 
	//alert('doAjax');
	//alert(url);
	//alert(query);
	//alert(callback);
	var myreq = createREQ();
	myreq.onreadystatechange = function() {

		if(myreq.readyState == 4) {
			//alert(myreq.status);
		   if(myreq.status == 200) {
		      var item = myreq.responseText;

		      if(getxml==1) {
		         item = myreq.responseXML;
		      }
		      doCallback(callback, item);
		    }
		  }
	}

	if(reqtype=='post') {
        //alert(url);
		requestPOST(url,query,myreq);
	} 
	else {
		requestGET(url,query,myreq);
	}
}

function enviarFormulario(url, formid,callback,getxml){
	var camposNoEnviar = 'userfile';
	var Formulario = document.getElementById(formid);
	var longitudFormulario = Formulario.elements.length;
	var cadenaFormulario = "";
	var sepCampos;
	sepCampos = "";
        
	for (var i = 0; i <= Formulario.elements.length - 1; i++) {
		if (Formulario.elements[i].name != camposNoEnviar){
			cadenaFormulario += sepCampos + Formulario.elements[i].name + '=' + encodeURI(Formulario.elements[i].value);
			sepCampos = "&";
		}
	}
	doAjax(url,cadenaFormulario,callback,'post',getxml);
	
}
 

