<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="./css/picSelection.css">
    <title>Document</title>
</head>
<body>
    <?php
        if(!isset($_SESSION))session_start();
        //informacion necesaria para calcular las fechas maximas
        echo "<div id='tamano_evento' style='display:none;'>";
        echo $_SESSION['tamano_evento'];
        echo "</div>";
    ?>
    <div class="container">
        <div class="mainBox">
            <div class="header">Para editar alguno de los valores simplemente toca encima del mismo</div>
                <br>
                <div class="summary">
                <div class="headerSummary">Resumen</div>
                <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="container">
                            <br>
                            
                            <div class="summaryOp">
                                <div class="headerOp">Tamaño del Evento</div>
                                <form action="../controladorVista/cvEventoCrear.php" method="get">
                                    <input type="hidden" name="data" value=1><!--QUE VALOR SE VA A CAMBIAR-->
                                    <input type="hidden" name="info" value=0>
                                    <input class="btn btn-primary container" type="submit" value="
                                    <?php 
                                        if(!isset($_SESSION))session_start();
                                        include_once("./lists/tamanos.php");
                                        echo $tamanos[$_SESSION['tamano_evento']-1];
                                    ?>
                                    ">
                                </form>
                            </div>
                            <div class="summaryOp">
                                <div class="headerOp">Tipo de Evento</div>
                                <form action="../controladorVista/cvEventoCrear.php" method="get">
                                    <input type="hidden" name="data" value=2><!--QUE VALOR SE VA A CAMBIAR-->
                                    <input type="hidden" name="info" value=0>
                                    <input class="btn btn-primary container" type="submit" value="
                                    <?php 
                                        include_once("./lists/actividades.php");
                                        $tipoEvento = $_SESSION['tipo_evento'];
                                        if(($tipoEvento-200) > 0){//si es del grupo de los masivos
                                            echo $masivos[$tipoEvento-201];
                                        }elseif(($tipoEvento-100) > 0){//Si es del grupo de los de ocio
                                            echo $ocio[$tipoEvento-101];
                                        }else{//si es de los de deportes
                                            echo $deportes[$tipoEvento-1];
                                        }
                                    ?>
                                    ">
                                </form>
                            </div>
                            <div class="summaryOp">
                                <!--SI EL TAMAÑO DE EVENTO ES "MASIVO" NO DEBE DE SER MOSTRADA ESTA CAJA-->
                                <?php if($_SESSION['tamano_evento'] != 3){
                                    echo'
                                    <div class="headerOp">Cantidad de jugadores</div>
                                    <form action="../controladorVista/cvEventoCrear.php" method="get">
                                        <input type="hidden" name="data" value=3><!--QUE VALOR SE VA A CAMBIAR-->
                                        <input type="hidden" name="info" value=0>
                                        <input class="btn btn-primary container" type="submit" value="'.
                                            $_SESSION['cantidad_paticipantes'].'
                                        ">
                                    </form>';
                                }
                                ?>
                            </div>
                            <div class="summaryOp">
                                <div class="headerOp">Ubicacion del evento</div>
                                <form action="../controladorVista/cvEventoCrear.php" method="get">
                                    <input type="hidden" name="data" value=4><!--QUE VALOR SE VA A CAMBIAR-->
                                    <input type="hidden" name="info" value=0>
                                    <input class="btn btn-primary container" type="submit" value="
                                    ver
                                    ">
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="container">
                            <br>
                            <div class="summaryOp">
                                <div class="headerOp">Fecha y hora de inicio</div>
                                <form action="../controladorVista/cvEventoCrear.php" method="get">
                                    <input type="hidden" name="data" value=5><!--QUE VALOR SE VA A CAMBIAR-->
                                    <input type="hidden" name="info" value=0>
                                    <input class="btn btn-primary container" type="submit" value="
                                    <?php
                                        echo $_SESSION['fecha_inicio'];
                                    ?>
                                    ">
                                    </form>
                            </div>
                            <div class="summaryOp">
                                <div class="headerOp">Fecha y hora de finalizacion</div>
                                <form action="../controladorVista/cvEventoCrear.php" method="get">
                                    <input type="hidden" name="data" value=5><!--QUE VALOR SE VA A CAMBIAR-->
                                    <input type="hidden" name="info" value=0>
                                    <input class="btn btn-primary container" type="submit" value="
                                    <?php
                                        echo $_SESSION['fecha_fin'];
                                    ?>
                                    ">
                                </form>
                            </div>
                            <div class="summaryOp">
                                <div class="headerOp">Descripción</div>
                                <form action="../controladorVista/cvEventoCrear.php" method="get">
                                    <input type="hidden" name="data" value=6><!--QUE VALOR SE VA A CAMBIAR-->
                                    <input type="hidden" name="info" value=0>
                                    <input class="btn btn-primary container" type="submit" value="
                                    <?php
                                        echo $_SESSION['descripcion'];
                                    ?>
                                    ">
                                </form>
                            </div>
                            <div class="summaryOp">
                                <?php//!Habilitar cuando se tenga un chat para eventos?>
                                <!--<div class="headerOp">Chat</div>
                                <form action="../controladorVista/cvEventoCrear.php" method="get">
                                    <input type="hidden" name="data" value=7>
                                    <input type="hidden" name="info" value=0>
                                    <input class="btn btn-primary container" type="submit" value="
                                    <?php
                                        //echo $_SESSION['chat'];
                                    ?>
                                    ">
                                </form>-->
                            </div>
                        </div>
                    </div>
                    </div>
                    <br>
                </div>
                <div class="bottomBox">
                    <form action="../controladorVista/cvEventoCrear.php" method="get">
                        <!--CREAR EL EVENTO-->
                        <input type="hidden" name="info" value="500">
                        <a class="btn btn-primary buttonInterspaced" href=# role="button"> Cancelar</a>
                        <input class="btn btn-primary buttonInterspaced" type="submit" value="Confirmar">
                    </form> 
                </div>
        </div>
    </div>
</body>
</html>