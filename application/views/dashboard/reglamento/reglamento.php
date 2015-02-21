
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <!--collapse start-->
                        <div id="accordion" class="panel-group m-bot20">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
                                            Introduccion a la Liga Formula 1 
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseOne" style="height: 0px;">
                                    <div class="panel-body">
                                        <p>Liga  Formula 1 es un Juego/Manager web orientado y basado en los resultados reales de la Formula 1 creado por y para Fans del deporte rey del motor.</p>
                                        <p><strong>¿Quien puede participar en  la liga Formula 1?</strong> Todo aquel que quiera! LigaFormula1.com es y será siempre una plataforma de entretenimiendo gratuita, una comunidad de aficionados a la Formula 1, que pueden utilizar este servicio para medir sus conocimientos contra todos los usuarios registrados, conocer gente y estar al dia de todo lo que rodea  este deporte o generar grupos privados y competir contra sus amigos en las clasicas  "porras".</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
                                            Dashboard
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseTwo" style="height: 0px;">
                                    <div class="panel-body">
                                        <p>El <strong>Dashboard</strong> es tu pantalla de bienvenida, donde siempre que entres verás que ha sucedido, como estan los valores del mercado actualmente y otra información de interes.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
                                            Pilotos y Equipos
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseThree">
                                    <div class="panel-body">
                                        <?php /* 
                                        <p>Este año se ha introducido un mercado de pilotos y equipos con valores variables. <strong>No hay penalización por vender pilotos o equipos</strong>. Tanto los pilotos como los equipos variaran su valor a diario, en  función de las compras/ventas e inactividad que hayan tenido el dia anterior. La inactividad se da cuando un piloto o equipo no recibe compras ni ventas durante un dia.</p>
                                        <p>El precio de los pilotos y equipos también variará a consecuencia de sus resultados en carrera. Por lo general se aumentará el precio de pilotos y equipos que mejoren su posición esperada (posición de clasificacion general) y se bajará cuando su posición en el gp sea inferior.La cantidad  de aumento o disminución del precio dependerá de los puestos ganados o perdidos.</p>

                                        <p>Los pilotos se compran o alquilan desde el mercado. Desde  aquí podrás ver su valor actual, tanto de fichaje como de alquiler así  como los valores anteriores y los historicos máximos y minimos de cada piloto o equipo.</p>

                                        <p><strong>Haciendo click sobre  el nombre de piloto o equipo accederas a su ficha</strong>, donde podrás ver más información y todo su histórico en modo gráfica.</p>

                                        <p> <strong>Puedes tener un máximo de 7 pilotos y 5 equipos.</strong> </p>
                                        <p>Los pilotos alquilados  solo correrán para  ti el siguiente  gran premio. Una vez terminado el gran premio, te llevarás el dinero y puntos conseguidos por el piloto y este desaparecerá de tu lista  de pilotos, hasta que vuelvas  a ficharlo o alquilarlo. <strong>Los pilotos alquilados NO pueden llevar STIKIS ni podrán aprovechar las mejoras que tengas</strong>. El precio de alquiler de los pilotos  es  del <strong>10%</strong> de su valor actual, esto quiere decir que  si un piloto baja de valor, bajará  tanto su valor de fichaje como su  valor de alquiler y lo mismo ocurre si sube de valor. Siempre respetandose la proporción del 10% respecto al precio de fichaje.</p>

                                        <p><strong>¿Puedo especular con los pilotos?</strong> Por supuesto! Esa  es la gracia del mercado. Intentar adivinar  que piloto  subirá de valor, comprarlo el mismo dia y venderlo después para obtener beneficios. Desde la ficha de tus pilotos, podrás ver  siempre el precio que pagaste por el piloto, y el <strong>beneficio</strong> que obtendrias si lo vendieras en ese momento. Obviamente el beneficio que obtendras especulando con pilotos alquilados sera bajo, puesto que al ser siempre un 10% del valor de fichaje, las cantidades no seran tan altas como si especulas fichando pilotos, pero el riesgo también  será mas bajo!</p>
                                        <p><strong>Los pilotos fichados, formarán parte de tu plantilla hasta que tu decidas venderlos</strong>.  Puedes colocarles STIKIS y podrán aprovecharse  de todas las mejoras que  tengas.</p>
                                        <p>LF1 se guarda el derecho de modificar los valores de pilotos y equipos con el fin de corregir cualquier tipo de desfase en los precios.Si esto ocurre se notificará a los usuarios para  que todos esten al tanto de todas las modificaciones.</p>
                                    */ ?>
                                        <ul class="lista-reglas">
                                            <li>Puedes alquilar o fichar pilotos, los equipos no se pueden alquilar.</li>
                                            <li>Un piloto alquilado correrá para  ti un GP y luego desaparecerá de tu lista de pilotos.</li>
                                            <li>Un piloto fichado, permanecerá en tu equipo hasta que decidas venderlo.</li>
                                            <li>Los pilotos alquilados no pueden llevar STIKIS ni son afectados por ninguna de las mejoras.</li>
                                            <li>Los pilotos fichados pueden llevar  STIKIS y les afectan todas  las mejoras.</li>
                                            <li>Puedes tener un  máximo de 7 pilotos, entre fichados y alquilados.</li>
                                            <li>Puedes tener un máximo de 5 equipos.</li>
                                            <li>No existe penalización por la venta de pilotos al sistema.Se venderá por el precio actual del mercado.</li>
                                            <li>El precio de los pilotos y equipos varia a diario en función de sus  movimientos en el mercado.</li>
                                            <li>El precio de los pilotos y  equipos variará despues de cada GP en base a sus resultados.</li>
                                            <li>Puedes acceder a la ficha de un piloto o equipo haciendo click en su  nombre.</li>
                                            <li>Se pueden fichar y vender pilotos como equipos tantas veces se quiera.</li>

                                        </ul>

                                        <h4>Mejora Pilotos por RESULTADOS</h4>
                                        <table class="table table-striped table-bordered">
                                                <th>Posiciones Ganadas</th>
                                                
                                                <th>Porcentaje de mejora</th>
                                                <?php foreach($mejora_pilotos as $mp): ?>
                                                    <tr>
                                                        <td><?php echo $mp->num_puestos; ?></td>
                                                        <td><?php echo $mp->porcentaje; ?> %</td>
                                                    </tr>
                                                <?php endforeach; ?>

                                        </table>

                                        <h4>Mejora Equipos por RESULTADOS</h4>
                                        <table class="table table-striped table-bordered">
                                                <th>Posiciones Ganadas</th>
                                                
                                                <th>Porcentaje de mejora</th>
                                                <?php foreach($mejora_equipos as $me): ?>
                                                    <tr>
                                                        <td><?php echo $me->num_puestos; ?></td>
                                                        <td><?php echo $me->porcentaje; ?> %</td>
                                                    </tr>
                                                <?php endforeach; ?>

                                        </table>

                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseFour" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
                                            FIN DE SEMANA DE GP
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseFour">
                                    <div class="panel-body">
                                        
                                        <ul class="lista-reglas">
                                            <li>El Fin  de Semana de GP comienza la medianoche del viernes al sabado de un fin de semana  de Gran Premio.</li>
                                            <li>El mercado y  cualquier tipo de gestión quedan bloqueados hasta el final del Fin de Semana de GP.</li>
                                            <li>La cuenta atrás del Dashboard indica el tiempo que falta hasta el próximo cierre de mercado.</li>
                                            

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseFive" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
                                            MEJORAS
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseFive">
                                    <div class="panel-body">
                                        <ul class="lista-reglas">
                                            
                                            <li>Las mejoras afectan solo a los pilotos FICHADOS.</li>
                                            <li>Existen 3 tipos de mejoras: Mecánicos,Ingenieros y Publicistas.</li>
                                            <li>Se puede acceder al panel de mejoras desde el menú Gestión Manager > Panel Mejoras</li>                                          
                                            <li>Cada mejora tiene 10 niveles.</li>
                                            <li>Las mejoras no caducan nunca, ni se pueden vender. Son reseteadas tan solo al inicio de una nueva temporada.</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseSix" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
                                            GRUPOS
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseSix">
                                    <div class="panel-body">
                                        <ul class="lista-reglas">
                                            
                                            <li>Cualquier usuario puede crear grupos publicos o privados.</li>
                                            <li>Cualquier usuario puede ingresar en los grupos públicos</li>
                                            <li>Para ingresar a un grupo privado, tendrás  que enviarle tu código de manager al creador del grupo.</li>
                                            <li>Para conocer cual es tu código manager, tan solo tienes  que entrar en tu perfil desde Menu usuario > Perfil</li>
                                            <li>Al entrar en Grupos, verás todos los grupos a los que perteneces y el listado de grupos públicos.</li>
                                            <li>Dentro de cada grupo, podrás ver la clasificación general del grupo y la clasificación del último Gran Premio disputado</li>
                                            <li>Cada grupo tiene su propio sistema de mensajes.</li>
                                            <li>Puedes citar un mensaje escrito en tu grupo, de manera que al usuario que lo escribió le llegará una notificación de "mención".</li>
                                            <li>Para citar un mensaje del grupo, escribe <i>#numero-del-mensaje</i>. Por ejemplo: <i>"Estoy citando el mensaje #32 :)"</i>, al usuario que escribió el mensaje #32 le llegará una notificación de mención.</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseSeven" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
                                            TUS FONDOS
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseSeven">
                                    <div class="panel-body">
                                       <p>Tus fondos son la parte más importante como manager. Empezarás con una base de <strong>250.000 €</strong> con la que tendrás que empezar a construir tu carrera como Manager. Si te registras con la liga ya comenzada, con algun GP ya computado, además de los 250.000 € iniciales, recibirás 50.000 € más por GP pasado.</p>

                                       <p>Mantener tu economia saneada tambien te otorgará puntos extra al final de cada gran premio, así como una mala gestion repercutirá en forma de puntos negativos. Esto solo ocurre cuando inicias un fin de semana de Carrera con números negativos.</p>

                                       <p>Puedes quedarte en numeros negativos hasta un máximo de -200.000 € .</p>
                                       <p>En la siguiente tabla puedes ver los puntos otorgados dependiendo de tus fondos:</p>
                                       
                                        <!-- Tabla datos banco-->
                                        
                                        

                                        <ul class="banco">
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 5.000.000 <?php echo $this->lang->line('reglas_s_y'); ?> 10.000.000 € : 25 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 4.000.000 <?php echo $this->lang->line('reglas_s_y'); ?> 5.000.000 € : 22 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 3.000.000 <?php echo $this->lang->line('reglas_s_y'); ?> 4.000.000 € : 18 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 2.000.000 <?php echo $this->lang->line('reglas_s_y'); ?> 3.000.000 € : 15 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 1.000.000 <?php echo $this->lang->line('reglas_s_y'); ?> 2.000.000 € : 12 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 800.000 <?php echo $this->lang->line('reglas_s_y'); ?> 1.000.000 € : 10 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 600.000 <?php echo $this->lang->line('reglas_s_y'); ?> 800.000 € : 7 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 400.000 <?php echo $this->lang->line('reglas_s_y'); ?> 600.000 € : 5 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 200.000 <?php echo $this->lang->line('reglas_s_y'); ?> 400.000 € : 4 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 50.000 <?php echo $this->lang->line('reglas_s_y'); ?> 200.000 € : 2 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> 0 <?php echo $this->lang->line('reglas_s_y'); ?> 50.000 € : 1 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> -50.000 <?php echo $this->lang->line('reglas_s_y'); ?> 0 € : -2 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> -100.000 <?php echo $this->lang->line('reglas_s_y'); ?> -50.000 € : -4 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> -150.000 <?php echo $this->lang->line('reglas_s_y'); ?> -100.000 € : -6 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                            <li> <?php echo $this->lang->line('reglas_s_entre'); ?> -200.000 <?php echo $this->lang->line('reglas_s_y'); ?> -150.000 € : -8 <?php echo $this->lang->line('reglas_s_pm'); ?></li>
                                        </ul>
                                        <!-- Tabla datos banco-->

                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseEight" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
                                            PUNTUACIONES Y DINERO
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseEight">
                                    <div class="panel-body">
                                        <h4>Puntuaciones y dinero Pilotos</h4>
                                        <table class="table table-striped table-bordered">
                                            <th>Pos</th>
                                            <th>Puntos</th>
                                            <th>Dinero</th>
                                            <?php foreach($premios_pilotos as $premiop): ?>
                                                <tr>
                                                    <td><?php echo $premiop->posicion; ?>º</td>
                                                    <td><?php echo $premiop->puntos_manager; ?></td>
                                                    <td><?php echo es_dinero($premiop->dinero); ?>€</td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </table>

                                    <h4>Puntuaciones y dinero Equipos</h4>
                                    <table class="table table-striped table-bordered">
                                            <th>Pos</th>
                                            <th>Puntos</th>
                                            <th>Dinero</th>
                                            <?php foreach($premios_equipos as $premioe): ?>
                                                <tr>
                                                    <td><?php echo $premioe->posicion; ?>º</td>
                                                    <td><?php echo $premioe->puntos_manager; ?></td>
                                                    <td><?php echo es_dinero($premioe->dinero); ?>€</td>
                                                </tr>
                                            <?php endforeach; ?>

                                    </table>

                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseNine" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
                                            HALL OF FAME
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseNine">
                                    <div class="panel-body">
                                        
                                        <ul class="lista-reglas">
                                            
                                            <li>Hall of fame es un muro de información al que todos los managers tienen acceso y pueden colocar  ahí sus  ideas y opiniones.</li>
                                            <li>Normalmente el hall of fame tendrá un tema o pregunta  sobre el que enfocar las respuestas.</li>
                                            <li>Para ingresar a un grupo privado, tendrás  que enviarle tu código de manager al creador del grupo.</li>
                                            <li>Puedes indicar  que te gusta la respuesta de otro manager haciendo  click en el icono <i class="fa fa-thumbs-up voto-manager" title="Me gusta este comentario" ></i></li>
                                            <li>Al lado del nick de cada manager podrás ver los votos que ha recibido. <i style="color:#B1C697">+12</i> <i class="fa fa-thumbs-up voto-manager" title="Me gusta este comentario" data-hofid="49"></i></li>
                                          

                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--collapse end-->
                    </div>
                </div>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
