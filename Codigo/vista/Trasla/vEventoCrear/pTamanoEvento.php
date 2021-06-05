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
      <div class="header">Selecciona el tamaño del evento que desea realizar</div>

      <br>
      <form action="../../controlador/cEventoCrear.php" method="get"> <!--FORM-->
        <div class="row">
          <div class="col-sm-8" style="padding-left:15px;">
            <div class="row" style = "padding: 10px;">
              <?php
                $colors = array("#e53935","#7cb342","#00acc1");
                $colSelect = 0;
                $cantOp = 3;
                $textOp = array("Actividad grupal","Torneo","Masivo");
                
                for($Op = 1; $Op != ($cantOp+1); $Op++){
                  echo  "<div class='col-4'>";
                  echo    "<div class='btn btn-primary boxOption' id='Op".$Op."' style='background-color:".$colors[$colSelect].";' onclick='selectRadio(1,".$Op.",".$cantOp.")'>";
                  echo      "<label for='".$Op."'>";
                  echo        $textOp[$Op-1];
                  echo      "</label>";
                  echo      "<input type='radio' name='tamano_evento' id='_".$Op."' value='".$Op."'>";
                  echo    "</div>";
                  echo  "</div>";
                  
                  $colSelect++;
                  if($colSelect > 2){
                    $colSelect = 0;
                  }
                }
              ?>
            </div>
          </div>
          <div class="col-sm-4" style="">
            <div class="row">
              <?php
                $hintText = array("qwertyuiop","asdfghjklñ","zxcvbnm");
                for($hint = 1; $hint != ($cantOp+1); $hint++){
                  echo "<p id='texto".$hint."' class=hintText>".$hintText[$hint-1]."</p>";
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


<script src="../js/selection.js">
</script>
    
</body>
</html>