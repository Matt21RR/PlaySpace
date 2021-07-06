<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="./css/bootstrap.css" rel="stylesheet">
            <title>Document</title>
            <link rel="stylesheet" href="./css/ubicacion.css">
        </head>
        <body>
            <div class="mapBox">
                <?php include_once("./pMapa.php"); //EL MAPA
                ?>
            </div>
            <?php
                $titleSection = "Mapa y Busqueda";
                include_once("./pPlantilla.php"); // EL MENU
            ?>
            <div class="btn botonBusqueda" onclick="abrirCajaFiltros(),realizarBusqueda()"></div>
            <div class="cajaFiltrosBusqueda overflow-auto" id="Caja_Filtros">
                <div class="container-lg" id="filtro1">
                    Que queres buscar mi pana?
                    <div class="row">
                        <?php 
                            $colors = array("#e53935","#7cb342","#00acc1");
                            $colSelect = 0;
                            //$textOp = array("Evento","Tienda");
                            $textOp = array("Evento");
                            
                            for($Op = 0; $Op != (count($textOp)); $Op++){
                                echo  "<div class='col'>";
                                echo    "<div class='btn btn-primary boxOption' id='tipoUbiciacion".($Op+1)."' style='background-color:".$colors[$colSelect].";' onclick='filtrarResultados(". $Op+1 .")'>";
                                echo      $textOp[$Op];
                                echo    "</div>";
                                echo  "</div>";
                                $colSelect++;
                                if($colSelect>2){
                                    $colSelect = 0;
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="container-lg" id='filtro1_1'><!--Tamaño del evento-->
                    Selecciona el tamaño del evento
                    <div class="row">
                        <?php 
                            include_once("./lists/tamanos.php");
                            $colors = array("#e53935","#7cb342","#00acc1");
                            $colSelect = 0;
                            $textOp = $tamanos;
                            
                            for($Op = 0; $Op != (count($textOp)); $Op++){
                                echo  "<div class='col'>";
                                echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='filtrarResultados(null,". $Op+1 .")'>";
                                echo      $textOp[$Op];
                                echo    "</div>";
                                echo  "</div>";
                                $colSelect++;
                                if($colSelect>2){
                                    $colSelect = 0;
                                }
                            }
                        ?>
                    </div>
                </div>

                <div class="container-lg" id='filtro1_2'><!--Tipo de tienda-->
                    Selecciona el tipo de tienda o elemento que buscas
                    <div class="row">
                        <?php 
                            include_once("./lists/actividades.php");
                            $colors = array("#e53935","#7cb342","#00acc1");
                            $colSelect = 0;
                            $textOp = $tiposTienda;
                            
                            for($Op = 0; $Op != (count($textOp)); $Op++){
                                echo  "<div class='col'>";
                                echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='filtrarResultados(null,". $Op+1 .")'>";
                                echo      $textOp[$Op];
                                echo    "</div>";
                                echo  "</div>";
                                $colSelect++;
                                if($colSelect>2){
                                    $colSelect = 0;
                                }
                            }
                        ?>
                    </div>
                </div>


                <div class="container-lg" id='filtro1_1_1'><!--Tipo de evento-->
                    Selecciona el tipo de evento
                    <div class="row">
                        <?php 
                            include_once("./lists/actividades.php");
                            $colors = array("#e53935","#7cb342","#00acc1");
                            $colSelect = 0;
                            $textOp = $tipos;
                            
                            for($Op = 0; $Op != (count($textOp)); $Op++){
                                echo  "<div class='col'>";
                                echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='filtrarResultados(null,null,". $Op+1 .")'>";
                                echo      $textOp[$Op];
                                echo    "</div>";
                                echo  "</div>";
                                $colSelect++;
                                if($colSelect>2){
                                    $colSelect = 0;
                                }
                            }
                        ?>
                    </div>
                </div>

                <div class="container-lg" id='filtro1_1_2'><!--Actividad Masiva-->
                    Selecciona el tipo de actividad masiva
                    <div class="row">
                        <?php 
                            include_once("./lists/actividades.php");
                            $colors = array("#e53935","#7cb342","#00acc1");
                            $colSelect = 0;
                            $textOp = $masivos;
                            
                            for($Op = 0; $Op != (count($textOp)); $Op++){
                                echo  "<div class='col'>";
                                echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='filtrarResultados(null,null,0,". $Op+201 .")'>";
                                echo      $textOp[$Op];
                                echo    "</div>";
                                echo  "</div>";
                                $colSelect++;
                                if($colSelect>2){
                                    $colSelect = 0;
                                }
                            }
                        ?>
                    </div>
                </div>

                <div class="container-lg" id='filtro1_1_1_1'><!--Actividad Del Evento(Deportes)-->
                    Selecciona la actividad del evento deportivo que buscas
                    <div class="row">
                        <?php 
                            include_once("./lists/actividades.php");
                            $colors = array("#e53935","#7cb342","#00acc1");
                            $colSelect = 0;
                            $textOp = $deportes;
                            
                            for($Op = 0; $Op != (count($textOp)); $Op++){
                                echo  "<div class='col-md-3 col-sm-4 col-6'>";
                                echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='filtrarResultados(null,null,null,". $Op+1 .")'>";
                                echo      $textOp[$Op];
                                echo    "</div>";
                                echo  "</div>";
                                $colSelect++;
                                if($colSelect>2){
                                    $colSelect = 0;
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="container-lg" id='filtro1_1_1_2'><!--Actividad Del Evento(Ocio)-->
                    Selecciona la actividad del evento de ocio que buscas
                    <div class="row">
                        <?php 
                            include_once("./lists/actividades.php");
                            $colors = array("#e53935","#7cb342","#00acc1");
                            $colSelect = 0;
                            $textOp = $ocio;
                            
                            for($Op = 0; $Op != (count($textOp)); $Op++){
                                echo  "<div class='col-md-3 col-sm-4 col-6'>";
                                echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='filtrarResultados(null,null,null,". $Op+101 .")'>";
                                echo      $textOp[$Op];
                                echo    "</div>";
                                echo  "</div>";
                                $colSelect++;
                                if($colSelect>2){
                                    $colSelect = 0;
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="container-lg" id='filtro1_1_2'><!--Actividad Del Evento(Masivo)-->
                    Selecciona la actividad del evento masivo que buscas
                    <div class="row">
                        <?php 
                            include_once("./lists/actividades.php");
                            $colors = array("#e53935","#7cb342","#00acc1");
                            $colSelect = 0;
                            $textOp = $masivos;
                            
                            for($Op = 0; $Op != (count($textOp)); $Op++){
                                echo  "<div class='col-md-3 col-sm-4 col-6'>";
                                echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' >";
                                echo      $textOp[$Op];
                                echo    "</div>";
                                echo  "</div>";
                                $colSelect++;
                                if($colSelect>2){
                                    $colSelect = 0;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <script src="./js/busqueda.js"></script>
            <script src="./js/master.js"></script>
            <!--VENTANA DE INFORMACION DEL EVENTO-->
            <div class="container" id="ventanaInfoEvento" style="display:none; z-index:4; position:absolute; bottom:0px; background-color:white;">
                <div class="container" id="tipoEvento"></div>
                <div class="container" id="distancia"></div>
                <a href=# id="masInfoEvento">
                    <div class="btn btn-primary">Más información</div>
                </a>
                
            </div>

            <!--VENTANA DE INFORMACION DE LA TIENDA-->
            <div class="container" id="ventanaInfoTienda" style="display:none; z-index:4; position:absolute; bottom:0px; background-color:white;">
                <div class="container" id="nombreTienda"></div>
                <div class="container" id="descripcionTienda"></div>
                <a href=# id="masInfoTienda">
                    <div class="btn btn-primary">Más información</div>
                </a>
                
            </div>
            
        </body>
    </html>