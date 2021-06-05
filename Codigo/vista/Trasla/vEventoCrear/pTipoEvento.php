<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="../css/picSelection.css">
    <title>Document</title>
</head>
<body>
      <div class="container">
        <div class="mainBox">
            <div class="header">Selecciona el tipo de evento que deseas desarrollar</div>
            <form action="../../controlador/cEventoCrear.php" method="get"> <!--FORM-->
            <div class="col-sm-8" style="padding-left:15px;">
                <div class="row" style = "padding: 10px;">
                    <?php
                        $colors = array("#9E330C","#e53935","#7cb342","#00acc1","#009E7F");
                        $colSelect = 0;
                        if(!isset($_SESSION))session_start();
                        //if ($_SESSION['tamano_evento'] != 3) {//SEGUN EL TAMAÑO
                        if (1 != 3) {
                            $cantOp = 2;
                            $textOp = array("Evento deportivo","Evento de ocio");
                            for($Op = 1; $Op != ($cantOp+1); $Op++){
                                echo  "<div class='col-4'>";
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
                            include_once ("../lists/actividades.php");
                            $listActividades = $masivos;//lista de actividades
                            $cantActStart = $cantMasivosStart;//comenzar desde la id de la actividad
                            $cantAct = $cantMasivos;//terminar en la ultima id
                            echo "<div class='row' id='sub1' style='width:100%; height:auto; padding: 0px; overflow:hidden;'>";
                            for($Op = $cantActStart; $Op != ($cantAct+1); $Op++){
                                echo  "<div class='col-sm-3'>";
                                echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='selectRadio(".$cantActStart.",".$Op.",".$cantAct.")'>";
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
                        include_once ("../lists/actividades.php");
                        // * DEPORTES
                        $listActividades = $deportes;//lista de actividades
                        $cantActStart = $cantDeportesStart;//comenzar desde la id de la actividad
                        $cantAct = $cantDeportes;//terminar en la ultima id
                        echo "<div class='row' id='sub1' style='width:0%; height:0px; padding: 0px; overflow:hidden;'>";
                        for($Op = $cantActStart; $Op != ($cantAct+1); $Op++){
                            echo  "<div class='col-sm-3'>";
                            echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='selectRadio(".$cantActStart.",".$Op.",".$cantAct.")'>";
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
                        echo "<div class='row' id='sub2' style='width:0%; height:0px; padding: 0px; overflow:hidden;'>";
                        for($Op = $cantActStart; $Op != ($cantAct+1); $Op++){
                            echo  "<div class='col-sm-3'>";
                            echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='selectRadio(".$cantActStart.",".$Op.",".$cantAct.")'>";
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
                <div class="row">
                <?php
                    $hintText = array("qwertyuiop","asdfghjklñ","zxcvbnm");
                    $cantOp = $cantAct - $cantActStart;
                    for($hint = 1; $hint != ($cantOp+1); $hint++){
                        echo "<p id='texto".$hint."' class=hintText>".$hintText[$hint-1]."</p>";
                    }
                ?>
                </div>
            </div>
            <div class="bottomBox">
                <input type="hidden" name="info" value="1">
                <a class="btn btn-primary buttonInterspaced" href=# role="button"> Cancelar</a>
                <input class="btn btn-primary buttonInterspaced" type="submit" value="Confirmar">
            </div>
            </div>
            
        </form>
    </div>
    </div>
    
    <script src="../js/selection.js">
    </script>

</body>
</html>