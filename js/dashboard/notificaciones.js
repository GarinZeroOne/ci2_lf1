$(function () {

	// notificaciones
	
	// TO DO
});

function marcarNotifiLeida(obj){
	var num_notifi = parseInt($("#cont-notifi").text()) - 1;

	

	$.ajax({
          type: "POST",
          data:{ 
			idn: $(obj).attr('data-id')
  		  },
          url: site_url+"dashboard/ajax_notificacionleida",
          success: function(data){
              //alert(data);
              $("#cont-notifi").text(num_notifi);
              $(obj).parent().fadeOut();
              console.log(data);
              //$(".conversation-list").prepend(data);
              }
          },'html');

	
}
