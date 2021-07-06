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
            <div class="header">(Opcional) Introduce una breve descripción del evento que vas a crear, incluyendo información que pueda ser importante para los demás participantes.</div>
            <form action="../controladorVista/cvEventoCrear.php" method="get">
                <br>
                <div class="container">
                    <label for="descipcion">Descripción</label>
                    <input type="text" name="descripcion" placeholder="Descripción">
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