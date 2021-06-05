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
            <div class="header">Seleccione la fecha y hora a la cual desea que su evento inicie y termine</div>
            <form action="../../controlador/cEventoCrear.php" method="get">
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="container">
                            Fecha de Inicio
                            <br>
                            <input type="date" name="fecha_inicio" id="">
                            <br>
                            Hora de Inicio
                            <br>
                            <input type="time" name="hora_inicio" id="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="container">
                            Fecha de Finalizacion
                            <br>
                            <input type="date" name="fecha_fin" id="">
                            <br>
                            Hora de Finalizacion
                            <br>
                            <input type="time" name="hora_fin" id="">
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
<script>// Obtener la zona horaria del equipo
    var resolvedOptions = Intl.DateTimeFormat().resolvedOptions();
    console.log(resolvedOptions.timeZone);
    document.getElementById("utc").value = (resolvedOptions.timeZone);
</script>
</html>