
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <script language="JavaScript">
                <!--
                function calcHeight()
                {
                 //Cojo la altura en nuestra página
                 var the_height=
                 document.getElementById
                ('the_iframe').contentWindow.
                 document.body.scrollHeight;
                //Cambio la altura del iframe
                 document.getElementById('the_iframe')
                .height= the_height;
                }
                //-->
                </script>

                    <?php if($topic): ?>
                    <span style="color: #993366;"><iframe width="100%" id="the_iframe" onLoad="calcHeight();" src="<?php echo site_url();?>/comunidad/viewtopic.php?t=<?php echo $topic; ?>" scrolling="NO" frameborder="0" height="1"></iframe></span>

                    <?php else: ?>
                    <span style="color: #993366;"><iframe width="100%" id="the_iframe" onLoad="calcHeight();" src="<?php echo site_url();?>/comunidad" scrolling="NO" frameborder="0" height="1"></iframe></span>   
                    <?php endif; ?>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
