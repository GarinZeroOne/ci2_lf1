
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body profile-information">
                       <div class="col-md-3">
                           <div class="profile-pic text-center">
                               <img src="<?php echo base_url(); ?>img/avatares/<?php echo $info_usuario['avatar']; ?>" alt="<?php echo $info_usuario['info_usuario']->nick; ?>"/>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="profile-desk">
                               <h1><?php echo $info_usuario['info_usuario']->nick; ?></h1>
                               <span class="text-muted"><?php echo $info_usuario['comunidad_usuario']; ?></span>
                               <div>
                               <p>
                                   <?php echo $info_usuario['info_usuario']->info_perfil; ?>
                               </p>
                               </div>
                               

                               <?php if($info_usuario['info_usuario']->id != $_SESSION['id_usuario']): ?>
                                   <div>
                                   <a href="#" class="btn btn-primary btn-success">Gran manager +1</a>
                                   </div>
                                <?php else: ?>
                                    <div>
                                   <a href="#" class="btn btn-primary">Editar perfil</a>
                                   </div>
                                <?php endif; ?>
                           </div>
                       </div>
                       <div class="col-md-3">
                           <div class="profile-statistics">
                               <h1><?php echo $info_usuario['posicionRanking'] ?> º</h1>
                               <p>Posición ranking General</p>
                               <h1>5.612.406 €</h1>
                               <p>Inversión compras de los últimos días</p>
                               <h1>7.120.580 €</h1>
                               <p>Ganacias ventas de los últimos días</p>
                               <ul>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-facebook"></i>
                                       </a>
                                   </li>
                                   <li class="active">
                                       <a href="#">
                                           <i class="fa fa-twitter"></i>
                                       </a>
                                   </li>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-google-plus"></i>
                                       </a>
                                   </li>
                               </ul>
                           </div>
                       </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12">
                <section class="panel">
                    <?php 
                            /*
                    <header class="panel-heading tab-bg-dark-navy-blue">
                        <ul class="nav nav-tabs nav-justified ">
                            <li class="active">
                                <a data-toggle="tab" href="#overview">
                                    Muro de <?php echo $info_usuario['info_usuario']->nick; ?>
                                </a>
                            </li>
                            
                            <li>
                                <a data-toggle="tab" href="#job-history">
                                    Job History
                                </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#contacts">
                                    Contacts
                                </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#settings">
                                    Settings
                                </a>
                            </li>
                            
                        </ul>
                    </header>
                    */
                             ?>
                    <div class="panel-body">
                        <div class="tab-content tasi-tab">
                            <div id="overview" class="tab-pane active">
                                <div class="row">
                                    <!--
                                    <div class="col-md-8">
                                        <div class="recent-act">
                                            <h1>Últimos mensajes</h1>

                                            
                                        </div>
                                    </div>
                                    -->

                                    <div class="col-md-4">

                                        <div class="prf-box">
                                            <h3 class="prf-border-head">Progresión de <?php echo $info_usuario['info_usuario']->nick; ?></h3>
                                            <div class=" wk-progress">
                                                <div class="col-md-5">Estadistica 1</div>
                                                <div class="col-md-5">
                                                    <div class="progress  ">
                                                        <div style="width: 70%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-danger">
                                                            <span class="sr-only">70% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">70%</div>
                                            </div>
                                            <div class=" wk-progress">
                                                <div class="col-md-5">Estadistica 2</div>
                                                <div class="col-md-5">
                                                    <div class="progress ">
                                                        <div style="width: 57%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                                                            <span class="sr-only">57% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">57%</div>
                                            </div>
                                            <div class=" wk-progress">
                                                <div class="col-md-5">Estadistica 3</div>
                                                <div class="col-md-5">
                                                    <div class="progress ">
                                                        <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-info">
                                                            <span class="sr-only">20% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">20%</div>
                                            </div>
                                            <div class=" wk-progress">
                                                <div class="col-md-5">Estadistica 4</div>
                                                <div class="col-md-5">
                                                    <div class="progress ">
                                                        <div style="width: 30%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                                            <span class="sr-only">30% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">30%</div>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="col-md-4">
                                        <div class="prf-box">
                                            <h3 class="prf-border-head">Comunicación Manager</h3>
                                            <div class=" wk-progress pf-status">
                                                <div class="col-md-8 col-xs-8">Mensajes en Hall of fame</div>
                                                <div class="col-md-4 col-xs-4">
                                                    <strong>32</strong>
                                                </div>
                                            </div>
                                            <div class=" wk-progress pf-status">
                                                <div class="col-md-8 col-xs-8">Mensajes comunidad</div>
                                                <div class="col-md-4 col-xs-4">
                                                    <strong>120</strong>
                                                </div>
                                            </div>
                                            <div class=" wk-progress pf-status">
                                                <div class="col-md-8 col-xs-8">Visitas perfil</div>
                                                <div class="col-md-4 col-xs-4">
                                                    <strong><?php echo $info_usuario['full_stats']['total_visitas']; ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-4">

                                        <div class="prf-box">
                                            <h3 class="prf-border-head">Últimas visitas</h3>

                                            <?php foreach($info_usuario['ultimas_visitas'] as $vuser): ?>

                                                <div class=" wk-progress tm-membr">
                                                    <div class="col-md-2 col-xs-2">
                                                        <div class="tm-avatar">
                                                            <img src="<?php echo base_url(); ?>img/avatares/<?php echo $vuser->avatar; ?>" alt=""/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 col-xs-7">
                                                        <span class="tm"><?php echo $vuser->nick; ?></span>
                                                    </div>
                                                    <div class="col-md-3 col-xs-3">
                                                        <a href="<?php echo site_url();?>perfil/ver/<?php echo $vuser->nick; ?>" class="btn btn-white">Perfil</a>
                                                    </div>
                                                </div>

                                            <?php endforeach;?>

                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- 
                                    <div class="col-md-4">

                                        <div class="prf-box">
                                            <h3 class="prf-border-head">Progresión de <?php echo $info_usuario['info_usuario']->nick; ?></h3>
                                            <div class=" wk-progress">
                                                <div class="col-md-5">Estadistica 1</div>
                                                <div class="col-md-5">
                                                    <div class="progress  ">
                                                        <div style="width: 70%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-danger">
                                                            <span class="sr-only">70% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">70%</div>
                                            </div>
                                            <div class=" wk-progress">
                                                <div class="col-md-5">Estadistica 2</div>
                                                <div class="col-md-5">
                                                    <div class="progress ">
                                                        <div style="width: 57%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                                                            <span class="sr-only">57% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">57%</div>
                                            </div>
                                            <div class=" wk-progress">
                                                <div class="col-md-5">Estadistica 3</div>
                                                <div class="col-md-5">
                                                    <div class="progress ">
                                                        <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-info">
                                                            <span class="sr-only">20% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">20%</div>
                                            </div>
                                            <div class=" wk-progress">
                                                <div class="col-md-5">Estadistica 4</div>
                                                <div class="col-md-5">
                                                    <div class="progress ">
                                                        <div style="width: 30%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                                            <span class="sr-only">30% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">30%</div>
                                            </div>
                                        </div>

                                        <div class="prf-box">
                                            <h3 class="prf-border-head">Comunicación Manager</h3>
                                            <div class=" wk-progress pf-status">
                                                <div class="col-md-8 col-xs-8">Mensajes en Hall of fame</div>
                                                <div class="col-md-4 col-xs-4">
                                                    <strong>32</strong>
                                                </div>
                                            </div>
                                            <div class=" wk-progress pf-status">
                                                <div class="col-md-8 col-xs-8">Mensajes comunidad</div>
                                                <div class="col-md-4 col-xs-4">
                                                    <strong>120</strong>
                                                </div>
                                            </div>
                                            <div class=" wk-progress pf-status">
                                                <div class="col-md-8 col-xs-8">Visitas perfil</div>
                                                <div class="col-md-4 col-xs-4">
                                                    <strong><?php echo $info_usuario['full_stats']['total_visitas']; ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="prf-box">
                                            <h3 class="prf-border-head">Últimas visitas</h3>

                                            <?php foreach($info_usuario['ultimas_visitas'] as $vuser): ?>

                                                <div class=" wk-progress tm-membr">
                                                    <div class="col-md-2 col-xs-2">
                                                        <div class="tm-avatar">
                                                            <img src="<?php echo base_url(); ?>img/avatares/<?php echo $vuser->avatar; ?>" alt=""/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 col-xs-7">
                                                        <span class="tm"><?php echo $vuser->nick; ?></span>
                                                    </div>
                                                    <div class="col-md-3 col-xs-3">
                                                        <a href="<?php echo site_url();?>perfil/ver/<?php echo $vuser->nick; ?>" class="btn btn-white">Perfil</a>
                                                    </div>
                                                </div>

                                            <?php endforeach;?>

                                            
                                        </div>
                                    </div>
                                -->
                                </div>
                            </div>
                            <div id="job-history" class="tab-pane ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="timeline-messages">
                                            <h3>Take a Tour</h3>
                                            <!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            13 January 2013
                                                        </div>
                                                        <div class="second bg-terques ">
                                                            Join as Product Asst. Manager
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->

                                            <!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            1 January 2012
                                                        </div>
                                                        <div class="second bg-red">
                                                            Completed Provition period and Appointed as a permanent Employee
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->

                                            <!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            1 January 2011
                                                        </div>
                                                        <div class="second bg-purple">
                                                            Selected Employee of the Month
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->

                                            <!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            1 January 2010
                                                        </div>
                                                        <div class="second bg-green">
                                                            Got Promotion and become area manager of California
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->
                                            <!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            1 January 2009
                                                        </div>
                                                        <div class="second bg-yellow">
                                                            Selected the Best Employee of the Year 2013 and was awarded
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->

                                            <!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            1 January 2008
                                                        </div>
                                                        <div class="second bg-terques">
                                                            Got Promotion and become Product Manager and was transper from Branch to Head Office. Lorem ipsum dolor sit amet
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->
                                            <!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            1 January 2007
                                                        </div>
                                                        <div class="second bg-blue">
                                                            Height Sales scored and break all of the previous sales record ever in the company. Awarded
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->
                                            <!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            1 January 2006
                                                        </div>
                                                        <div class="second bg-green">
                                                            Take 15 days leave for his wedding and Honeymoon & Christmas
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="contacts" class="tab-pane ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="prf-contacts">
                                            <h2> <span><i class="fa fa-map-marker"></i></span> location</h2>
                                            <div class="location-info">
                                                <p>Postal Address<br>
                                                    PO Box 16122 Collins Street West<br>
                                                    Victoria 8007 Australia</p>
                                                <p>Headquarters<br>
                                                    121 King Street, Melbourne<br>
                                                    Victoria 3000 Australia</p>
                                            </div>
                                            <h2> <span><i class="fa fa-phone"></i></span> contacts</h2>
                                            <div class="location-info">
                                                <p>Phone    : +61 3 8376 6284 <br>
                                                    Cell        : +61 3 8376 6284</p>
                                                <p>Email        : david@themebucket.net<br>
                                                    Skype       : david.rojormillan</p>
                                                <p>
                                                    Facebook    : https://www.facebook.com/themebuckets <br>
                                                    Twitter : https://twitter.com/theme_bucket
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!--location goes here-->
                                    </div>
                                </div>
                            </div>
                            <div id="settings" class="tab-pane ">
                                <div class="position-center">
                                    <div class="prf-contacts sttng">
                                        <h2>  Personal Information</h2>
                                    </div>
                                    <form role="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label"> Avatar</label>
                                            <div class="col-lg-6">
                                                <input type="file" id="exampleInputFile" class="file-pos">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Company</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="c-name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Lives In</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="lives-in" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Country</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="country" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Description</label>
                                            <div class="col-lg-10">
                                                <textarea rows="10" cols="30" class="form-control" id="" name=""></textarea>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="prf-contacts sttng">
                                        <h2> socail networks</h2>
                                    </div>
                                    <form role="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Facebook</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="fb-name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Twitter</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="twitter" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Google plus</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="g-plus" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Flicr</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="flicr" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Youtube</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="youtube" class="form-control">
                                            </div>
                                        </div>

                                    </form>
                                    <div class="prf-contacts sttng">
                                        <h2>Contact</h2>
                                    </div>
                                    <form role="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Address 1</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="addr1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Address 2</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="addr2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Phone</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="phone" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Cell</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="cell" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Email</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Skype</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="skype" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-primary" type="submit">Save</button>
                                                <button class="btn btn-default" type="button">Cancel</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->