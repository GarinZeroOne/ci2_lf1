
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

         <?php /******** MENSAJE MERCADO ABIERTO / CERRADO ****************/ ?>
        <?php if($this->session->flashdata('msg_boxes')): ?>
        <div class="row">
            <div class="col-md-12">
                    <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Mercado cerrado!</strong> <?php echo $this->session->flashdata('msg_boxes'); ?>
                    </div>
            </div>
        </div>
        <?php endif; ?>
        <?php /******** MENSAJE MERCADO ABIERTO / CERRADO ****************/ ?>
           
        <!-- page start-->
        <div class="row">

            

            <div class="col-md-12">
                   

                <div class="alert alert-info fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Recuerda!</strong> Las mejoras solo afectan a pilotos fichados! Los pilotos alquilados no se ven afectados por ninguna mejora.
                </div>

                                
            </div>
        </div>
        
        <div class="row">

            

            <div class="col-md-12">
                   
                    <?php if($this->session->flashdata('msg_ok')): ?>
                <div class="alert alert-success fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Fantástico!</strong> <?php echo $this->session->flashdata('msg_ok'); ?>
                </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('msg_error')): ?>
                    <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Opps!</strong> <?php echo $this->session->flashdata('msg_error'); ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                
                <div class="profile-nav alt-mejoras" style="float:left;">
                    <section class="panel">
                        <div class="user-heading alt-mejoras clock-row .terques-bg-mejoras">
                            <h1><i class="fa fa-wrench"></i> Mecánicos</h1>
                            <p class="text-left">Nivel <?php echo $mejora_mecanicos->nivel; ?></p>
                            <p class="text-left" style="font-size:12px;line-height:14px;">
                                Los mecanicos se encargaran de conseguir que el monoplaza rinda mas de lo normal.Para esto, le agregan al motor una pieza especial llamada STIKI. </br>
                                Por cada nivel que  subas esta mejora, reducirás un 5% el precio de los STIKIS de dinero y de puntos, hasta un máximo del 50%.
                            </p>
                            <div class="cont-boton"  style="margin-top:10px"><a href="<?php echo site_url();?>gestion/ampliar_mejora/2" class="btn btn-success btn-xs" type="button"><i class="fa fa-level-up"></i> Aumentar nivel:
                                <?php 
                                if($mejora_mecanicos)
                                {
                                    if($mejora_mecanicos->nivel<10)
                                    {
                                        $nivel = 'nivel_'.($mejora_mecanicos->nivel+1);
                                        echo es_dinero($mejora_mecanicos->$nivel)." €" ;
                                    }
                                    else
                                    {
                                        Echo "Máximo alcanzado.";
                                    }
                                }
                                else
                                {
                                    echo "10.000 €";
                                }   
                                    
                                    
                                    ?> </a></div>
                        </div>
                        

                        <ul class="nivel-mejoras">
                            <li <?php if($mejora_mecanicos->nivel >=1):?> class="active1" <?php endif;?> >
                                <span class="nivel">1</span>
                            </li>
                            <li  <?php if($mejora_mecanicos->nivel >=2):?> class="active2" <?php endif;?> >
                                <span class="nivel">2</span>
                            </li>
                            <li <?php if($mejora_mecanicos->nivel >=3):?> class="active3" <?php endif;?> >
                                <span class="nivel">3</span>
                            </li>
                            <li <?php if($mejora_mecanicos->nivel >=4):?> class="active4" <?php endif;?> >
                                <span class="nivel">4</span>
                            </li>
                            <li <?php if($mejora_mecanicos->nivel >=5):?> class="active5" <?php endif;?> >
                                <span class="nivel">5</span>
                            </li>
                            <li <?php if($mejora_mecanicos->nivel >=6):?> class="active6" <?php endif;?> >
                                <span class="nivel">6</span>
                            </li>
                            <li <?php if($mejora_mecanicos->nivel >=7):?> class="active7" <?php endif;?> >
                                <span class="nivel">7</span>
                            </li>
                            <li <?php if($mejora_mecanicos->nivel >=8):?> class="active8" <?php endif;?> >
                                <span class="nivel">8</span>
                            </li>

                            <li <?php if($mejora_mecanicos->nivel >=9):?> class="active9" <?php endif;?> >
                                <span class="nivel">9</span>
                            </li>
                            <li <?php if($mejora_mecanicos->nivel >=10):?> class="active10" <?php endif;?> >
                                <span class="nivel">10</span>
                            </li>
                        </ul>

                    </section>
                </div>

            </div>

            <div class="col-md-4">
                
                <div class="profile-nav alt-mejoras" style="float:left;margin-bottom:10px">
                    <section class="panel">
                        <div class="user-heading alt-mejoras clock-row .terques-bg-mejoras">
                            <h1><i class="fa fa-gears"></i> Ingenieros</h1>
                            <p class="text-left">Nivel <?php echo $mejora_ingenieros->nivel; ?></p>
                            <p class="text-left" style="font-size:12px;line-height:14px;">
                                Los ingenieros son los encargados de estudiar los STIKIS. Son capaces de optimizar el rendimiento de los STIKIS de manera que produzcan aún más beneficio </br>
                                Al subir de nivel los ingenieros, aumentará tanto el beneficio los stikis de piloto como los stikis de dinero.
                            </p>
                            <div class="cont-boton"  style="margin-top:10px"><a href="<?php echo site_url();?>gestion/ampliar_mejora/3" class="btn btn-success btn-xs" type="button"><i class="fa fa-level-up"></i> Aumentar nivel: 
                                <?php 

                                if($mejora_ingenieros)
                                {
                                    if($mejora_ingenieros->nivel<10)
                                    {
                                        $nivel = 'nivel_'.($mejora_ingenieros->nivel+1);
                                        echo es_dinero($mejora_ingenieros->$nivel)." €" ;
                                    }
                                    else
                                    {
                                        Echo "Máximo alcanzado.";
                                    }
                                }   
                                else
                                {
                                    echo "10.000 €";
                                }    
                                    
                                    ?>
                            </a></div>

                        </div>
                        

                        <ul class="nivel-mejoras">
                            <li <?php if($mejora_ingenieros->nivel >=1):?> class="active1" <?php endif;?> >
                                <span class="nivel">1</span>
                            </li>
                            <li  <?php if($mejora_ingenieros->nivel >=2):?> class="active2" <?php endif;?> >
                                <span class="nivel">2</span>
                            </li>
                            <li <?php if($mejora_ingenieros->nivel >=3):?> class="active3" <?php endif;?> >
                                <span class="nivel">3</span>
                            </li>
                            <li <?php if($mejora_ingenieros->nivel >=4):?> class="active4" <?php endif;?> >
                                <span class="nivel">4</span>
                            </li>
                            <li <?php if($mejora_ingenieros->nivel >=5):?> class="active5" <?php endif;?> >
                                <span class="nivel">5</span>
                            </li>
                            <li <?php if($mejora_ingenieros->nivel >=6):?> class="active6" <?php endif;?> >
                                <span class="nivel">6</span>
                            </li>
                            <li <?php if($mejora_ingenieros->nivel >=7):?> class="active7" <?php endif;?> >
                                <span class="nivel">7</span>
                            </li>
                            <li <?php if($mejora_ingenieros->nivel >=8):?> class="active8" <?php endif;?> >
                                <span class="nivel">8</span>
                            </li>

                            <li <?php if($mejora_ingenieros->nivel >=9):?> class="active9" <?php endif;?> >
                                <span class="nivel">9</span>
                            </li>
                            <li <?php if($mejora_ingenieros->nivel >=10):?> class="active10" <?php endif;?> >
                                <span class="nivel">10</span>
                            </li>
                        </ul>

                    </section>
                </div>

            </div>

            <div class="col-md-4">
                
                <div class="profile-nav alt-mejoras" style="float:left;">
                    <section class="panel">
                        <div class="user-heading alt-mejoras clock-row .terques-bg-mejoras">
                            <h1><i class="fa fa-money"></i> Publicistas</h1>
                            <p class="text-left">Nivel <?php echo $mejora_publicistas->nivel; ?></p>
                            <p class="text-left" style="font-size:12px;line-height:14px;">
                                Los publicistas son los encargados de conseguir patrocinios y publicidad, un adecuado nivel de publicistas hará aumentar tus ingresos rápidamente.</br>
                                Los publicistas aumentan el TOTAL de tus beneficios ecónomicos del GP.
                            </p>

                            <div class="cont-boton"  style="margin-top:10px"><a href="<?php echo site_url();?>gestion/ampliar_mejora/4" class="btn btn-success btn-xs" type="button"><i class="fa fa-level-up"></i> Aumentar nivel: 
                            <?php
                                if($mejora_publicistas)
                                { 
                                    if($mejora_publicistas->nivel<10)
                                    {
                                        $nivel = 'nivel_'.($mejora_publicistas->nivel+1);
                                        echo es_dinero($mejora_publicistas->$nivel)." €" ;
                                    }
                                    else
                                    {
                                        Echo "Máximo alcanzado.";
                                    }
                                    
                                }   
                                else
                                {
                                    echo "15.000 €";
                                }     
                                    
                                    ?>
                            </a></div>
                        </div>
                        

                        <ul class="nivel-mejoras">
                            <li <?php if($mejora_publicistas->nivel >=1):?> class="active1" <?php endif;?> >
                                <span class="nivel">1</span>
                            </li>
                            <li  <?php if($mejora_publicistas->nivel >=2):?> class="active2" <?php endif;?> >
                                <span class="nivel">2</span>
                            </li>
                            <li <?php if($mejora_publicistas->nivel >=3):?> class="active3" <?php endif;?> >
                                <span class="nivel">3</span>
                            </li>
                            <li <?php if($mejora_publicistas->nivel >=4):?> class="active4" <?php endif;?> >
                                <span class="nivel">4</span>
                            </li>
                            <li <?php if($mejora_publicistas->nivel >=5):?> class="active5" <?php endif;?> >
                                <span class="nivel">5</span>
                            </li>
                            <li <?php if($mejora_publicistas->nivel >=6):?> class="active6" <?php endif;?> >
                                <span class="nivel">6</span>
                            </li>
                            <li <?php if($mejora_publicistas->nivel >=7):?> class="active7" <?php endif;?> >
                                <span class="nivel">7</span>
                            </li>
                            <li <?php if($mejora_publicistas->nivel >=8):?> class="active8" <?php endif;?> >
                                <span class="nivel">8</span>
                            </li>

                            <li <?php if($mejora_publicistas->nivel >=9):?> class="active9" <?php endif;?> >
                                <span class="nivel">9</span>
                            </li>
                            <li <?php if($mejora_publicistas->nivel >=10):?> class="active10" <?php endif;?> >
                                <span class="nivel">10</span>
                            </li>
                        </ul>

                    </section>
                </div>

            </div>
        </div>

        <div class="row">   
            <div class="col-md-4">
                <section class="panel">

                    <table class="table table-striped table-bordered">
                        <tbody><tr><th>Nivel</th>
                        <th>Porcentaje</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        </tr><tr>
                            <td> 1</td>
                            <td> 5% </td>
                            <td>Reduce en un  5%  el precio final de compra de los Stikis</td>
                            <td> 10.000 €</td>
                        </tr>

                        <tr>
                            <td> 2</td>
                            <td> 10% </td>
                            <td>Reduce en un  10%  el precio final de compra de los Stikis</td>
                            <td> 20.000 €</td>
                        </tr>

                        <tr>
                            <td> 3</td>
                            <td> 15% </td>
                            <td>Reduce en un  15%  el precio final de compra de los Stikis</td>
                            <td> 30.000 €</td>
                        </tr>

                        <tr>
                            <td> 4</td>
                            <td> 20% </td>
                            <td>Reduce en un  20%  el precio final de compra de los Stikis</td>
                            <td> 50.000 €</td>
                        </tr>

                        <tr>
                            <td> 5</td>
                            <td> 25% </td>
                            <td>Reduce en un  25%  el precio final de compra de los Stikis</td>
                            <td> 70.000 €</td>
                        </tr>

                        <tr>
                            <td> 6</td>
                            <td> 30% </td>
                            <td>Reduce en un  30%  el precio final de compra de los Stikis</td>
                            <td> 90.000 €</td>
                        </tr>

                        <tr>
                            <td> 7</td>
                            <td> 35% </td>
                            <td>Reduce en un  35%  el precio final de compra de los Stikis</td>
                            <td> 110.000 €</td>
                        </tr>

                        <tr>
                            <td> 8</td>
                            <td> 40% </td>
                            <td>Reduce en un  40%  el precio final de compra de los Stikis</td>
                            <td> 130.000 €</td>
                        </tr>

                        <tr>
                            <td> 9</td>
                            <td> 45% </td>
                            <td>Reduce en un  45%  el precio final de compra de los Stikis</td>
                            <td> 150.000 €</td>
                        </tr>

                        <tr>
                            <td> 10</td>
                            <td> 50% </td>
                            <td>Reduce en un  50%  el precio final de compra de los Stikis</td>
                            <td> 200.000 €</td>
                        </tr>
                    </tbody></table>

                    
                </section>
            </div>

            <div class="col-md-4">
                <section class="panel">

                    <table class="table table-striped table-bordered">
            <tbody><tr><th>Nivel</th>
            <th>Porcentaje</th>
            <th>Descripción</th>
            <th>Precio</th>
            </tr><tr>
                <td> 1</td>
                <td> 5% </td>
                <td>Aumenta un  5%  el beneficio de los Stikis</td>
                <td> 10.000 €</td>
            </tr>

            <tr>
                <td> 2</td>
                <td> 10% </td>
                <td>Aumenta un  10%  el beneficio de los Stikis</td>
                <td> 20.000 €</td>
            </tr>

            <tr>
                <td> 3</td>
                <td> 15% </td>
                <td>Aumenta un  15%  el beneficio de los Stikis</td>
                <td> 30.000 €</td>
            </tr>

            <tr>
                <td> 4</td>
                <td> 20% </td>
                <td>Aumenta un  20%  el beneficio de los Stikis</td>
                <td> 40.000 €</td>
            </tr>

            <tr>
                <td> 5</td>
                <td> 25% </td>
                <td>Aumenta un  25%  el beneficio de los Stikis</td>
                <td> 60.000 €</td>
            </tr>

            <tr>
                <td> 6</td>
                <td> 30% </td>
                <td>Aumenta un  30%  el beneficio de los Stikis</td>
                <td> 80.000 €</td>
            </tr>

            <tr>
                <td> 7</td>
                <td> 35% </td>
                <td>Aumenta un  35%  el beneficio de los Stikis</td>
                <td> 120.000 €</td>
            </tr>

            <tr>
                <td> 8</td>
                <td> 40% </td>
                <td>Aumenta un  40%  el beneficio de los Stikis</td>
                <td> 160.000 €</td>
            </tr>

            <tr>
                <td> 9</td>
                <td> 45% </td>
                <td>Aumenta un  45%  el beneficio de los Stikis</td>
                <td> 200.000 €</td>
            </tr>

            <tr>
                <td> 10</td>
                <td> 50% </td>
                <td>Aumenta un  50%  el beneficio de los Stikis</td>
                <td> 250.000 €</td>
            </tr>
        </tbody></table>
        
                    
                </section>
            </div>

            <div class="col-md-4">
                <section class="panel">

                    <table class="table table-striped table-bordered">
                    <tbody><tr><th>NivelNivel</th>
                    <th>Porcentaje</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    </tr><tr>
                        <td> 1</td>
                        <td> 5% </td>
                        <td>Aumenta un  5%  el beneficio económico del GP</td>
                        <td> 15.000 €</td>
                    </tr>

                    <tr>
                        <td> 2</td>
                        <td> 10% </td>
                        <td>Aumenta un  10%  el beneficio económico del GP</td>
                        <td> 20.000 €</td>
                    </tr>

                    <tr>
                        <td> 3</td>
                        <td> 15% </td>
                        <td>Aumenta un  15%  el beneficio económico del GP</td>
                        <td> 30.000 €</td>
                    </tr>

                    <tr>
                        <td> 4</td>
                        <td> 20% </td>
                        <td>Aumenta un  20%  el beneficio económico del GP</td>
                        <td> 65.000 €</td>
                    </tr>

                    <tr>
                        <td> 5</td>
                        <td> 25% </td>
                        <td>Aumenta un  25%  el beneficio económico del GP</td>
                        <td> 100.000 €</td>
                    </tr>

                    <tr>
                        <td> 6</td>
                        <td> 30% </td>
                        <td>Aumenta un  30%  el beneficio económico del GP</td>
                        <td> 140.000 €</td>
                    </tr>

                    <tr>
                        <td> 7</td>
                        <td> 35% </td>
                        <td>Aumenta un  35%  el beneficio económico del GP</td>
                        <td> 200.000 €</td>
                    </tr>

                    <tr>
                        <td> 8</td>
                        <td> 40% </td>
                        <td>Aumenta un  40%  el beneficio económico del GP</td>
                        <td> 260.000 €</td>
                    </tr>

                    <tr>
                        <td> 9</td>
                        <td> 45% </td>
                        <td>Aumenta un  45%  el beneficio económico del GP</td>
                        <td> 350.000 €</td>
                    </tr>

                    <tr>
                        <td> 10</td>
                        <td> 50% </td>
                        <td>Aumenta un  50%  el beneficio económico del GP</td>
                        <td> 500.000 €</td>
                    </tr>
                    </tbody></table>
        
                    
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
