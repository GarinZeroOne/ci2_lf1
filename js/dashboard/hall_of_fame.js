$(document).ready(function(){  
  // Enviar mensajes
  $('#submit-comment').on('click',function(){

    
   var hofi = $('#submit-comment').attr('data-hof');
   var commentdata=$("#hall-text").val();
   //alert("id:"+hofi+" texto:"+commentdata);

   if(commentdata!=''){
     $("#hall-text").val("");
    //alert(commentdata);
     
      $.ajax({
          type: "POST",
                       data:{ 
              comment: commentdata,
              hofi: hofi
                  },
          url: site_url+"dashboard/ajax_hall",
          success: function(data, textStatus){
              //alert(data);
              $(".conversation-list").prepend(data);
              }
          },'html');

      //var mydiv = $('#conversation-list');
      //mydiv.scrollTop(mydiv.prop('scrollHeight'));
      }
      
    });


  $('span i.voto-manager').on('click',function(a){
    
    var  hofid = $(this).attr('data-hofid');
    var dedo = $(this);

    dedo.text("Votando...");
    
    $.ajax({
          type: "POST",
                       data:{ 
              hofiddata: hofid
                  },
          url: site_url+"dashboard/ajax_hall_voto_manager",
          success: function(data, textStatus){
              //alert(data);
              dedo.text("");
              dedo.prev().text(data);
              }
          },'html');

      

  });

});