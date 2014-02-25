
<footer>
        <p>&copy; <a href="http://www.ligaformula1.com">Liga Formula 1 2012</a> | <a href="mailto:gestionlf1@gmail.com"><?php echo $this->lang->line('bottom_contacto');?></a> </p>
</footer>
</div> <!-- /container -->
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url();?>/js/libs/jquery-1.7.1.min.js"><\/script>')</script>


<script src="<?php echo base_url();?>/js/libs/bootstrap/transition.js"></script>
<script src="<?php echo base_url();?>/js/libs/bootstrap/collapse.js"></script>
<script src="<?php echo base_url();?>/js/libs/bootstrap/modal.js"></script>

<script src="<?php echo base_url();?>/js/jquery.tweet.js"></script>
<script src="<?php echo base_url();?>/js/tweet_lf1.js"></script>

<script src="<?php echo base_url();?>/js/jquery_notification/js/jquery_notification_v.1.js"></script>
<script src="<?php echo base_url();?>/js/jquery-te-1.3.2.2.min.js"></script>

<script src="<?php echo base_url();?>/js/script.js"></script>



<script type="text/javascript">
$(function(){
$('.sr').click(function() {
 if (location.pathname.replace(/^\//,'')
        == this.pathname.replace(/^\//,'')
        && location.hostname == this.hostname) {
    var $target = $(this.hash);
    $target = $target.length && $target
            || $('[name=' + this.hash.slice(1) +']');
    if ($target.length) {
      var targetOffset = $target.offset().top;
      $('html,body').animate({scrollTop: targetOffset-100}, 1500);
      return false;
    }
  }


});
});
</script>


<?php if($this->session->flashdata('login_error')): ?>
 <script type="text/javascript">
         showNotification({
          message: "<?php echo $this->session->flashdata('login_error_message');?>",
          type: "error",
          autoClose:true,
          duration:4
          });
</script>
<?php endif; ?>

<?php if($this->session->flashdata('usuario_nuevo')): ?>
 <script type="text/javascript">
         showNotification({
          message: "<?php echo $this->session->flashdata('usuario_nuevo_mensaje');?>",
          type: "success",
          autoClose:true,
          duration:6
          });
</script>
<?php endif; ?>


<?php /*PUBLICIDAD INFOLINKS*/
/* comento en php para que no se vea en el navegador :_)
<script type="text/javascript">
    var infolink_pid = 431575;
    var infolink_wsid = 0;
</script>
<script type="text/javascript" src="http://resources.infolinks.com/js/infolinks_main.js"></script>
*/
?>






<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1135501-5");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>

</html>