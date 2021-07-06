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
    <link rel="stylesheet" type="text/css" href="css/picSelection.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
      <div class="mainBox">
        <div class="header">Selecciona una imagen para usar como foto de perfil</div>
        
        <br>

        <form action="../controladorVista/cvSeleccionarFotoPerfil.php" method="get">
            
          <div class="row">
            <div class="col-sm-8" style="padding-left:15px;">
              <?php   $i = 1; 
                      $fotos = 11;//poner la cantidad de fotos de perfil disponibles aqui
                      while($i != ($fotos+1)){
                      echo "<label for=".$i."><img id='img".$i."' src='png/foto_perfil/".$i.".png' onclick='selectRadioImg(".$i.",".$fotos.")'></label>
                      <input type='radio' name='pic' id='Op".$i."' value='".$i."'>";
                      $i++;
                      }?>
            </div>
            <div class="col-sm-4" style="">
                    <br>
                    <input class="btn btn-primary" type="submit" value="Cancelar" name="Cancelar">
                    <br>
                    <input class="btn btn-primary" type="submit" value="Confirmar" name="Confirmar">
            </div>
          </div>
        </form>
      </div>
    </div>

    <script src="./js/selection.js">
    </script>
    
</body>
</html>