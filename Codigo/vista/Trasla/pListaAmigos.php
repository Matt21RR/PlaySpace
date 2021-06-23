<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 30px;
        padding-bottom: 40px;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="./css/lists.css">
    <link rel="stylesheet" type="text/css" href="./css/listAmigos.css">
    <title>Document</title>
</head>
<body>
    <?php
        $titleSection = "Amigos";
        include_once("./pPlantilla.php");
    ?>
      <div class="container">
        <div class="headerList">Amigos</div>
        <div class="row g-0">
            <div class="col-sm-6">
                <div class="listSelector">
                    <div class="container-fluid px-1 py-1">
                        <div class="row g-0">
                            <div class="col-6 text-center px-auto">
                                <a href="#"class="buttonSelectorList btn btn-primary px-1 h-100 w-100 text-wrap">Lista de Amigos</a> 
                            </div>
                            <div class="col-6 text-center px-auto">
                                <a href="#" class="buttonSelectorList btn btn-primary px-1 h-100 w-100 text-wrap">Solicitudes de amistad</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
</body>
</html>