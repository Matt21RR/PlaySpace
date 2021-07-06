<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 55px;
        padding-bottom: 40px;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="./css/infoEvento.css">
    <title>Document</title>
</head>
<body>
    <?php
        $titleSection = "Info del Evento";
        include_once("./pPlantilla.php"); // EL MENU
    ?>


    <?php
        // INFO DEL EVENTO=================================================================================
        include_once ("lists/actividades.php");
        include_once ("lists/img-actividades.php");
        include_once ("lists/tamanos.php");

        include_once ("../modelo/lists.php");

        include_once ("../controlador/cEventos.php");
        include_once ("../mMaster.php");
        if(!isset($_SESSION))session_start();
        $id_evento = $_SESSION['ID_EVENTO'];
        $info_eventos = cEventos::consultarInformacionEvento($id_evento);

        //DETERMINAR LA CLASIFICACION DE LOS INSCRITOS
        switch ($info_eventos[1]) {
            case 1:
                $clasInscritos = $nombre_participante[0];//jugadores
                break;
            case 2:
                $clasInscritos = $nombre_participante[2]; //inicializar como equipos
                for($i = 0; $i != count($individual); $i++){
                    if($individual[$i] == $info_eventos[3]){
                        $clasInscritos = $nombre_participante[1];//competidores
                        break;
                    }
                }
                break;
            case 3:
                $clasInscritos = $nombre_participante[3];
                break;
        }
        //DETERMINAR EL TIPO DE EVENTO "TEXT" Y
        //EL FONDO "STYLE" A UTILIZAR
        if($info_eventos[3]-200 > 0){
            //el indice que se usara para obtener el nombre del evento 
            $tipoEvNum = $info_eventos[3]-201;
            //Nombre del tipo de evento
            $tipoEv = $masivos[$tipoEvNum];
            $style = $img_masivos[$tipoEvNum];
        }elseif($info_eventos[3]-100 > 0){
            $tipoEvNum = $info_eventos[3]-101;
            $tipoEv = $ocio[$tipoEvNum];
            $style = $img_ocio[$tipoEvNum];
        }else{
            $tipoEvNum = $info_eventos[3]-1;
            $tipoEv = $deportes[$tipoEvNum];
            $style = $img_deportes[$tipoEvNum];
        }
        $style = str_replace("background-image:","",$style);//previene error de bg-image dentro de otro bg-image
        $style = str_replace("'","&quot;",$style);//previene un error relacionado con las comillas simples

        //INFO DE LOS PARTICIPANTES==================================================
        $listaP = cEventos::consultarParticipantes($id_evento);

        $listaParticipantes= "";
        $inscrito = 0;//osea no
        for($i=0;$i != $info_eventos[11];$i++){
            $listaParticipantes.=                        "<div class='pl d-flex justify-content-between'>";
            $listaParticipantes.=                            "<div class='d-flex flex-row'>";
            $listaParticipantes.=                                $listaP[$i][2];//Nombre del participante
            $listaParticipantes.=                            "</div>";
            if($listaP[$i][3]==1){
                $listaParticipantes.= "Creador ";
            }
            if($listaP[$i][0]==$_SESSION['ID_USUARIO']){
                $inscrito = 1;//osea si
                $listaParticipantes.= "(Tú)";
            }
            $listaParticipantes.=                            "<div class='px-2 d-flex flex-row-reverse'>";
            $listaParticipantes.=                                $listaP[$i][4];
            $listaParticipantes.=                            "</div>";
            $listaParticipantes.=                        "</div>";
        }
        
        if($info_eventos[0]!= $_SESSION['ID_USUARIO']){//si la id del creador es diferente a la id del usuario
            if($inscrito == 0){//si no esta inscrito
                $inscritoButton = "<a href='../controladorVista/cvInformacionEvento.php?inscrito=0' class='mx-auto mb-2 btn btn-primary'>Inscribirse</a>";
            }else{
                $inscritoButton = "<a href='../controladorVista/cvInformacionEvento.php?inscrito=1' class='mx-auto mb-2 btn btn-primary'>Inscrito</a>";
            }
        }else{//si si lo es
            //TODO: solo dar la opcion de cancelar el evento si la fecha de inicio es mayor a 1 dia  con respecto a la actualy y el tamaño es pequeño
            //Generar la hora actual segun el UTC del usuario
            $fechaAct = new DateTime(mMaster::tiempo()); 
            $fechaInicioEvento = new DateTime($info_eventos[7]);
            
            if($info_eventos[1] == 1 && $fechaInicioEvento > date_modify($fechaAct,"+1 days")){
                //cancelar evento
                $inscritoButton = "<a href='../controladorVista/cvInformacionEvento.php?cancelarEvento=1' class='mx-auto mb-2 btn btn-primary'>Cancelar Evento</a>";
            }
            elseif($info_eventos[1] == 1 && $fechaInicioEvento < $fechaAct){//Mostrar la opcion para poder ingresar la lista de participantes que asistieron
                $inscritoButton = "<a href='../controladorVista/cvInformacionEvento.php?chequearAsistencia=1' class='mx-auto mb-2 btn btn-primary'>Chequear Asistencia</a>";
            }else{
                $inscritoButton = "";
            }
        }
        
        

    echo"<div class='container'>";
    echo    "<div class='infoContainer'>";
    echo        "<div class='header' style='background-image:linear-gradient(to bottom,rgba(255,255,255,0.01) 85%,rgba(255,255,255,0.9)),".$style."'>";
    echo            "<div class='header-content'>";
    echo                "<div class='header-content-title'>";
    echo                    $tipoEv;
    echo                "</div>";
    echo            "</div>";
    echo        "</div>";
    echo        "<div class='container'>";
    echo            "<div class='row'>";
    echo                "<div class='col-sm-6'>";
    echo                    "<div class='description'>";
    echo                        "<b>Creado Por:</b> ".$info_eventos[10];
    echo                        "<br>";
    echo                        "<b>Fecha de inicio:</b> ".mMaster::tiempoTexto($info_eventos[7]);
    echo                        "<br>";
    echo                        "<b>Fecha de finalizacion:</b> ".mMaster::tiempoTexto($info_eventos[8]);
    echo                        "<br>";
    echo                        "<b>Descripcion:</b> ".$info_eventos[4];
    echo                        "<br>";
    echo                        "<a id='mapButton' href='../controladorVista/cvInformacionEvento.php?accion=2&lat=".$info_eventos[5]."&lon=".$info_eventos[6]."&title=".$tipoEv."' class='btn-primary mt-2'>";
    echo                            "<div class='container px-0 py-2'>";
    echo                                "<div class='col-12 mx-auto' style='width:31px; height:31px;'>";
    echo                                    "<img src='./png/menuIcons/mapa.svg' style='width:30px; height:30px; margin:auto;'>";
    echo                                "</div>";
    echo                                "<div class='col-12 mx-auto' style= 'display:table;'>";
    echo                                    "<center>Ubicacion</center>";
    echo                                "</div>";
    echo                            "</div>";
    echo                        "</a>";
    echo                        "<hr size=4 noshade='noshade'>";
    echo                    "</div>";
    echo                    "<div class='d-none d-sm-block'>";
    echo                        "<div class='container'>";
    echo                            "<div class='row'>";
    echo                                $inscritoButton;
    echo                            "</div>";
    echo                        "</div>";
    echo                    "</div>";
    echo                "</div>";
    echo                "<div class='col-sm-6'>";
    echo                    "<div class='players'>";
    echo                        "<div class='plTitle'>".$clasInscritos." ".$info_eventos[11]."/".$info_eventos[2]."</div>";
    echo $listaParticipantes;
    echo                    "</div>";
    echo                "</div>";
    echo                "<div class='d-sm-none'>";
    echo                    "<div class='container'>";
    echo                        "<div class='row'>";
    echo                            $inscritoButton;
    echo                        "</div>";
    echo                    "</div>";
    echo                "</div>";
    echo            "</div>";
    echo        "</div>";
    echo    "</div>";
    echo"</div>";
    ?>
    
</body>
</html>