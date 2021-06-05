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
            <div class="header">A continuación introduzca la ID de usuario de los asistentes del evento que están presentes.</div>
            <form action="../../controlador/cEventoInicio.php" method="get">
                <br>
                <div class="container">
                    <label for="descipcion">ID de usuario</label>
                    <input type="number" name="id_participante" placeholder="ID de usuario">
                </div>
                <div class="bottomBox">
                    <a class="btn btn-primary buttonInterspaced" href=# role="button"> Cancelar</a>
                    <input class="btn btn-primary buttonInterspaced" type="submit" value="Chequear">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
    if(!isset($_SESSION))session_start();
    $coincidencia = $_SESSION['coincidencia'];
    if ($coincidencia != -1) {
        if ($coincidencia == 0){
            echo "<script>window.alert('No se encontró la ID en la lista de los participantes del evento')</script>";
        }elseif($coincidencia == 1){
            echo "<script>window.alert('ID encontrada en la lista de participantes')</script>";
        }
        
    }
?>