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
    <div class="container">
        <div class="mainBox">
            <div class="header">A continuación introduzca la ID de usuario de los asistentes del evento que están presentes.</div>
                <br>
                <div class="container">
                    <label for="id_participante">ID de usuario</label>
                    <input type="number" id="id_participante" name="id_participante" placeholder="ID de usuario" min="1" required>
                </div>
                <div class="bottomBox">
                    <a class="btn btn-primary buttonInterspaced" href="../vista/pInformacionEvento.php" role="button"> Volver</a>
                    <input class="btn btn-primary buttonInterspaced" type="submit" value="Chequear" onclick="ingresarParticipante()">
                </div>
        </div>
    </div>
    <script src="./js/ingresarIDparticipantes.JS"></script>
</body>
</html>