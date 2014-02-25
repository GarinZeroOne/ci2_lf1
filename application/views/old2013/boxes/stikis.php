

<div class="row">

    <div class="span12">

        <div class="migas">
            <?php echo anchor('boxes','Boxes').' <span>></span> '.'Stikis'; ?>
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


 <!-- CONTROL DE APERTURA Y CIERRE DE BOXES -->
<?php if($boxes):?>

<div class="row">
    <div class="span12">

       <div id="msg">
        <?php echo $info_txt;   ?>
        </div>

    </div>

</div>


<div class="row">

    <div class="span6">

        <h3 class="boxcab">¿Que son los Stikis?</h3>
        <p>Aumenta tus posibilidades duplicando los puntos y el dinero de tu piloto estrella!
        El piloto que lleve un stiki en su monoplaza duplicara los puntos o el dinero ganado, dependiendo del tipo de stiki que lleve.</p>
        <p>El precio del STIKI depende del valor de mejora de los mecánicos. Cuanto mas alto sea el nivel de mecanicos mas baratos podras comprar los stikis.</p>
        <p> Si cancelas un STIKI , solo se te devolverá el 50% del valor del STIKI original (15.000 € el Stiki de Dinero y 200.000 € por el de puntos)</p>
        <ul>
            <li> Solo se pueden llevar dos STIKIS por carrera.</li>
            <li> Un corredor solo puede llevar un STIKI.</li>
        </ul>



    </div>


    <div class="span6">

        <h3 class="boxcab"> Comprar Stikis</h3>

        <table class="tStiki table table-striped table-bordered">
        <th>Tipo Stiki</th><th>Descripcion</th><th>Precio</th>
        <tr>
            <td><img src="<?=base_url()?>img/stikidinero.png" /></td><td> STIKI multiplicador de dinero.</td>
            <td>
            30.000 €
            <?
            $color_mecanico = 'style="color:#ff8000;"' ;

            if($mecanicos)
            {
                echo "<b ".$color_mecanico."> (".number_format((30000 - (30000 * $mecanicos)), 0, ",", ".")."€ )</b>";
            }
            else
            {
                echo "<b ".$color_mecanico."> ( 30.000 € )</b>";
            }
            ?>
            </td>
        </tr>
        <tr>
            <td><img src="<?=base_url()?>img/stikipuntos.png" /></td><td>  STIKI multiplicador de puntos.</td>
            <td>
            400.000 €
            <?
            if($mecanicos)
            {
                echo "<b ".$color_mecanico."> (".number_format((400000 - (400000 * $mecanicos)), 0, ",", ".")."€ )</b>";
            }
            else
            {
                echo "<b ".$color_mecanico."> ( 400.000 € )</b>";
            }
            ?>

            </td>
        </tr>
        </table>

        <form   method="post" action="<?=site_url()?>/boxes/stikis_comprar" class="form-vertical">

            <div class="cStiki">
                <span style="display:block;">Selecciona el tipo de Stiki </span>
                <select name="tipoStiki" id="tipoStiki" >
                    <option value="dinero">  Dinero</option>
                    <option value="puntos"> Puntos</option>
                </select>

            </div>


            <div class="cPiloto">
                <span style="display:block;"> Selecciona el piloto </span>
                <select name="selPiloto" id="selPiloto">

                    <?php if(!$info_pilotos) : ?>
                        <option value="">No tienes pilotos</option>
                    <?php endif; ?>

                    <?php foreach($info_pilotos as $piloto):?>

                        <option value="<?=$piloto->id?>"><?=$piloto->nombre." ".$piloto->apellido;?></option>

                    <?endforeach; ?>

                </select>
            </div>


        <div class="cComprar">
            <input type="submit" value="Comprar stiki seleccionado" class="btn btn-large btn-primary">
        </div>


        </form>




    </div>


</div>

<div class="row">

    <div class="span12">

        <h3 class="boxcab">Pilotos con STIKI para <?=$paisGP?></h3>

            <table class="tStiki2">
                <tr>


            <? foreach($info_stikis as $stiki): ?>

                <td>

                <img border="1" src="<?=base_url()?>img/pilotos/<?=$stiki->foto;?>.jpg" />   <br>
                <?=$stiki->nombre." ".$stiki->apellido?> <br>
                <? if($stiki->stiki == 'puntos'): ?>
                    <img src="./img/stikipuntos.png" />
                <? else: ?>
                    <img src="./img/stikidinero.png" />
                <? endif;?>
                <br>
                <? echo anchor('boxes/cancelar_stiki/'.$stiki->id_piloto,'Cancelar');?>
                </td>

            <? endforeach;?>
            </tr>
            </table>

    </div>

</div>
















        <!-- BOXES CERRADOS -->
<?php else: ?>
        <div align="center">
        <img  src="<?php echo base_url().'img/boxes_cerrados.jpg'; ?>" border="0" ></img>
    </div>
    <?php endif;?>
</div>

<?php
/*
<!--  ADVERTISEMENT TAG 728 x 90, DO NOT MODIFY THIS CODE -->
<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
<script type="text/javascript">
<!--
document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="728" height="90" src="http://optimized-by.simply.com/play.html?code=119589;25503;26987;0&from='+escape(document.referrer)+'"></iframe>');
// -->
</script>
*/
 ?>