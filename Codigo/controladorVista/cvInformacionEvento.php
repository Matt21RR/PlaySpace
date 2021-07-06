<?php
    include_once ("../controlador/cEventos.php");

    if(!isset($_SESSION))session_start();
    if (isset($_GET['accion'])) {
        $lat = $_GET['lat'];
        $lon = $_GET['lon'];
        $title = $_GET['title'];
        $posiciones[0]=array($_GET[ 'lat' ],$_GET[ 'lon' ],$_GET[ 'title' ]);
        $text = json_encode($posiciones);
        header("location: ../vista/pUbicacionInfoEvento.php?text=".$text);
    }if (isset($_GET['inscrito'])){

        $inscrito = $_GET['inscrito'];
        
        if ($inscrito == 0){
            cEventos::inscribirseEnEvento($_SESSION['ID_EVENTO'],$_SESSION['ID_USUARIO']);
        }elseif($inscrito == 1){
            cEventos::desinscribirseEnEvento($_SESSION['ID_EVENTO'],$_SESSION['ID_USUARIO']);
        }
        header("location: ../vista/pInformacionEvento.php");
    }if (isset($_GET['cancelarEvento'])){// PARA CANCELAR EL EVENTO
        include_once ("../mMaster.php");
        $id_evento = $_SESSION['ID_EVENTO'];
        $info_evento = cEventos::consultarInformacionEvento($id_evento);
        if($info_evento[0]== $_SESSION['ID_USUARIO']){//si la id del creador es igual a la id del usuario
        //se deberia de verificar de nuevo la fecha actual con la del evento
            $fechaAct = date_create(mMaster::tiempo()); 
            $fechaInicioEvento = date_create($info_evento[7]);
            if($info_evento[1] == 1 && $fechaInicioEvento > date_modify($fechaAct,"+1 days")){
                //cancelar evento
                $_SESSION['resultado'] = cEventos::eliminarEvento($_SESSION['ID_USUARIO'],$_SESSION['ID_EVENTO']);
                header("location: ../vista/plistaEventosCreados.php",false);
                exit;
            }
        }
    }
    if(isset($_GET['chequearAsistencia'])){
        header("location: ../vista/pIngresarIDPresentes.php");
        exit;
    }