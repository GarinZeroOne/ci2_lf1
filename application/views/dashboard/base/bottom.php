<!-- Final section id=container -->
</section>

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="<?= base_url();?>js/dashboard/lib/jquery.js"></script>
<script src="<?= base_url();?>assets/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?= base_url();?>bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?= base_url();?>js/dashboard/accordion-menu/jquery.dcjqaccordion.2.7.js"></script>


<script src="<?= base_url();?>js/dashboard/scrollTo/jquery.scrollTo.min.js"></script>
<script src="<?= base_url();?>js/dashboard/nicescroll/jquery.nicescroll.js" type="text/javascript"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="<?= base_url();?>assets/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="<?= base_url();?>assets/advanced-datatable/media/js/jquery.dataTables.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url();?>assets/data-tables/DT_bootstrap.js"></script>
<?php /*
<script src="<?= base_url();?>assets/skycons/skycons.js"></script>
<script src="<?= base_url();?>assets/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?= base_url();?>assets/calendar/clndr.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="<?= base_url();?>assets/calendar/moment-2.2.1.js"></script>
<script src="<?= base_url();?>js/dashboard/calendar/evnt.calendar.init.js"></script>
<script src="<?= base_url();?>assets/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url();?>assets/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
<script src="<?= base_url();?>assets/gauge/gauge.js"></script>
<!--clock init-->
<script src="<?= base_url();?>assets/css3clock/js/script.js"></script>

<!--Easy Pie Chart-->
<script src="<?= base_url();?>assets/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="<?= base_url();?>assets/sparkline/jquery.sparkline.js"></script>
<!--Morris Chart-->
<script src="<?= base_url();?>assets/morris-chart/morris.js"></script>
<script src="<?= base_url();?>assets/morris-chart/raphael-min.js"></script>
<!--jQuery Flot Chart-->
<script src="<?= base_url();?>assets/flot-chart/jquery.flot.js"></script>
<script src="<?= base_url();?>assets/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url();?>assets/flot-chart/jquery.flot.resize.js"></script>
<script src="<?= base_url();?>assets/flot-chart/jquery.flot.pie.resize.js"></script>
<script src="<?= base_url();?>assets/flot-chart/jquery.flot.animator.min.js"></script>
<script src="<?= base_url();?>assets/flot-chart/jquery.flot.growraf.js"></script>
*/?>
<script src="<?= base_url();?>js/dashboard/custom-select/jquery.customSelect.min.js" ></script>
<script src="<?= base_url();?>js/dashboard/prettynumber/jquery.prettynumber.js" ></script>
<script src="<?= base_url();?>js/dashboard/jquery-confirm/jquery.confirm.min.js" ></script>


<!--common script init for all pages-->
<script src="<?= base_url();?>js/dashboard/scripts.js"></script>
<script src="<?= base_url();?>js/dashboard/dashboard.js"></script>
<?php 
    if($javascript){
      foreach($javascript as $js){
        echo '<script type="text/javascript" src="'.base_url().'/js/'.$js.'"></script>';
      }  
    }
    
?>

<?php 
	if($javascript_php){
		foreach($javascript_php as $jsp)
		{
			echo $jsp;
		}
	}
?>

</body>
</html>
