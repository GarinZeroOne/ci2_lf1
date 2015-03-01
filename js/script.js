
/* Author: Gorka Garin

*/


$(function ()
{


	$("img").each(function(){

		if($(this).attr("height") == "1")
			$(this).css("display","none");
        if($(this).attr("width") == "1")
            $(this).css("display","none");

	});

    $("a img").each(function(){

        if($(this).attr("ismap") == "true")
            $(this).css("display","none");

    });

	//$('#clock').epiclock({mode: 'countdown', target: '2012 03 19 12:00:00'});
	//$('#clock').epiclock({mode: $.epiclock.modes.countdown, target: '2012 03 12 12:00:00', format: 'V:x:i:s', renderer: 'retro-countdown'});



    $(".boxoption").mouseover(function(e){
        $(this).children("span").addClass("textlayerOn");
        $(this).addClass("boxoptionsel");
        //e.children(".textlayer").addClass("textlayerOn");

    });

    $(".boxoption").mouseout(function(e){
        $(this).children("span").removeClass("textlayerOn");
        $(this).removeClass("boxoptionsel");
        //e.children(".textlayer").addClass("textlayerOn");

    });

    $(".boxoption").click(function(e){
        var url = $(this).children("span").children("a").attr("href");
        window.location = url;
        //console.log(url);
        //e.children(".textlayer").addClass("textlayerOn");

    });



    $( document ).tooltip({
        track: true,
         position: {

            using: function( position, feedback ) {
                $( this ).css( position );
                $( "<div>" )
                .addClass( "arrow" )
                .addClass( feedback.vertical )
                .addClass( feedback.horizontal )
                .appendTo( this );
                }
            }
    });


    $('input.checkCompra').click(function(e){



        if($(this).is(':checked')){
            console.log("oii");
            $(this).parent().parent().addClass('pilotoboxChecked');
        }
        else
        {

            $(this).parent().parent().removeClass('pilotoboxChecked');
        }


    });


    $('div.pilotobox').click(function(e){

        if($(this).children('span.cComprar').children().is(':checked')){
           //console.log("esta chekens");
            $(this).children('span.cComprar').children().attr('checked', false);
            $(this).removeClass('pilotoboxChecked');
        }
        else
        {
            $(this).children('span.cComprar').children().attr('checked', true);
            $(this).addClass('pilotoboxChecked');

        }


    });


     $('div.equipobox').click(function(e){

        if($(this).children('span.cComprar').children().is(':checked')){
           //console.log("esta chekens");
            $(this).children('span.cComprar').children().attr('checked', false);
            $(this).removeClass('equipoboxChecked');
        }
        else
        {
            $(this).children('span.cComprar').children().attr('checked', true);
            $(this).addClass('equipoboxChecked');

        }


    });

    $('.editor').jqte();


    
});




