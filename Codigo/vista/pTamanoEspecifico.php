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
        //Los arreglos con los nombres de tamaños de evento, las denominaciones de
        //participantes, y las descripciones de los tamaños de evento,.
        include_once ("./lists/tamanos.php");
        //Donde estan los nombres de los tipos de evento y las descripciones para los
        //mismos.
        include_once ("./lists/actividades.php");
        //Donde se encuentran clasificados los tipos de eventos por la cantidad
        //de participantes que puede haber en ellos
        include_once ("../modelo/lists.php");
        
        if(!isset($_SESSION))session_start();
        $nomTamanoEvento =  $tamanos[$_SESSION['tamano_evento']-1];
        $tipoEvento = $_SESSION['tipo_evento'];
        $tamanoEvento = $_SESSION['tamano_evento'];//guardarlo en una variable local

        if($tamanoEvento == 1){//si el tamaño de evento es Grupal
            //Decidir la denominacion de la persona que se inscribe
            $denominacionParticipantes = $nombre_participante[0];
            //Decidir el numero maximo para el input
            for ($grupoIDs=0; $grupoIDs < count($eventosPequenos); $grupoIDs++) {
                //buscar la id actual del evento
                $resultado = array_search($tipoEvento,$eventosPequenos[$grupoIDs]);
                if($resultado !== false){
                    $maxParticipantes = $cantParticipantesGrupal[$grupoIDs];
                }
                
            }
        }elseif($tamanoEvento == 2){//si el tamano de evento es Torneo
            //decidir el numero maximo para el input y la denominacion de la persona
            //que se inscribe
            if(array_search($tipoEvento,$individual) != -1){//si es un torneo individual
                $maxParticipantes = $cantParticipantesTorneo[0];
                $denominacionParticipantes = $nombre_participante[1];
            }else{
                $maxParticipantes = $cantParticipantesTorneo[1];
                $denominacionParticipantes = $nombre_participante[2];
            }
        }
        ?>
                                
    <div class="container">
        <div class="mainBox">
            <div class="header">Indique la cantidad de personas que van a participar en su evento</div>
            <form action="../controladorVista/cvEventoCrear.php" method="get">
                <div class="row g-0">
                    <div class="col-12 col-sm-9">
                        Escribe aqui la cantidad de jugadores
                        <br>
                        <input type="number" name="cantidad_paticipantes" id="cantidad_paticipantes" placeholder="<?php echo($denominacionParticipantes); ?>"min="4" max="<?php echo $maxParticipantes;?>" required>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="container">
                            Tamaño de evento elegido:
                            <?php
                                echo $nomTamanoEvento;
                            ?>
                            <br>
                            <hr>
                            Tipo de evento elegido:
                            <?php
                                
                                if(($tipoEvento-200) > 0){//si es del grupo de los masivos (no deberia de salir esta pagina si esto ocurre)
                                                          //pero por si acaso
                                }elseif(($tipoEvento-100) > 0){//Si es del grupo de los de OCIO
                                    echo $ocio[$tipoEvento-101];
                                    echo "<br>";
                                    echo "<hr>";
                                    if($_SESSION['tamano_evento'] == 1){//Evento de tipo grupal
                                        echo $hintOcioGrupal[$tipoEvento-101];
                                    }else{//Evento de tipo Masivo
                                        echo $hintOcioTorneo[$tipoEvento-101];
                                    }
                                }else{//si es de los de DEPORTES
                                    echo $deportes[$tipoEvento-1];
                                    echo "<br>";
                                    echo "<hr>";
                                    if($_SESSION['tamano_evento'] == 1){//Evento de tipo grupal
                                        echo $hintDeportesGrupal[$tipoEvento-1];
                                    }else{//Evento de tipo Masivo
                                        echo $hintDeportesTorneo[$tipoEvento-1];
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="bottomBox">
                    <input type="hidden" name="info" value="1">
                    <a class="btn btn-primary buttonInterspaced" href=# role="button"> Cancelar</a>
                    <input class="btn btn-primary buttonInterspaced" type="submit" value="Confirmar">
                </div>
            </form>
        </div>
    </div>
</body>
</html>