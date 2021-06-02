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

        <form>
            
          <div class="row">
            <div class="col-sm-8" style="padding-left:15px;">
              <?php   $i = 1; 
                      $fotos = 11;//poner la cantidad de fotos de perfil disponibles aqui
                      while($i != ($fotos+1)){
                      echo "<label for=".$i."><img id='img".$i."' src='png/foto_perfil/".$i.".png' onclick='selectRadio(".$i.",".$fotos.")'></label>
                      <input type='radio' name='pic' id='".$i."'>";
                      $i++;
                      }?>
            </div>
            <div class="col-sm-4" style="">
                    <br>
                    <a class="btn btn-primary" href=# role="button"> Cancelar</a>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Confirmar">
            </div>
          </div>
        </form>
      </div>
    </div>

    <script>
      function selectRadio(id,cantImg){
        
        i = 1;

        while (i != (cantImg+1)){
          document.getElementById("img"+i).style.border = "0px";
          if(i == id){
            document.getElementById("img"+i).style.border = "4px solid #2979ff";
          }
          else{
            document.getElementById("img"+i).style.border = "0px";
          }
          i++;
        }
        
        
      }
      
    </script>
    
</body>
</html>