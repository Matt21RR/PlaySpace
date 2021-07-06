<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 70px;
        padding-bottom: 40px;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="./css/lists.css">
    <link rel="stylesheet" type="text/css" href="./css/listAmigos.css">
    <title>Document</title>
</head>
<body>
    <?php
        //revisar si ya se tiene la info de los amigos
        $consultado = 0;
        include_once("../controladorVista/cvListaAmigos.php");

        $titleSection = "Amigos";
        include_once("./pPlantilla.php");
    ?>
      <div class="container position-relative" style="top:0px;">
        <div class="container-fluid position-sticky mainListHeader">
            <div class="headerList">Amigos</div>
            <div class="row g-0" style="min-width:180px;">
                <div class="col-md-12 col-sm-12">
                    <div class="listSelector">
                        <div class="container-fluid px-1 py-1">
                            <div class="row g-0">
                                <div class="col-4 text-center">
                                    <div onclick="listaAmigos()" class="buttonSelectorList btn btn-primary px-1 w-100 h-100 text-wrap">Lista de Amigos</div> 
                                </div>
                                <div class="col-4 text-center">
                                    <div onclick="listaSolicitudes()" class="buttonSelectorList btn btn-primary px-1 w-100 h-100 text-wrap">Solicitudes de amistad</div> 
                                </div>
                                <div class="col-4 text-center">
                                    <div onclick="busquedaAmigo()" class="buttonSelectorList btn btn-primary px-1 w-100 h-100 text-wrap">Agregar</div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid g-0 py-1" style="z-index:-1;" id="amigos"><!-- AMIGOS -->
            <?php 
                //CICLO PARA MOSTRAR LOS AMIGOS
                $listaAmigos = $_SESSION['listaAmigos'];
                if($listaAmigos[0][0] != -1){
                    for ($cantAmigos=0; $cantAmigos < count($listaAmigos); $cantAmigos++) { 
                        echo'
                        <div class="friend mx-sm-3" id="cajaAmigo'.$listaAmigos[$cantAmigos][0].'">
                            <div class="friend-content h-100 w-100">
                                <div class="row g-0 h-100">
                                    <div class="col-sm-3 col-auto h-100 g-0">
                                        <img class="friendPhoto my-auto" src="./png/foto_perfil/'.$listaAmigos[$cantAmigos][2].'.png"><!--FOTO DE PERFIL-->
                                    </div>
                                    <div class="col-sm-9 col-8">
                                        <div class="friendInfo">
                                            <div class="friendName">
                                            '.$listaAmigos[$cantAmigos][1].'
                                            </div>
                                            <div class="friendId">
                                                ID: '.$listaAmigos[$cantAmigos][0].'
                                            </div>
                                            <div class="container-fluid g-0" onclick="mostrarOpciones('.$listaAmigos[$cantAmigos][0].')">
                                                    <img src="./png/menuIcons/Mensaje.svg" class="d-inline-block friendOp">
                                                
                                                    
                                                    <img src="./png/menuIcons/Evento.svg" class="d-inline-block friendOp">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <hr size=5>';
                    }
                    echo'
                    <div class="container" id="opcionesAmigos" style="display:none; z-index:4; position:absolute; bottom:0px; background-color:white;">
                        <a href=# id="botonEventos">
                            <div class="btn btn-primary">Ver eventos creados por este usuario</div>
                        </a>
                        <a href=# id="botonChat">
                            <div class="btn btn-primary">Ver chat</div>
                        </a>
                        <a href=# id="botonFinalizar" onclick="()">
                            <div class="btn btn-primary">Finalizar amistad</div>
                        </a>
                    </div>';
                }else{
                    echo "Al parecer no tienes amigos. :(";
                }
            ?>
        </div>

        <div class="container-fluid g-0 py-1" style="z-index:-1; display:none;" id="solicitudes"><!--SOLICITUDES-->
            <?php 
                //CICLO PARA MOSTRAR LAS SOLICITUDES
                $listaSolicitudes = $_SESSION['listaSolicitudes'];
                if($listaSolicitudes[0][0] != -1){
                    for ($cantSolicitudes=0; $cantSolicitudes < count($listaSolicitudes); $cantSolicitudes++) { 
                        echo'
                        <div class="friend mx-sm-3" style="">
                            <div class="friend-content h-100 w-100">
                                <div class="row g-0 h-100">
                                    <div class="col-sm-3 col-auto h-100 g-0">
                                        <img class="friendPhoto my-auto" src="./png/foto_perfil/'.$listaSolicitudes[$cantSolicitudes][2].'.png"><!--FOTO DE PERFIL-->
                                    </div>
                                    <div class="col-sm-9 col-8">
                                        <div class="friendInfo">
                                            <div class="friendName">
                                            '.$listaSolicitudes[$cantSolicitudes][1].'
                                            </div>
                                            <div class="friendId">
                                                ID: '.$listaSolicitudes[$cantSolicitudes][0].'
                                            </div>
                                            <div class="row mx-1">
                                                <div class="col-12 col-sm-6 text-center">
                                                    <div class="buttonSelectorList btn btn-primary px-1 w-100 text-wrap" onclick="aceptarSolicitudAmistad('.$listaSolicitudes[$cantSolicitudes][0].')">Aceptar solicitud</div> 
                                                </div>
                                                <div class="col-12 col-sm-6 text-center">
                                                    <div class="buttonSelectorList btn btn-primary px-1 w-100 text-wrap" onclick="denegarSolicitudAmistad('.$listaSolicitudes[$cantSolicitudes][0].')">Denegar solicitud</div> 
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <hr size=5>';
                    }
                }else{
                    echo "No tienes solicitudes de amistad. :(";
                }
            ?>
        </div>
        <?php include_once("./pBusquedaAmigos.php")?>

      </div>

      
      <script src="./js/amigos.js"></script>
</body>
</html>