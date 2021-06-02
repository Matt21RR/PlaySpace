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
            <div class="header">Indique la cantidad de personas que van a participar en su evento</div>
            <form action="../../controlador/cEventoCrear.php" method="get">
                <div class="row">
                    <div class="col-3">
                        <div class="container">
                            Tamaño de evento elegido:
                            <?php 
                                include_once ("../lists/actividades.php");
                                
                                if(!isset($_SESSION))session_start();
                                echo $_SESSION['tamano_evento'];
                            ?>
                            Tipo de evento elegido:
                            <?php
                                $tipoEvento = $_SESSION['tipo_evento'];
                                
                                if(($tipoEvento-200) > 0){//si es del grupo de los masivos (no deberia de salir esta pagina si esto ocurre)
                                                          //pero por si acaso
                                }elseif(($tipoEvento-100) > 0){//Si es del grupo de los de ocio
                                    echo $ocio[$tipoEvento-101];
                                }else{//si es de los de deportes
                                    echo $deportes[$tipoEvento-1];
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-9">
                        <input type="number" name="cantidad_paticipantes" id="cantidad_paticipantes" min="1" max="40">
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