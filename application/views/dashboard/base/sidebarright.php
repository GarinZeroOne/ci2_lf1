<!--right sidebar start-->
<div class="right-sidebar">
<div class="search-row">
    <input type="text" placeholder="Buscar managers" class="form-control">
</div>
<ul class="right-side-accordion">
<li class="widget-collapsible">
    <a href="#" class="head widget-head red-bg active clearfix">
        <span class="pull-left">Ultimos post del FORO</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <?php echo forophpbb_model::get_last_topics(); ?>
    </ul>
</li>
<li class="widget-collapsible">
    <a href="#" class="head widget-head terques-bg active clearfix">
        <span class="pull-left">Ultimos Managers Online</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <li>
            <?php echo usuarios_model::get_ultimos_usuarios_logeados(); ?>
        </li>
    </ul>
</li>
<li class="widget-collapsible">
    <a href="#" class="head widget-head purple-bg active">
        <span class="pull-left"> Contacto</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <li>
            <div class="contacto" style="padding:6px;">
            <a href="mailto:lf1admin@gmail.com" style="color:#fff;font-size:15px;">Contactar con LF1</a>    
            </div>
            
        </li>
    </ul>
</li>

</ul>
</div>
<!--right sidebar end-->