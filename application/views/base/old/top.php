<body>




    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" style="z-index: 0; padding: 0px; background-color: rgba(1, 1, 1, 0);">

          <?php
            if( $_SESSION['id_usuario']):
          ?>
             <?php if(($saldo>=0) ): ?>
                  <div class="miSaldo" style="background-color: #263958;">
                    Saldo: <span><?php echo $saldo; ?> €</span>
                  </div>
            <?php endif; ?>

            <?php if(($saldo<0) ): ?>
                        <div class="miSaldo" style="background-color: #632727;">
                          Saldo: <span><?php echo $saldo; ?> €</span>
                        </div>
            <?php endif; ?>

          <?php endif; ?>

          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"> <img src="<?php echo base_url(); ?>/img/logotop.png" />Liga Formula 1</a>
          <div class="nav-collapse">

            <?php
            if( $_SESSION['id_usuario']):
            ?>



                <ul class="nav">

                     <li  <?php if($m_act==1): ?> class="active" <?php endif; ?>><? echo anchor('/inicio',$this->lang->line('menu_inicio'));?></li>
                     <li <?php if($m_act==5): ?> class="active" <?php endif; ?>><? echo anchor('/ranking/general',$this->lang->line('menu_ranking_general'));?></li>
                     <li <?php if($m_act==6): ?> class="active" <?php endif; ?>><? echo anchor('/ranking/gp',$this->lang->line('menu_ranking_gp'));?></li>
                     <li <?php if($m_act==7): ?> class="active" <?php endif; ?>><? echo anchor('/boxes',$this->lang->line('menu_boxes'));?></li>
                   <li <?php if($m_act==8): ?> class="active" <?php endif; ?>><? echo anchor('/calendario',$this->lang->line('menu_calendario'));?> </li>
                     <li <?php if($m_act==3): ?> class="active" <?php endif; ?>><? echo anchor('/inicio/reglas',$this->lang->line('menu_reglas'));?></li>
                     <li <?php if($m_act==9): ?> class="active" <?php endif; ?>><? echo anchor('/foro/indice',$this->lang->line('menu_foro'));?></li>
                     <li <?php if($m_act==10): ?> class="active" <?php endif; ?>><? echo anchor('/inicio/logout',$this->lang->line('menu_salir').' ['.$_SESSION['usuario'  ].']');?>  </li>
                </ul>

            <?php
            else:
            ?>
                <ul class="nav">
                  <li <?php if($m_act==1): ?> class="active" <?php endif; ?>><? echo anchor('/inicio',$this->lang->line('menu_inicio'));?></li>
                  <li <?php if($m_act==2): ?> class="active" <?php endif; ?>><? echo anchor('/alta',$this->lang->line('menu_alta'));?> </li>
                  <li <?php if($m_act==3): ?> class="active" <?php endif; ?>><? echo anchor('/inicio/reglas',$this->lang->line('menu_reglas'));?> </li>
                  <li <?php if($m_act==9): ?> class="active" <?php endif; ?>><? echo anchor('/foro/indice',$this->lang->line('menu_foro'));?></li>
                  <li <?php if($m_act==4): ?> class="active" <?php endif; ?>>
                    <!--<a data-toggle="modal" href="#myModal" ><?php echo $this->lang->line('menu_login') ?></a> -->
                    <?php echo anchor('/inicio/login',$this->lang->line('menu_login')) ?>
                  </li>
                </ul>
            <?php
            endif;
            ?>



          </div><!--/.nav-collapse -->


          <div id="lang">
            <a href="<?php echo site_url();?>inicio/change/spanish"> <img src="<?php echo base_url() ?>img/flags/es.gif">  </a>
            <a href="<?php echo site_url();?>inicio/change/english"> <img src="<?php echo base_url() ?>img/flags/gb.gif">  </a>
          </div>


        </div>

      </div>
    </div>

    <div class="container">