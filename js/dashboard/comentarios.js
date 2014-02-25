$(document).ready(function(){

  // scroll chat down / no va fino :/
  var mydiv = $('#conversation-list');
  mydiv.scrollTop(mydiv.prop('scrollHeight'));
  
  $("#conversation-list li:last").focus();

  // Enviar mensajes
  $('#submit-comment').on('click',function(){
   var gi = $('#submit-comment').attr('data-gi');
   var commentdata=$("#chat-text").val();

   if(commentdata!=''){
     $("#chat-text").val("");
    //alert(commentdata);
     
      $.ajax({
          type: "POST",
                       data:{ 
              comment: commentdata,
              gi: gi
                  },
          url: site_url+"grupos/ajax_chat",
          success: function(data, textStatus){
              //alert(data);
              $(".conversation-list").append(data);
              }
          },'html');

      var mydiv = $('#conversation-list');
      mydiv.scrollTop(mydiv.prop('scrollHeight'));
      }
    });

  //Cargar mensajes anteriores
  $('#cargar-anteriores-btn').on('click',function()  {
    $('#cargar-anteriores-btn').text('Cargando...');
    var dataid = $('#cargar-anteriores-btn').attr('data-internal');
    
    $.ajax({
        type: "POST",
                     data:{ 
            dataid: dataid
                },
        url: site_url+"grupos/ajax_load_more",
        success: function(data, textStatus){
            $('#cargar-anteriores-btn').fadeOut();
            //alert(data);
            $(".conversation-list").prepend(data);
          }
        },'html');

  });

  // Detectar ENTER
  $.fn.pressEnter = function(fn) {  

    return this.each(function() {  
        $(this).bind('enterPress', fn);
        $(this).keyup(function(e){
            if(e.keyCode == 13)
            {
              $(this).trigger("enterPress");
            }
        })
    });  
   }; 

  //use it:
  $('#chat-text').pressEnter(function(){

    var gi = $('#submit-comment').attr('data-gi');
    var commentdata=$("#chat-text").val();

    if(commentdata!=''){

      $("#chat-text").val("");
      // focus al ultimo

      $.ajax({
        type: "POST",
                     data:{ 
            comment: commentdata,
            gi: gi
                },
        url: site_url+"grupos/ajax_chat",
        success: function(data, textStatus){
            //alert(data);
            $(".conversation-list").append(data);
            mydiv.scrollTop(mydiv.prop('scrollHeight'));
            }
        },'html');

      var mydiv = $('#conversation-list');
      mydiv.scrollTop(mydiv.prop('scrollHeight'));
    }

  });





});


function ldp_mensajes()
  {
    $('#cargar-anteriores-btn').text('Cargando...');
    var dataid = $('#cargar-anteriores-btn').attr('data-internal');
    
    $.ajax({
        type: "POST",
                     data:{ 
            dataid: dataid
                },
        url: site_url+"grupos/ajax_load_more",
        success: function(data, textStatus){
            $('#cargar-anteriores-btn').fadeOut();
            //alert(data);
            $(".conversation-list").prepend(data);
          }
        },'html');
  }

  function citar(c)
  {
    $('#chat-text').val($('#chat-text').val()+' #'+$(c).attr('data-msg-internal')+' ');
    
  }