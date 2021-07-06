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
            <div class="header">Seleccione la fecha y hora a la cual desea que su evento inicie y termine</div>
            <form action="../controladorVista/cvEventoCrear.php" method="get">
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="container">
                            Fecha de Inicio
                            <br>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" required oninput="verificarFechaInicio()">
                            <br>
                            Hora de Inicio
                            <br>
                            <input type="time" name="hora_inicio" id="hora_inicio" required oninput="verificarFechaInicio()">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="container">
                            Fecha de Finalizacion
                            <br>
                            <input type="date" name="fecha_fin" id="fecha_fin" required oninput="verificarFechaInicio()">
                            <br>
                            Hora de Finalizacion
                            <br>
                            <input type="time" name="hora_fin" id="hora_fin" required oninput="verificarFechaInicio()">
                        </div>
                    </div>
                </div>
                <div class="bottomBox">
                    <input type="hidden" name="utc" id="utc">
                    <input type="hidden" name="info" value="1">
                    <a class="btn btn-primary buttonInterspaced" href=# role="button"> Cancelar</a>
                    <input class="btn btn-primary buttonInterspaced" type="submit" value="Confirmar">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="./js/tiemposEvento.js">//Para verificar temporalmente los datos que se intentan enviar
</script>
</html>