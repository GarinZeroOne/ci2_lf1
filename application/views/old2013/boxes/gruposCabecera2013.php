


<div class="row">

    <div class="span12">

        <div class="migas">
            <?php echo anchor('boxes','Boxes').' <span>> Grupos </span> '; ?>
        </div>

        <div class="ads">

        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-2361705659034560";
        /* Box_horizontal */
        google_ad_slot = "1297942735";
        google_ad_width = 728;
        google_ad_height = 90;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>

      </div>

    </div>

</div>


<div class="row">

    <div class="span6">


         <div id="textinfo">
        <h3 class="boxcab"><? echo $this->lang->line('grupos_titulo_principal') ?></h3>
        <? echo $this->lang->line('grupos_texto_inicio') ?>
        </div>
    </div>

    <div class="span6">


        <div id="menu_grupo" class="menuGrupo">
            <div id="clasficaciones" class="menuB">
                <?php echo anchor('grupos/grupos_general', $this->lang->line('grupos_lbl_clasificaciones'),array("class"=>"menu")) ?>
            </div>
            <div id="invitacionPeticion" class="menuB">
                <?php echo anchor('grupos/gruposInvitacionesPeticiones', $this->lang->line('grupos_lbl_inv_pet'),array("class"=>"menu")) ?>
            </div>
            <div id="gestionGrupos" class="menuB">
                <?php echo anchor('grupos/gestionGrupos', $this->lang->line('grupos_lbl_gestion_grupos'),array("class"=>"menu")) ?>
            </div>
        </div>



    </div>

</div>