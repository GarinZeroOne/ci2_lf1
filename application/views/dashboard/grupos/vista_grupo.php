
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        
        <!-- Migas -->
        <div class="row">
            <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>grupos"><i class="fa fa-home"></i> Grupos</a></li>
                        <li class="active"><a href="#"> Baratxoko</a></li>
                    </ul>
                    <!--breadcrumbs end -->

                    <?php if($this->session->flashdata('msg_bienvenida')): ?>
                    <div class="alert alert-success fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Ya estás dentro!</strong> <?php echo $this->session->flashdata('msg_bienvenida'); ?>
                    </div>
                    <?php endif; ?>
            </div>
        </div>
        
        <?php /******************************* SOLO PARA NO MIEMBROS DEL GRUPO **************************/ ?>
        <?php if(!$soy_miembro): ?>

        <div class="row">
            
            <!-- Cabecera grupo -->
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body profile-information">
                       <div class="col-md-6 col-xs-6">
                           <div class="profile-pic text-center">
                               <?php if($grupo_info->imagen): ?>
                               <img alt="" src="<?php echo base_url(); ?>img/grupos/<?php echo $grupo_info->imagen; ?>">
                                <?php else: ?>
                                    <img alt="" src="<?php echo base_url(); ?>img/grupos/noimage.png">
                                <?php endif; ?>
                           </div>
                       </div>
                       <div class="col-md-6 col-xs-6">
                           <div class="profile-desk">
                               <h1><?php echo $grupo_info->nombre; ?></h1>
                               <span class="text-muted" style="display:block;">Admin <?php echo $grupo_info->nick; ?></span>
                               <p>
                                <?php if($grupo_info->descripcion): ?>
                                   <?php echo $grupo_info->descripcion; ?>
                                <?php else: ?>
                                    <i>No se ha introducido ninguna descripción.</i>
                                <?php endif; ?>
                               </p>
                                
                                
                                <div>
                                <?php if(!$grupo_info->privado): ?>
                                    <a class="btn btn-primary" href="<?php echo site_url(); ?>grupos/ingresar/<?php echo $idGrupo; ?>">Entrar al grupo</a>
                                <?php else: ?>
                                    <a class="btn btn-primary" href="#">Grupo privado</a>
                                <?php endif; ?>
                                </div>

                           </div>
                       </div>
                       <div class="col-md-6 col-xs-12">
                           <div class="profile-statistics">
                               <h1><?php echo $num_usuarios; ?> miembros</h1>
                               
                               <p></p>
                               
                           </div>
                       </div>
                    </div>
                </section>

                


            </div>
            
        </div>    
        
        <?php /******************************* SOLO PARA MIEMBROS DEL GRUPO **************************/ ?>
        <?php else: ?>


        <div class="row">
            
            <!-- Cabecera grupo -->
            <div class="col-md-6">
                <section class="panel">
                    <div class="panel-body profile-information">
                       <div class="col-md-6 col-xs-6">
                           <div class="profile-pic text-center">
                            <?php if($grupo_info->imagen): ?>
                               <img alt="" src="<?php echo base_url(); ?>img/grupos/<?php echo $grupo_info->imagen; ?>">
                            <?php else: ?>
                                <img alt="" src="<?php echo base_url(); ?>img/grupos/noimage.png">
                            <?php endif; ?>
                           </div>
                       </div>
                       <div class="col-md-6 col-xs-6">
                           <div class="profile-desk">
                               <h1><?php echo $grupo_info->nombre; ?></h1>
                               <span class="text-muted" style="display:block;">Admin <?php echo $grupo_info->nick; ?></span>
                               <p>
                                <?php if($grupo_info->descripcion): ?>
                                   <?php echo $grupo_info->descripcion; ?>
                                <?php else: ?>
                                    <i>No se ha introducido ninguna descripción.</i>
                                <?php endif; ?>
                               </p>
                                
                                <div>
                                <?php if($_SESSION['id_usuario'] == $grupo_info->id_usuario_creador): ?>
                                    <a class="btn btn-primary" href="<?php echo site_url(); ?>grupos/configurar_grupo/<?php echo $idGrupo; ?>">Configurar grupo</a>
                                
                                
                                <?php else: ?>
                                    <a class="btn btn-primary btn-danger confirm" href="<?php echo site_url(); ?>grupos/abandonar/<?php echo $idGrupo; ?>">Abandonar grupo</a>
                                <?php endif; ?>
                                </div>

                           </div>
                       </div>
                       <div class="col-md-6 col-xs-12">
                           <div class="profile-statistics">
                               <h1><?php echo $num_usuarios; ?> miembros</h1>
                               
                               <p></p>
                               
                           </div>
                       </div>
                    </div>
                </section>

                


            </div>
            
            <div class="col-md-6">
                <section class="panel">
                    <div class="panel-body">
                    <div class="chat-conversation">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 360px;">
                            <ul id="conversation-list" class="conversation-list" style="overflow: hidden; width: auto; height: 360px;">
                                
                    
                            <?php 
                                $cargar_mas = true;
                            ?>
                            <?php foreach($ultMensajes as $mensaje): ?>

                                <?php if($cargar_mas):?>   
                                  <li><button class="btn btn-success btn-block" data-internal="<?php echo $mensaje->id_mensaje; ?>" id="cargar-anteriores-btn"> Cargar mensajes anteriores </button></li>
                                <?php $cargar_mas = false; ?>  
                                <?php endif; ?>

                                <?php if($_SESSION['id_usuario'] == $mensaje->id_usuario): ?>
                                <li class="clearfix odd2">
                                    <div class="chat-avatar">
                                        <img alt="avatar" width="40" src="<?php echo base_url(); ?>/img/avatares/thumbs/<?php echo $mensaje->avatar; ?>">
                                        <i><?php echo timeago(strtotime($mensaje->fecha_mensaje)); ?></i>
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                              <i><a class="num-msg-grp" onclick="citar(this)" data-msg-internal="<?php echo $mensaje->id_mensaje_grupo;  ?>" src="#">#<?php echo $mensaje->id_mensaje_grupo;?></a> <?php echo $mensaje->nick; ?></i>
                                            <p>
                                                <?php echo $mensaje->contenido; ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>

                                <?php else: ?>
                                <li class="clearfix">
                                    <div class="chat-avatar">
                                        <img alt="avatar" width="40" src="<?php echo base_url(); ?>/img/avatares/thumbs/<?php echo $mensaje->avatar; ?>">
                                        <i><?php echo timeago(strtotime($mensaje->fecha_mensaje)); ?></i>
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <i><a class="num-msg-grp-b" onclick="citar(this)" data-msg-internal="<?php echo $mensaje->id_mensaje_grupo;  ?>" src="#">#<?php echo $mensaje->id_mensaje_grupo;?></a> <?php echo $mensaje->nick; ?></i>
                                            <p>
                                                <?php echo $mensaje->contenido; ?>  
                                            </p>
                                        </div>
                                    </div>
                                </li>

                                <?php endif; ?>
                                
                                


                             <?php endforeach; ?>
                            
                        </ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 360px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                        <div class="row">
                            <div class="col-xs-9">
                                <input type="text" id="chat-text" placeholder="Esbribe tu texto aqui" class="form-control chat-input" >
                            </div>
                            <div class="col-xs-3 chat-send">
                                <button class="btn btn-default" type="submit" id="submit-comment" data-gi="<?php echo $idGrupo; ?>">Enviar</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </section>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-12 col-lg-6">
                <section class="panel">
                <header class="panel-heading">
                    Clasificación general
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        
                     </span>
                </header>
                <div class="panel-body">
                    
                    <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>Manager</th>
                                    <th class="numeric">Puntos</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $j = 0;
                                foreach ($rankingGeneral as $linea) {
                                    $j++;
                                    if (strtolower($_SESSION['usuario']) == strtolower($linea->nick)):
                                        ?>
                                        <tr>
                                            <td class="posicion"><b style="color:#ff0000;"><? echo $j ?>º</b></td>
                                            <td width="20"><img src="<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" class="round-pilots" /></td>
                                            <td class="nick"><b style="color:#ff0000;"><? echo anchor('usuarios/perfil/'.$linea->nick,$linea->nick);  ?></b></td>
                                            <td class="puntos"><b style="color:#ff0000;"><? echo $linea->puntos; ?></b></td>
                                        </tr>
                                    <? else: ?>
                                                <tr>
                                                    <td class="posicion"><?= $j ?>º</td>
                                                    <td width="20"><img  src="<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" class="round-pilots" /></td>
                                                    <td class="nick"><? echo anchor('usuarios/perfil/'.$linea->nick,$linea->nick);  ?></td>
                                                    <td class="puntos"><? echo $linea->puntos; ?></td>
                                                </tr>
                                            <?
                                        endif;
                                        }
                                        ?>
                                </tbody>
                            </table>

                    
                    
                </div>    
                </section>
            </div>

            <div class="col-sm-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <? echo  'Clasificación '
                . $datosGP->circuito . ' (' . $datosGP->pais . ')';
                ?>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            
                         </span>
                    </header>

                    <div class="panel-body">
                       
                       <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>Manager</th>
                                    <th class="numeric">Puntos</th>
                                </tr>
                                </thead>
                                <tbody>
                            <?php
                            $i = 0;
                            foreach ($rankingGP as $linea):
                                $i++;
                                if (strtolower($_SESSION['usuario']) == strtolower($linea->nick)):
                                    ?>
                                    <tr>
                                        <td class="posicion"><b style="color:#ff0000;"><? echo $i; ?>º</b></td>
                                        <td><img  class="round-pilots" src= "<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" /></td>
                                        <td class="nick"><b style="color:#ff0000;"><? echo anchor('usuarios/perfil/'.$linea->nick,$linea->nick);  ?></b></td>
                                        <td class="puntos"><b style="color:#ff0000;"><? echo $linea->puntos_manager_gp ?></b></td>
                                    </tr>
                                <? else: ?>
                                            <tr>
                                                <td class="posicion"><? echo $i; ?>º</td>
                                                <td><img class="round-pilots" src="<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" /></td>
                                                <td class="nick"><? echo anchor('usuarios/perfil/'.$linea->nick,$linea->nick);  ?></td>
                                                <td class="puntos"><?= $linea->puntos_manager_gp ?></td>
                                            </tr>
                                        <?
                                        endif;
                                    endforeach;
                                    ?>
                            </tbody>
                        </table>

                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->

        <?php endif; ?>

        </section>
    </section>
    <!--main content end-->
