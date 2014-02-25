<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="<?php echo site_url(); ?>dashboard" <?php if($m_act == 1): ?> class="active" <?php endif; ?>>
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" <?php if($m_act == 2): ?> class="active" <?php endif; ?>>
                    <i class="fa fa-laptop"></i>
                    <span>Gestion Manager</span>
                </a>
                <ul class="sub">
                    <li><a href="<?php echo site_url(); ?>gestion/mi_oficina">Mi oficina</a></li>
                    <li><a href="<?php echo site_url(); ?>gestion/mis_pilotos">Mis Pilotos</a></li>
                    <li><a href="<?php echo site_url(); ?>gestion/mis_equipos">Mis Equipos</a></li>
                    <li><a href="<?php echo site_url(); ?>gestion/mis_mejoras">Panel Mejoras</a></li>
                    <li><a href="<?php echo site_url(); ?>gestion/stikis">STIKIS</a></li>
                    
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" <?php if($m_act == 3): ?> class="active" <?php endif; ?>>
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Mercado</span>
                </a>
                <ul class="sub">
                    <li><a href="<?php echo site_url(); ?>mercado/pilotos">Pilotos</a></li>
                    <li><a href="<?php echo site_url(); ?>mercado/equipos">Equipos</a></li>
                    <li><a href="<?php echo site_url(); ?>mercado/ultimos_movimientos">Mercado usuarios</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url(); ?>clasificaciones/" <?php if($m_act == 4): ?> class="active" <?php endif; ?>>
                    <i class="fa fa-bullhorn"></i>
                    <span>Clasificaciones Generales </span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="<?php echo site_url(); ?>grupos/" <?php if($m_act == 5): ?> class="active" <?php endif; ?>>
                    <i class="fa fa-users"></i>
                    <span>Grupos</span>
                </a>
                
            </li>
            <li class="sub-menu">
                <a href="<?php echo site_url(); ?>calendario/" <?php if($m_act == 6): ?> class="active" <?php endif; ?>>
                    <i class="fa fa-calendar"></i>
                    <span>Calendario</span>
                </a>
                
            </li>
            <li>
                <a href="<?php echo site_url(); ?>mensajes/" <?php if($m_act == 7): ?> class="active" <?php endif; ?>>
                    <i class="fa fa-envelope"></i>
                    <span>Mensajes </span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="<?php echo site_url(); ?>foro/" <?php if($m_act == 8): ?> class="active" <?php endif; ?>>
                    <i class=" fa fa-comment" ></i>
                    <span>Foros</span>
                </a>
                
            </li>

            <li class="sub-menu">
                <a href="<?php echo site_url(); ?>reglamento/" <?php if($m_act == 9): ?> class="active" <?php endif; ?>>
                    <i class=" fa fa-magic" ></i>
                    <span>Ayuda / Reglamento</span>
                </a>
                
            </li>
            
            
            
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->