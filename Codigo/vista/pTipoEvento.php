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
<?php
    //INFORMACION IMPORTANTE
    if(!isset($_SESSION))session_start();
    $tamanoEvento = $_SESSION['tamano_evento'];
?>
<body>
    <div class="container">
        <div class="mainBox">
            <div class="header">Selecciona el tipo de evento que deseas desarrollar</div>
            <form action="../controladorVista/cvEventoCrear.php" method="get"> <!--FORM-->
                <div class="row g-0">
                    <div class="col-sm-8">
                        <div class="row g-0">
                            <?php
                                $colors = array("#9E330C","#e53935","#7cb342","#00acc1","#009E7F");
                                $colSelect = 0;
                                if ($tamanoEvento != 3) {
                                    $cantOp = 2;
                                    $textOp = array("Evento deportivo","Evento de ocio");
                                    for($Op = 1; $Op != ($cantOp+1); $Op++){
                                        echo  "<div class='col'>";
                                        echo    "<div class='btn btn-primary boxOption' id='OpSub".$Op."' style='background-color:".$colors[$colSelect].";' onclick='selectSubsection(".$Op.",".$cantOp.")'>";
                                        echo      "<label for='".$Op."'>";
                                        echo        $textOp[$Op-1];
                                        echo      "</label>";
                                        echo    "</div>";
                                        echo  "</div>";
                                        
                                        $colSelect++;
                                        if($colSelect > 3){
                                            $colSelect = 0;
                                        }
                                    }
                                    $colSelect = 0;
                                }else {
                                    include_once ("./lists/actividades.php");
                                    $listActividades = $masivos;//lista de actividades
                                    $cantActStart = $cantMasivosStart;//comenzar desde la id de la actividad
                                    $cantAct = $cantMasivos;//terminar en la ultima id
                                    echo "<div class='row g-0' id='sub1' style='width:100%; height:auto; padding: 0px; overflow:hidden;'>";
                                    for($Op = $cantActStart; $Op != ($cantAct+1); $Op++){
                                        echo  "<div class='col-sm-3'>";
                                        echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='selectRadioHint(".$cantActStart.",".$Op.",".$cantAct.")'>";
                                        echo      "<label for='".$Op."'>";
                                        echo        $listActividades[$Op-$cantActStart];
                                        echo      "</label>";
                                        echo      "<input type='radio' name='tipo_evento' id='_".$Op."' value='".$Op."'>";
                                        echo    "</div>";
                                        echo  "</div>";
                                        
                                        $colSelect++;
                                        if($colSelect > 3){
                                            $colSelect = 0;
                                        }
                                    }
                                    echo "</div>";
                                } 
                            ?>
                            <?php 
                                include_once ("./lists/actividades.php");
                                // * DEPORTES
                                $listActividades = $deportes;//lista de actividades
                                $cantActStart = $cantDeportesStart;//comenzar desde la id de la actividad
                                $cantAct = $cantDeportes;//terminar en la ultima id
                                echo "<div class='row g-0' id='sub1' style='width:0%; height:0px; padding: 0px; overflow:hidden;'>";
                                for($Op = $cantActStart; $Op != ($cantAct+1); $Op++){
                                    echo  "<div class='col-sm-3'>";
                                    echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='selectRadioHint(".$cantActStart.",".$Op.",".$cantAct.")'>";
                                    echo      "<label for='".$Op."'>";
                                    echo        $listActividades[$Op-$cantActStart];
                                    echo      "</label>";
                                    echo      "<input type='radio' name='tipo_evento' id='_".$Op."' value='".$Op."'>";
                                    echo    "</div>";
                                    echo  "</div>";
                                    
                                    $colSelect++;
                                    if($colSelect > 3){
                                        $colSelect = 0;
                                    }
                                }
                                echo "</div>";


                                // * OCIO
                                $listActividades = $ocio;//lista de actividades
                                $cantActStart = $cantOcioStart;//comenzar desde la id de la actividad
                                $cantAct = $cantOcio;//terminar en la ultima id
                                echo "<div class='row g-0' id='sub2' style='width:0%; height:0px; padding: 0px; overflow:hidden;'>";
                                for($Op = $cantActStart; $Op != ($cantAct+1); $Op++){
                                    echo  "<div class='col-sm-3'>";
                                    echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='selectRadioHint(".$cantActStart.",".$Op.",".$cantAct.")'>";
                                    echo      "<label for='".$Op."'>";
                                    echo        $listActividades[$Op-$cantActStart];
                                    echo      "</label>";
                                    echo      "<input type='radio' name='tipo_evento' id='_".$Op."' value='".$Op."'>";
                                    echo    "</div>";
                                    echo  "</div>";
                                    
                                    $colSelect++;
                                    if($colSelect > 3){
                                        $colSelect = 0;
                                    }
                                }
                                echo "</div>";
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-4" style="">
                        <div class="row g-0">
                        <?php
                            if($tamanoEvento != 3){//Si el tamaño de evento de diferente de masivo hacer....
                                if($tamanoEvento == 1){//si el tamaño del evento es igual a "grupo"...
                                    $hintDeportes = $hintDeportesGrupal;
                                    $hintOcio = $hintOcioGrupal;
                                }
                                elseif($tamanoEvento == 2){//Si el tamaño del evento es igual a "Torneo"
                                    $hintDeportes = $hintDeportesTorneo;
                                    $hintOcio = $hintOcioTorneo;
                                }
                                //====================
                                //Para deportes grupal
                                echo "<div class='container-fluid' id='hintDeportes'>";
                                $cantOp = count($hintDeportes);
                                for($hint = 1; $hint != ($cantOp+1); $hint++){
                                    echo "<p id='textoAyuda".$hint."' class=hintText>".$hintDeportes[$hint-1]."</p>";
                                }
                                echo "</div>";
                                //===================
                                //para ocio grupal
                                echo "<div class='container-fluid' id='hintOcio'>";
                                $cantOp = count($hintOcio);
                                for($hint = 101; $hint != ($cantOp+101); $hint++){
                                    echo "<p id='textoAyuda".$hint."' class=hintText>".$hintOcio[$hint-101]."</p>";
                                }
                                echo "</div>";
                            }else{//Si el tamaño de evento es igual a masivo
                                $cantOp = count($hintMasivos);
                                for($hint = 201; $hint != ($cantOp+201); $hint++){
                                    echo "<p id='textoAyuda".$hint."' class=hintText>".$hintMasivos[$hint-201]."</p>";
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
    
    <script src="./js/selection.js">
    </script>

</body>
</html>