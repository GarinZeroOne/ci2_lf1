<script>
$(document).ready(function(){

/*
  $.fn.increment = function (from, to, duration, easing, complete) {
    var params = $.speed(duration, easing, complete);
    return this.each(function(){
        var self = this;
        params.step = function(now) {
            self.innerText = now << 0;
        };

        $({number: from}).animate({number: to}, params);
    });
 };

 $('#saldo').increment(0, 1337);
*/
jQuery({someValue: <?php echo $banco_desde; ?>}).animate({someValue: <?php echo $banco_hasta; ?>}, {
  duration: 10000,
  easing:'swing', // can be anything
  step: function() { // called on every step
    // Update the element's text with rounded-up value:
    $('#saldo').text(Math.ceil(this.someValue));
  },
  complete:function(){
  	$('#saldo').text(<?php echo $banco_hasta; ?> )
  	$('#saldo').prettynumber();
  }
});



});
</script>