<?php
    include_once ("../controlador/cEventoCrear.php");
    include_once ("../modelo/mEventoCrear.php");
    if(!isset($_SESSION))session_start();
    $repetir = true;
    while ($repetir == true) {
        $repetir=false;
        
        if (array_key_exists('info',$_GET) && array_key_exists('data',$_SESSION)){

            if(isset($_GET['data'])){
                $data = $_GET[ 'data' ];
                $_SESSION[ 'data' ] = $data;
            }else{
                $data = $_SESSION[ 'data' ];
            }

            if($_GET[ 'info' ] == 0){ // * Si no se ha pedido la informacion(ejecutar las "pantallas")
                switch ($data) {//Segun la informacion que se esta pidiendo hacer
                    case 1: //Pequeño grupo / torneo / masivo
                        header('location: ../vista/pTamanoEvento.php');
                        break;
                    case 2: //Deportivo = cual deporte / Ocio = Que actividad.
                        header('location: ../vista/pTipoEvento.php');
                        break;
                    case 3:// Si es de pequeño grupo o torneo en el caso de que en paso anterior la actividad seleccionda
                        //fuera grupal, especificar la cantidad de grupos o participantes.
                        if($_SESSION['tamano_evento'] != 3){
                            header('location: ../vista/pTamanoEspecifico.php');
                        }
                        else{//si es de tipo masivo
                            cEventoCrear::pedirTamanoEspecifico();//Pasar directamente a ejecutar la función.
                        }
                        break;
                    case 4://UBICACION
                        cEventoCrear::pedirUbicacion();
                        break;
                    case 5://Fecha y hora inicio / fin
                        header('location: ../vista/pTiemposEvento.php');
                        break;
                    case 6://Descripcion
                        header('location: ../vista/pDescripcionEvento.php');
                        break;
                    case 7://Si o no chat
                        cEventoCrear::pedirConfirmacionChat();
                        //! Habilitar cuando se tenga listo el chat
                        //header('location: ../vista/pDecidirChatEvento.php');
                        break;
                    case 8://resumen
                        $_SESSION['ajuste'] = 1;
                        header('location: ../vista/pCreacionEventoResumen.php');
                        break;
                }
            }elseif($_GET[ 'info' ] == 1){//si ya se ha pedido la informacion
                switch ($data) {//Segun la informacion que se esta pidiendo hacer
                    case 0:
                        cEventoCrear::pedirIDCreador();
                        break;
                    case 1: //Pequeño grupo / torneo / masivo
                        cEventoCrear::pedirTamanoEvento();
                        break;
                    case 2: //Deportivo = cual deporte / Ocio = Que actividad.
                        cEventoCrear::pedirTipo();
                        break;
                    case 3:// Si es de pequeño grupo o torneo en el caso de que en paso anterior la actividad seleccionda
                        //fuera grupal, especificar la cantidad de grupos o participantes.
                        cEventoCrear::pedirTamanoEspecifico();
                        break;
                    case 4://UBICACION
                        break;
                    case 5://Fecha y hora inicio / fin
                        cEventoCrear::pedirHora();
                        break;
                    case 6://Descripcion
                        cEventoCrear::pedirDescripcion();
                        break;
                    case 7://Si o no chat
                        cEventoCrear::pedirConfirmacionChat();
                        break;
                }
                $repetir = true;
            }elseif($_GET[ 'info' ] == 400){//Si el usuario ya tiene un evento creado
                header("location: ../vista/pListaEventosCreados.php?evento_creado=2");
                exit;
            }elseif($_GET['info'] == 500){
                mEventoCrear::enviarInformacionEvento($_SESSION['id_usuario'],
                                                    $_SESSION['id_evento'],
                                                    $_SESSION['tamano_evento'],
                                                    $_SESSION['cantidad_paticipantes'],
                                                    $_SESSION['tipo_evento'],
                                                    $_SESSION['descripcion'],
                                                    $_SESSION['latitud'],
                                                    $_SESSION['longitud'],
                                                    $_SESSION['fecha_inicio'],
                                                    $_SESSION['fecha_fin'],
                                                    $_SESSION['chat']
                                                    );
                //Para auto-inscribir al creador del evento
                //en caso de el tamaño del evento sea 1.
                if($_SESSION['tamano_evento']==1){ 
                    mEventos::actualizarListaParticipantes( $_SESSION['id_evento'],
                                                            $_SESSION['id_usuario'],
                                                            1);
                }
                $_SESSION['id_usuario'] = null;
                $_SESSION['id_evento'] = null;
                $_SESSION['tamano_evento'] = null;
                $_SESSION['cantidad_paticipantes'] = null;
                $_SESSION['tipo_evento'] = null;
                $_SESSION['descripcion'] = null;
                $_SESSION['latitud'] = null;
                $_SESSION['longitud'] = null;
                $_SESSION['fecha_inicio'] = null;
                $_SESSION['fecha_fin'] = null;
                $_SESSION['chat'] = null;
                header("location: ../vista/pListaEventosCreados.php?evento_creado=1"); // * EVENTO CREADO, VOLVER A LA PANTALLA DE LISTA EVENTOS CREADOS
                exit();
            }
        }
    }