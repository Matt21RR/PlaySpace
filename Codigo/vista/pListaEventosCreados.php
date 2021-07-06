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
    <title>Document</title>
</head>
<body>
    <?php
        $titleSection = "Eventos Creados";
        include_once("./pPlantilla.php");
        if(isset($_GET['evento_creado'])){//se mostrara si se acaba de crear un eventos
            if($_GET['evento_creado'] == 1){
                echo "<script>window.alert('Evento creado con exito!!')</script>";
            }elseif($_GET['evento_creado'] == 2){
                echo "<script>window.alert('El evento no se puede crear porque ya tienes un evento creado')</script>";
            }
        }
    ?>
    <div class="container">
    <div class="container-fluid position-sticky mainListHeader">
            <div class="headerList">Eventos creados</div>
        </div>
            
        <?php
            include_once ("lists/actividades.php");
            include_once ("lists/img-actividades.php");
            include_once ("lists/tamanos.php");

            include_once ("../modelo/lists.php");

            include_once ("../controlador/cEventos.php");
            if(!isset($_SESSION))session_start();

            if(isset($_GET['ID_AMIGO'])){
                $info_eventos = cEventos::consultarEventosCreados($_GET['ID_AMIGO']);
            }else{
                $info_eventos = cEventos::consultarEventosCreados($_SESSION['ID_USUARIO']);
            }
            if($info_eventos[0][0] != -1){
                $cantEv = count($info_eventos);
            }else{
                $cantEv = 0;
            }
            $ruta = "../controladorVista/cvListaEventosInscritos.php?";//ruta del archivo controladorVista
        	if($cantEv != 0){
                for($posX = 0; $posX != $cantEv; $posX++){
                    //DETERMINAR LA CLASIFICACION DE LOS INSCRITOS
                    switch ($info_eventos[$posX][5]) {
                        case 1:
                            $clasInscritos = $nombre_participante[0];//jugadores
                            break;
                        case 2:
                            $clasInscritos = $nombre_participante[2]; //inicializar como equipos
                            for($i = 0; $i != count($individual); $i++){
                                if($individual[$i] == $info_eventos[$posX][1]){
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
                    if($info_eventos[$posX][1]-200 > 0){
                        //el indice que se usara para obtener el nombre del evento 
                        $tipoEvNum = $info_eventos[$posX][1]-201;
                        //Nombre del tipo de evento
                        $tipoEv = $masivos[$tipoEvNum];
                        $style = $img_masivos[$tipoEvNum];
                    }elseif($info_eventos[$posX][1]-100 > 0){
                        $tipoEvNum = $info_eventos[$posX][1]-101;
                        $tipoEv = $ocio[$tipoEvNum];
                        $style = $img_ocio[$tipoEvNum];
                    }else{
                        $tipoEvNum = $info_eventos[$posX][1]-1;
                        $tipoEv = $deportes[$tipoEvNum];
                        $style = $img_deportes[$tipoEvNum];
                    }
                    $style = str_replace("'","&quot;",$style);//previene un error relacionado con las comillas simples
                    
                    echo"<br>";
                    echo"    <a href='".$ruta."ID_EVENTO=".$info_eventos[$posX][0]."' style='white-space: nowrap;'>";
                    echo"        <div class='element mx-3' style='".$style."'>";
                    echo"            <div class='element-content'>";
                    echo"                <div class='element-title'>";
                    echo"                    ".$tipoEv."";
                    echo"                </div>";
                    echo"                ".$info_eventos[$posX][2]."/".$info_eventos[$posX][3]." ".$clasInscritos."<br>";
                    echo"                <div class='text-wrap'><b>Fecha de Inicio: </b>".mMaster::tiempoTexto($info_eventos[$posX][4])."</div>";
                    echo"            </div>";
                    echo"        </div>";
                    echo"    </a>";
                }
            }else{
                echo "<br>";
                echo "<div class='container'>Al parecer no tienes ningun evento creado :/ </div>";
            }
            echo "<div class='container-fluid my-3 text-center'>
                    <a href='".$ruta."CREAR_EVENTO=1' class='btn btn-primary'>Crear evento</a>
                </div>";
        ?>

    </div>
</body>
</html>