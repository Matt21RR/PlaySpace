<?php
    include_once ("../modelo/mEventos.php");
    include_once ('../mMaster.php');
    include_once ("cUbicacion.php");

    //! EJECUTAR PRIMERO GET INFO =1 SESSION DATA = 0
    if (array_key_exists('info',$_GET) && array_key_exists('data',$_SESSION)){
        if($_GET[ 'info' ] == 0){ // * Si no se ha pedido la informacion(ejecutar las "pantallas")
            switch ($_SESSION[ 'data' ]) {//Segun la informacion que se esta pidiendo hacer
                case 1: //Pequeño grupo / torneo / masivo
                    header('location: ../vista/pTamanoEvento.php');
                    break;
                case 2: //Deportivo = cual deporte / Ocio = Que actividad.
                    header('location: ../vista/pTipoEvento.php');
                    break;
                case 3:// Si es de pequeño grupo o torneo en el caso de que en paso anterior la actividad seleccionda
                    //fuera grupal, especificar la cantidad de grupos o participantes.
                    header('location: ../vista/pTamanoEspecifico.php')
                    break;
                case 4://UBICACION
                    cEventoCrear::pedirUbicacion()
                    break;
                case 5://Fecha y hora inicio / fin
                    header('location: ../vista/pTiemposEvento.php');
                    break;
                case 6://Descripcion
                    header('location: ../vista/pDescripcionEvento.php');
                    break;
                case 7://Si o no chat
                    header('location: ../vista/pDecidirChatEvento.php');
                    break;

            }
        }else{//si ya se ha pedido la informacion
            switch ($_SESSION[ 'data' ]) {//Segun la informacion que se esta pidiendo hacer
                case 0:
                    self::pedirIDCreador();
                case 1: //Pequeño grupo / torneo / masivo
                    self::pedirTamanoEvento();
                    break;
                case 2: //Deportivo = cual deporte / Ocio = Que actividad.
                    self::pedirTipo();
                    break;
                case 3:// Si es de pequeño grupo o torneo en el caso de que en paso anterior la actividad seleccionda
                    //fuera grupal, especificar la cantidad de grupos o participantes.
                    self::pedirTamanoEspecifico();
                    break;
                case 4://UBICACION
                    self::pedirUbicacion();
                    break;
                case 5://Fecha y hora inicio / fin
                    self::pedirHora();
                    break;
                case 6://Descripcion
                    self::pedirDescripcion();
                    break;
                case 7://Si o no chat
                    self::pedirChat();
                    break;
            }
        }
    }
    class cEventoCrear{
        /**
         * Busca si el usuario tiene creado algun evento
         * @param   numero  id del usuario
         * @return  numero  id del usaurio si este no tiene ningun evento ya creado | -1 en el caso contrario
         */
        static function pedirIDCreador($id_usuario){// ! SIN TERMINAR
            if((mEventos::pedirIDEventosCreador($id_usuario))[0] == -1){
                echo "<script>console.warn('cEventoCrear::pedirIDCreador-> Iniciando creacion de evento')</script>";
                return $id_usuario;
            }else{
                echo "<script>console.error('cEventoCrear::pedirIDCreador-> Ya tienes otros eventos creados')</script>";
                return -1;
            }
        /**
         * Almacena el tamaño de evento que se obtuvo en la pagina para ello.
         */
        }static function pedirTamanoEvento(){// ? TERMINADO
            $_SESSION['tamano_evento'] = $_GET['tamano_evento'];
            $_GET['info'] = 0;
            $_SESSION['data'] = $_SESSION['data'] + 1;
        }
        /**
         * Almacena el tipo de evento que se obtuvo en la pagina para ello.
         */
        static function pedirTipo(){// ? TERMINADO
            $_SESSION['tipo_evento'] = $_GET['tipo_evento'];
            $_GET['info'] = 0;
            $_SESSION['data'] = $_SESSION['data'] + 1;
        }
        static function pedirTamanoEspecifico( ){
            $tamEsEv = $_GET['tamano_especifico'];
            $tamEv = $_SESSION['tamano_evento'];
            $tipEv = $_SESSION['tipo_evento'];
        }
        static function pedirHora(){// ? TERMINADO
            $todoCorrecto = 0;//para verificar que todo este bien con la fecha
            $fi = $_GET['fecha_inicio'];
            $hi = $_GET['hora_inicio'];
            $ff = $_GET['fecha_fin'];
            $hf = $_GET['hora_fin'];
            $utc = $_GET['utc']; //obtener la zona horaria del dispositivo del usuario
            $tamanoE = $_SESSION['tamano_evento'];

            //fecha de inicio dada por el usuario
            $fecha = date_create("".$fi[0]."-".$fi[1]."-".$fi[2]." ".$hi[0].":".$hi[2]."");
            //fecha de finalizacion dada por el usuario
            $fechaFin = date_create("".$ff[0]."-".$ff[1]."-".$ff[2]." ".$hf[0].":".$hf[2]."");
            //Generar la hora actual segun el UTC del usuario
            $fechaAct = date_create(mMaster::tiempo($utc)); 
            if ((date_modify($fecha, "-12 hours") <= $fechaAct) || (date_modify($fechaFin, "-12 hours") <=$fechaFin)){
                echo "la fecha de inicio o la fecha de fin son muy cercanas o inferiores a la actual";
            }elseif($fecha>date_modify($fechaFin,"+1 hours")){
                echo "debe de haber minimo una hora entre la fecha de inicio y la fecha de fin";
            }elseif($tipoE == 1 && (date_modify($fecha, "+1 days") < $fechaFin)){//fechas E grupal
                echo "No puede haber mas de un dia entre la fecha de inicio y la fecha de fin";
            }elseif($tipoE != 1 && (date_modify($fecha, "+1 months") < $fechaFin)){//fechas E torneo / masivo
                echo "No puede haber mas de un mes entre la fecha de inicio y la fecha de fin";
            }else{
                $todoCorrecto = 1;
            }
            $_GET['info'] = 0;
            if ($todoCorrecto == 1){
                $_SESSION['data'] = $_SESSION['data'] + 1;
                //transformar el objeto de la fecha a texto plano
                $_SESSION['fecha_inicio'] = $fecha->format('Y-m-d H:i:s');
                $_SESSION['fecha_fin'] = $fechaFin->format('Y-m-d H:i:s');
            }
        }
        static function pedirUbicacion(){ // ? TERMINADO
        
            $distMax = 1000; //En metros, las distancia maxima que puede haber entre la 
                             //ubicacion actual del usuario y la ubicacion que el seleccione.
            $nomArch = "cEventoCrear.php"; //Nombre de este archivo
            cUbicacion::generarUbicacionSeleccion($nomArch ,$distMax);

        }
        static function crearEvento(){
            
        }
    }
    //cEventoCrear::pedirUbicacion();
    //cEventoCrear::pedirIDCreador(5);
    //$f = array (2021,05,25,12,10);
    //cEventoCrear::pedirHora($f);