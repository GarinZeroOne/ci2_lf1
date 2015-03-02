
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-8">
                <section class="panel">
                <div class="road">
                    <canvas>Necesitas actualizar tu navegador para usar el  simulador</canvas>
                </div>
                </section>
            </div>

            <div class="col-md-4 hidden-sm">
                               
                <!--Ultimos fichajes start-->
                <section class="panel">
                    <header class="panel-heading">
                        Publicidad
                        
                    </header>
                    <div class="panel-body">
                        <div align="center">
                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- Cuadrado2014display -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:250px"
                                 data-ad-client="ca-pub-2361705659034560"
                                 data-ad-slot="9275287139"></ins>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    </div>
                </section>
                <!--Ultimos fichajes end-->
                
            </div>

        </div>
        <div class="row">
            
            <div class="col-md-5">
                <section class="panel">
                    <header class="panel-heading-stiki">
                        Simulador de carrera
                        
                    </header>
                    <div class="panel-body-stiki">   
                        <p>En el simulador de carreras puedes  comprobar de manera  visual el pronóstico de la siguiente carrera. El simulador otorga a cada piloto un valor basandose en sus resultados de los ultimos años en el Gran Premio que toque cada semana.</p>
                        <p>Hay pilotos a los que se les dan  especialmente  bien ciertos circuitos, y es una buena oportunidad para ficharlos, con el simulador tendras una vision aproximada del rendimiento que se espera de cada piloto.</p>

                        <p>Otro factor que afecta al simulador es la escuderia del piloto. No es lo mismo ir con un Mercedes que con un Marussia, tampoco todos los coches se adaptan igual a todos los circuitos y durante la temporada su rendimiento va variando. Por todo esto tienes la posibilidad de ir ajustando a tu gusto o conocimientos el valor de potencia de cada escuderia, de manera que se vea afectada en la simulación.</p>
                    </div>
                </section>    
            </div>
            

            <div class="col-sm-3">
                
                <section class="panel">
                    <header class="panel-heading">
                        Configurador de motores
                        
                    </header>
                    <div class="panel-body">
                        <div class="controls">
                            <ul>
                                <li><span class="motor">Mercedes</span><input type="range" min="1" max="40" value="25" id="mercedes"></li>
                                    <li><span class="motor">redbull</span><input type="range" min="1" max="40" value="18" id="redbull"></li>
                                    <li><span class="motor">williams</span><input type="range" min="1" max="40" value="16" id="williams"></li>
                                    <li><span class="motor">ferrari</span><input type="range" min="1" max="40" value="20" id="ferrari"></li>
                                    <li><span class="motor">mclaren</span><input type="range" min="1" max="40" value="20" id="mclaren"></li>
                                    <li><span class="motor">forceindia</span><input type="range" min="1" max="40" value="18" id="forceindia"></li>
                                    <li><span class="motor">toro rosso</span><input type="range" min="1" max="40" value="16" id="tororoso"></li>
                                    <li><span class="motor">lotus</span><input type="range" min="1" max="40" value="17" id="lotus"></li>
                                    <li><span class="motor">marussia</span><input type="range" min="1" max="40" value="15" id="marussia"></li> 
                                    <li><span class="motor">sauber</span><input type="range" min="1" max="40" value="14" id="sauber"></li>
                                    <li><span class="motor">caterham</span><input type="range" min="1" max="40" value="12" id="caterham"></li>
                            </ul>
                            
                            <button onclick="restart();"> Probar  configuración </button>
                            </div>
                            
                        </div>
                    
                </section>
                
            </div>

            <div class="col-sm-4">
                <section class="panel">
                    <header class="panel-heading">
                        Resultados simulación
                        
                    </header>
                    <div class="panel-body">
                        <div class="resultadossim">
                            <ul id="resul"></ul>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <script>
                    <?php 
                    $js_array_val = json_encode($valor);
                    $js_array_pil = json_encode($pilotos);
                    echo "var valores_pilotos =".$js_array_val.";\n";
                    echo "var aPilotos =".$js_array_pil.";\n";
                    ?>

                    //for(var i=0;i<aPilotos.length;i++){
                    //  console.log(aPilotos[i]+": "+ (1000 + valores_pilotos[aPilotos[i]])/1225 );
                    //}
                    </script>

                    <script>
                    // Vars
                    var 

                    canvas = document.querySelector('canvas'),
                    ctx = canvas.getContext('2d'),

                    TWO_PI = Math.PI * 2,
                    
                    // Pilotos
                    id_piloto = 0,
                    pilotos = [],
                    numPilotos = 20,
                    pos = 0,
                    val_motor = [],
                    active = true,
                    tinicio = new Date(),
                    COEMANOS = 600225,
                    COEFRENADA = 1050;

                    
                    



                    // Tamaño canvas
                    canvas.width  = 688;//window.innerWidth;//488
                    canvas.height = 255;//window.innerHeight;

                    var image = new Image();
                    image.src = base_url+"/img/car.png";

                    var road = new Image();
                    road.src = base_url+"/img/road.png";
                    

                    function loop() {
                        if(active){
                            clear();
                            update();
                            draw();
                            queue();    
                        }
                        
                    }

                    function clear(){
                    //canvas.width = canvas.width;
                    //ctx.clearRect(0, 0, canvas.width, canvas.height);
                    // Fondo
                    ctx.globalCompositeOperation = "source-over";
                    //ctx.fillStyle = "rgba(255,255,255,0.5)";
                    //ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(road, 0, 0,canvas.width,canvas.height);
                    //ctx.globalCompositeOperation = "lighter";
                    
                    
                    }

                    function update(){

                        for(var i = 0; i<aPilotos.length; i++){
                            var p = pilotos[i];

                            plotPilotos(p,canvas.width -10, canvas.height);
                            p.move();
                        }
                        
                        
                    }
                    function draw(){
                        
                            ctx.globalCompositeOperation = "source-over";
                            
                            // Dibujar particulas
                            
                            pilotos.forEach(drawPilotos);
                            

                            ctx.globalCompositeOperation = "lighter";
                        
                    }
                    function queue(){   

                        if(active)
                            window.requestAnimationFrame(loop); 
                            
                    }

                    function piloto(nombre,x,y,vx,vy,valAceleracion, valFrenada, valMotor,cColor){
                        
                        this.nombre = nombre;
                        this.x = x;
                        this.y = y;

                        this.vx = vx;
                        this.vy = vy;

                        this.tiempoA = tinicio;
                        this.tiempoB = '';

                        this.aceleracion = valAceleracion;
                        this.frenada = valFrenada;

                        this.motor = valMotor;

                        this.finalizado = 0;

                        this.color = cColor || "#00f";//"hsla("+parseInt((Math.random()*360)+0,10)+",100%,50%,0.9)";
                    }
                    piloto.prototype.move = function(){
                        this.x += this.vx;
                        //this.y += this.vy;
                    }

                    function plotPilotos(piloto,w,h){
                        if(piloto.finalizado)
                            return;

                        if(piloto.x >= w){
                            piloto.vx = 0;
                            piloto.finalizado = 1;
                            piloto.tiempoB = new Date();
                            var diferencia = (piloto.tiempoB - piloto.tiempoA) / 1000;
                            pos++;
                            $('#resul').append('<li>'+pos+'º '+piloto.nombre+' <span style="font-size:10px;">('+diferencia+')</span> </li>');
                        }
                            

                        var rand = Math.random();

                        // Frenar
                        /*
                        if(rand  > piloto.frenada){
                            if(piloto.vx>1.3){
                                piloto.vx *= piloto.frenada;//0.4;
                                console.log("freno"+piloto.frenada);    
                            }
                            
                        }
                        */
                        

                        // Acelerar
                        /*if(piloto.aceleracion < rand){
                            console.log("acelero");
                            piloto.vx *= 1.022;
                        }
                        */
                        piloto.vx += piloto.aceleracion + piloto.motor;

                    }

                    function drawPilotos(object){

                        
                        ctx.fillStyle=object.color;
                        /*
                        ctx.fillRect(object.x,object.y,5,5);
                        */
                        ctx.drawImage(image, object.x, object.y,50,20);

                        // texto velocidad
                        ctx.font="small-caps bold 10px arial";
                        ctx.fillText(object.nombre,object.x-36,object.y+15);
                    }

                    function restart(){

                        active = false;
                        tinicio = new Date();
                        pilotos.splice(0,pilotos.length);
                        
                        set_val_motor();
                        pos = 0;

                        // Limpiar resultados anteriores
                        document.getElementById("resul").innerHTML = "";

                        var colorc  = "hsla("+parseInt((Math.random()*3)+20,10)+",100%,50%,1)";

                        for(var i=0;i<aPilotos.length;i++){
                        
                            if(!(i%2)){
                                colorc  = "hsla("+parseInt((Math.random()*3)+20,10)+",100%,50%,1)";
                            }
                            pilotos.push( new piloto(aPilotos[i],10,10*(i+2),0.3,0,((1000 - valores_pilotos[aPilotos[i]])/COEMANOS),((1000 - valores_pilotos[aPilotos[i]])/COEFRENADA), val_motor[aPilotos[i]], colorc) );
                        }


                        //alert(pilotos.length);
                        active = true;

                    }

                    function set_val_motor(){
                        val_motor['hamilton'] = document.getElementById("mercedes").value / 100000;
                        val_motor['rosberg'] = document.getElementById("mercedes").value / 100000;
                        val_motor['ricciardo'] = document.getElementById("redbull").value / 100000;
                        val_motor['kvyat'] = document.getElementById("redbull").value / 100000;
                        val_motor['massa'] = document.getElementById("williams").value / 100000;
                        val_motor['bottas'] = document.getElementById("williams").value / 100000;
                        val_motor['vettel'] = document.getElementById("ferrari").value / 100000;
                        val_motor['raikkonen'] = document.getElementById("ferrari").value / 100000;
                        val_motor['alonso'] = document.getElementById("mclaren").value / 100000;
                        val_motor['button'] = document.getElementById("mclaren").value / 100000;
                        val_motor['perez'] = document.getElementById("forceindia").value / 100000;
                        val_motor['hulkenberg'] = document.getElementById("forceindia").value / 100000;
                        val_motor['sainz'] = document.getElementById("tororoso").value / 100000;
                        val_motor['verstappen'] = document.getElementById("tororoso").value / 100000;
                        val_motor['grosjean'] = document.getElementById("lotus").value / 100000;
                        val_motor['maldonado'] = document.getElementById("lotus").value / 100000;
                        val_motor['ericsson'] = document.getElementById("sauber").value / 100000,
                        val_motor['nasr'] = document.getElementById("sauber").value / 100000;
                    }

                    // Valores motores
                    set_val_motor();
                    // PILOTOS CREAR
                    // piloto(nombre,x,y,vx,vy,valAceleracion, valFrenada)
                    var colorc  = "hsla("+parseInt((Math.random()*3)+20,10)+",100%,50%,1)";
                    
                    for(var i=0;i<aPilotos.length;i++){
                        //console.log(aPilotos[i]+": "+ ((1000 - valores_pilotos[aPilotos[i]])/600225) );
                        //pilotos.push( new piloto(aPilotos[i],10,10*(i+1),0.3,0,((1000 + valores_pilotos[aPilotos[i]])/1225),0.003) );

                        if(!(i%2)){
                            colorc  = "hsla("+parseInt((Math.random()*3)+20,10)+",100%,50%,1)";
                        }
                        pilotos.push( new piloto(aPilotos[i],10,10*(i+2),0.3,0,((1000 - valores_pilotos[aPilotos[i]])/COEMANOS),((1000 - valores_pilotos[aPilotos[i]])/COEFRENADA), val_motor[aPilotos[i]], colorc) );
                    }
                    
                    /*
                    pilotos.push( new piloto('HAM',10,10,0.3,0,0.87,0.003) );   
                    pilotos.push( new piloto('ROS',10,20,0.3,0,0.87,0.003) );   
                    pilotos.push( new piloto('RIC',10,30,0.3,0,0.91,0.004) );   
                    pilotos.push( new piloto('KVY',10,40,0.3,0,0.91,0.004) );   
                    pilotos.push( new piloto('MAS',10,50,0.3,0,0.95,0.005) );   
                    pilotos.push( new piloto('BOT',10,60,0.3,0,0.95,0.005) );   
                    pilotos.push( new piloto('VET',10,70,0.3,0,0.88,0.003) );   
                    pilotos.push( new piloto('KIM',10,80,0.3,0,0.88,0.003) );   
                    pilotos.push( new piloto('ALO',10,90,0.3,0,0.90,0.004) );   
                    pilotos.push( new piloto('BUT',10,100,0.3,0,0.90,0.004) );  
                    pilotos.push( new piloto('PER',10,110,0.3,0,0.95,0.006) );  
                    pilotos.push( new piloto('HUL',10,120,0.3,0,0.95,0.006) );  
                    pilotos.push( new piloto('SAI',10,130,0.3,0,0.96,0.005) );  
                    pilotos.push( new piloto('VER',10,140,0.3,0,0.96,0.005) );  
                    pilotos.push( new piloto('GRO',10,150,0.3,0,0.97,0.005) );  
                    pilotos.push( new piloto('MAL',10,160,0.3,0,0.97,0.005) );  
                    pilotos.push( new piloto('MAR1',10,170,0.3,0,0.98,0.006) ); 
                    pilotos.push( new piloto('MAR2',10,180,0.3,0,0.98,0.006) ); 
                    pilotos.push( new piloto('ERI',10,190,0.3,0,0.98,0.006) );  
                    pilotos.push( new piloto('NAS',10,200,0.3,0,0.98,0.006) );  
                    */
                    
                    
                    

                    loop();
                    </script>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
