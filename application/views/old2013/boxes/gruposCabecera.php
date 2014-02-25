




<div id="contenBox">

    <?php /*
    <!--  ADVERTISEMENT TAG 728 x 90, DO NOT MODIFY THIS CODE -->
    <script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
    <script type="text/javascript">
        <!--
        document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="728" height="90" src="http://optimized-by.simply.com/play.html?code=119589;25503;26987;0&from='+escape(document.referrer)+'"></iframe>');
        // -->
    </script>
    */
    ?>

    <div id="textinfo">
        <h3 class="boxcab"><? echo $this->lang->line('grupos_titulo_principal') ?></h3>
        <? echo $this->lang->line('grupos_texto_inicio') ?>
    </div>

    <div id="menu_grupo" class="menuGrupo">
        <div id="clasficaciones" class="menu">
            <?php echo anchor('grupos/grupos_general', $this->lang->line('grupos_lbl_clasificaciones')) ?>
        </div>
        <div id="invitacionPeticion" class="menu">
            <?php echo anchor('grupos/gruposInvitacionesPeticiones', $this->lang->line('grupos_lbl_inv_pet')) ?>
        </div>
        <div id="gestionGrupos" class="menu">
            <?php echo anchor('grupos/gestionGrupos', $this->lang->line('grupos_lbl_gestion_grupos')) ?>
        </div>
    </div>
    <div id="content">

