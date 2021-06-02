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
            <div class="header">Para finalizar, desea que su evento cuente con una sala de chat en la cual los participantes puedan dialogar entre ellos y con usted.</div>
            <form action="../../controlador/cEventoCrear.php" method="get">
                <br>
                <div class="row">
                    <div class='col-sm-2'>
                        <div class='btn btn-primary boxOption' id='Op1'  onclick='selectRadio(1,1,2)'>
                            <label for='_1'>
                                Si
                            </label>
                            <input type='radio' name='chat' id='_1' value='1'>
                        </div>
                    </div>
                    <div class='col-sm-2'>
                        <div class='btn btn-primary boxOption' id='Op2'  onclick='selectRadio(1,2,2)'>
                            <label for='_2'>
                                No
                            </label>
                            <input type='radio' name='chat' id='_2' value='0'>
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

    <script src="../js/selection.js">
    </script>

</body>
</html>