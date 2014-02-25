<footer>
        <p>&copy; <a href="http://www.ligaformula1.com">Liga Formula 1 2012</a> | <a href="mailto:gestionlf1@gmail.com"><?php echo $this->lang->line('bottom_contacto');?></a> </p>
</footer>
</div> <!-- /container -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

<script>window.jQuery || document.write('<script src="<?php echo base_url();?>/js/libs/jquery-1.7.1.min.js"><\/script>')</script>




<script src="<?php echo base_url();?>/js/libs/bootstrap/transition.js"></script>
<script src="<?php echo base_url();?>/js/libs/bootstrap/collapse.js"></script>
<script src="<?php echo base_url();?>/js/libs/bootstrap/modal.js"></script>

<script src="<?php echo base_url();?>/js/jquery.epiclock.min.js"></script>
<script src="<?php echo base_url();?>/js/epiclock.retro-countdown.min.js"></script>
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

<?php /*NOTIFICACIONES*/ ?>
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
/*
<script type="text/javascript">
    var infolink_pid = 431575;
    var infolink_wsid = 0;
</script>
<script type="text/javascript" src="http://resources.infolinks.com/js/infolinks_main.js"></script>
*/
?>

<!-- AddThis Welcome BEGIN -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5119d19513b242e3"></script>
<script type='text/javascript'>
addthis.bar.initialize({'default':{"backgroundColor":"#000000","buttonColor":"#098DF4","textColor":"#FFFFFF","buttonTextColor":"#FFFFFF"},rules:[{"name":"Twitter","match":{"referringService":"twitter"},"message":"Si te gusta Liga Formula 1, ayudanos a  crecer y twitteanos ;-)","action":{"type":"button","text":"Tweet LF1","verb":"share","service":"twitter"}},{"name":"Facebook","match":{"referringService":"facebook"},"message":"Tell your friends about us:","action":{"type":"button","text":"Share on Facebook","verb":"share","service":"facebook"}},{"name":"Google","match":{"referrer":"google.com"},"message":"If you like this page, let Google know:","action":{"type":"button","text":"+1","verb":"share","service":"google_plusone_share"}}]});
</script>
<!-- AddThis Welcome END -->



<?php /*GOOGLE ANALYTICS*/ ?>
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