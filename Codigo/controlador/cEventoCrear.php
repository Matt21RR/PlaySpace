<?php
    // TODO: COMO USAR:
    // TODO: Paso 1 - Escribir $_GET['info'] = 1;
    // TODO: Paso 2 - Escribir $_SESSION['data'] = 0;
    // TODO: Paso 3 - Llamar al archivo por medio de "include_once ("cEventoCrear.php");"
    include_once ("../modelo/mEventos.php");
    include_once ("../modelo/mEventoCrear.php");
    include_once ('../mMaster.php');
    include_once ("cUbicacion.php");
    include_once ("cValidacion.php");

    
    class cEventoCrear{
        /**
         * Busca si el usuario tiene creado algun evento
         * @param   numero  id del usuario
         */
        static function pedirIDCreador($id_usuario=4){// ? TERMINADO
            if((mEventos::pedirIDEventosCreador($id_usuario))[0] == -1){
                echo "<script>console.warn('cEventoCrear::pedirIDCreador-> Iniciando creacion de evento')</script>";
                $_SESSION['id_usuario'] = $id_usuario;
                $_SESSION['id_evento'] = "$id_usuario"."1";
                $_SESSION['data'] = $_SESSION['data'] + 1;
                $_GET['info'] = 0;
            }else{
                $_GET['info'] = 400;
            }
        /**
         * Almacena el tamaño de evento que se obtuvo en la pagina para ello.
         */
        }static function pedirTamanoEvento(){// ? TERMINADO
            $_SESSION['tamano_evento'] = $_GET['tamano_evento'];
            $_GET['info'] = 0;
            if($_SESSION['ajuste']==0){
                $_SESSION['data'] = $_SESSION['data'] + 1; 
            }else{
                $_SESSION['data'] = 2;//pedir el siguiente dato
                echo $_SESSION['data'];
            }
            
        }
        /**
         * Almacena el tipo de evento que se obtuvo en la pagina para ello.
         */
        static function pedirTipo(){// ? TERMINADO
            $_SESSION['tipo_evento'] = $_GET['tipo_evento'];
            $_GET['info'] = 0;
            if($_SESSION['ajuste']==0){
                $_SESSION['data'] = $_SESSION['data'] + 1; 
            }else{
                $_SESSION['data'] = 3;//pedir el siguiente dato
            }
        }
        static function pedirTamanoEspecifico( ){// ? TERMINADO
            $tamEsEv = $_GET['cantidad_paticipantes'];
            $tamEv = $_SESSION['tamano_evento'];
            $tipEv = $_SESSION['tipo_evento'];
            if($tamEv == 1){//un pequeño grupo
                $individual8 = array(4,5,6,7,8,9,11,16,20,21,22,23,101,102,103,104);//8 personas
                $iCant = count($individual8)-1;
                $grupal10 = array(2,10);//10 personas en partido
                $g1Cant= count($grupal10);
                $grupal12 = array(1,19);//12
                $g2Cant= count($grupal12);
                $grupal14 = array(12,13,17);//14
                $g3Cant= count($grupal14);
                $grupal18 = array(14);//18
                $g4Cant= count($grupal18);
                $grupal22 = array(3,15,18,24);//22
                $g5Cant= count($grupal22);
                //Para saber donde termina un grupo de tipos de eventos
                $posListArray = array(  $iCant,
                                        $iCant + $g1Cant,
                                        $iCant + $g1Cant + $g2Cant,
                                        $iCant + $g1Cant + $g2Cant + $g3Cant,
                                        $iCant + $g1Cant + $g2Cant + $g3Cant + $g4Cant,
                                        $iCant + $g1Cant + $g2Cant + $g3Cant + $g4Cant + $g5Cant);
                $listTipEv = array_merge($individual8,$grupal10,$grupal12,$grupal14,$grupal18,$grupal22);
            }elseif($tamEv == 2){
                $individual = array(4,5,6,7,8,9,11,16,20,21,22,23,101,102,103,104);//40 participantes
                $iCant = count($individual)-1;
                $grupal = array(1,2,3,10,12,13,14,15,17,18,19,24);//20 equipos
                $gCant = count($grupal);
                
                $posListArray = array( $iCant, $iCant+$gCant);//Para saber donde termina un grupo de tipos de eventos
                $listTipEv = array_merge($individual,$grupal);//Lista de todos los tipos de eventos
            }
            $posX = 0;
            $cantTipEv = count($listTipEv);//Cantidad de tipos de eventos
            while($cantTipEv != $posX){
                if($tipEv == $listTipEv[$posX]){//si el tipo de evento concuerda con uno que esta en la lista
                    $posListPos = 0; //posicion en la lista de posiciones
                    while($posListPos != count($posListArray)){
                        if ($posX <=  $posListArray[$posListPos]){
                            echo $posX." - ".$posListArray[$posListPos];
                            break 2;
                        }
                        $posListPos++;
                    }
                }
                $posX++;
            }

            if($tamEv == 1){
                switch ($posListPos) {//Indica al grupo de tamaños de eventos al cual pertenece este
                    case 0:
                        $tamEsMax = 8;
                        break;
                    case 1:
                        $tamEsMax = 10;
                        break;
                    case 2:
                        $tamEsMax = 12;
                        break;
                    case 3:
                        $tamEsMax = 14;
                        break;
                    case 4:
                        $tamEsMax = 18;
                        break;
                    case 5:
                        $tamEsMax = 22;
                        break;
                }
            }elseif($tamEv == 2){
                switch ($posListPos) {
                    case 0:
                        $tamEsMax = 40;
                        break;
                    case 1:
                        $tamEsMax = 20;
                        break;
                }
            }
            $_GET['info'] = 0;
            if (($tamEsEv<=$tamEsMax) && ($tamEsEv >= 2)){
                $_SESSION['cantidad_paticipantes'] = $tamEsEv;
                if($_SESSION['ajuste'] == 0){
                    $_SESSION['data'] = $_SESSION['data'] + 1;
                }else{
                    $_SESSION['data'] = 8;
                }
            }
        }
        static function pedirHora(){// ? TERMINADO
            $todoCorrecto = 0;//para verificar que todo este bien con la fecha
            $fi = urldecode($_GET['fecha_inicio']);
            $hi = urldecode($_GET['hora_inicio']);
            $ff = urldecode($_GET['fecha_fin']);
            $hf = urldecode($_GET['hora_fin']);
            $utc = urldecode($_GET['utc']); //obtener la zona horaria del dispositivo del usuario
            $tamanoE = $_SESSION['tamano_evento'];

            //fecha de inicio dada por el usuario
            $fecha = date_create("".$fi." ".$hi."");
            //fecha de finalizacion dada por el usuario
            $fechaFin = date_create("".$ff." ".$hf."");
            //Generar la hora actual segun el UTC del usuario
            $fechaAct = date_create(mMaster::tiempo($utc)); 

            $fecha1 = date_create("".$fi." ".$hi.""); //sacar una copia
            $fecha2 = date_create("".$fi." ".$hi."");
            $fecha3 = date_create("".$fi." ".$hi."");
            $fechaFin1 = date_create("".$ff." ".$hf.""); //sacar una copia
            $fechaFin2 = date_create("".$ff." ".$hf."");
            if ((date_modify($fecha1, "-12 hours") <= $fechaAct) || (date_modify($fechaFin1, "-12 hours") <=$fechaAct)){
                echo "la fecha de inicio o la fecha de fin son muy cercanas o inferiores a la actual";
            }elseif($fecha >= date_modify($fechaFin2,"+2 hours")){
                echo "debe de haber minimo una hora entre la fecha de inicio y la fecha de fin";
            }elseif($tipoE == 1 && (date_modify($fecha2, "+1 days") < $fechaFin)){//fechas E grupal
                echo "No puede haber mas de un dia entre la fecha de inicio y la fecha de fin";
            }elseif($tipoE != 1 && (date_modify($fecha3, "+1 months") < $fechaFin)){//fechas E torneo / masivo
                echo "No puede haber mas de un mes entre la fecha de inicio y la fecha de fin";
            }else{
                $todoCorrecto = 1;
            }
            $_GET['info'] = 0;
            if ($todoCorrecto == 1){
                if($_SESSION['ajuste']==0){
                    $_SESSION['data'] = $_SESSION['data'] + 1; 
                }else{
                    $_SESSION['data'] = 8 ; 
                }
                //transformar el objeto de la fecha a texto plano
                $_SESSION['fecha_inicio'] = $fecha->format('Y-m-d H:i');
                $_SESSION['fecha_fin'] = $fechaFin->format('Y-m-d H:i');
            }
        }
        static function pedirUbicacion(){ // ? TERMINADO
        
            $distMax = 1000; //En metros, las distancia maxima que puede haber entre la 
                             //ubicacion actual del usuario y la ubicacion que el seleccione.
            $nomArch = "cEventoCrear.php"; //Nombre de este archivo
            
            $_GET['info'] = 0;
            if($_SESSION['ajuste']==0){
                cUbicacion::generarUbicacionSeleccion($nomArch ,$distMax);
                $_SESSION['data'] = $_SESSION['data'] + 1;
            }else{
                header("location: ./vUbicacionSeleccionada.php");
                $_SESSION['data'] = 8;
            }
        }
        static function pedirDescripcion(){// ? TERMINADO
            $descripcion = $_GET['descripcion'];
            echo $descripcion;
            if( (cValidacion::validarTexto($descripcion) == 1) && //si no tiene caracteres extraños
                (cValidacion::busquedaGeneralPalabrasNoPermitidas($descripcion) == 0) && // ni malas palabras
                (strlen($descripcion) <= 250)){//y tiene menos de 251 caracteres
                    $_SESSION['descripcion'] = $descripcion;
                    if($_SESSION['ajuste']==0){
                        $_SESSION['data'] = $_SESSION['data'] + 1; 
                    }else{
                        $_SESSION['data'] = 8 ; 
                    }
                }
                $_GET['info'] = 0;
        }
        static function pedirConfirmacionChat(){// ? TERMINADO
            $_SESSION['chat'] = $_GET['chat'];
            if($_SESSION['ajuste']==0){
                $_SESSION['data'] = $_SESSION['data'] + 1; 
            }else{
                $_SESSION['data'] = 8 ; 
            }
            $_GET['info'] = 0;
            //$_GET['info'] = 500;//Empezar con la creacion del evento (Envio de datos)
        }
        static function crearEvento(){
            if(!isset($_SESSION))session_start();
            if (array_key_exists('info',$_GET) && array_key_exists('data',$_SESSION)){

                if(array_key_exists('data',$_GET)){
                    $data = $_GET[ 'data' ];
                    $_SESSION[ 'data' ] = $data;
                }else{
                    $data = $_SESSION[ 'data' ];
                }

                if($_GET[ 'info' ] == 0){ // * Si no se ha pedido la informacion(ejecutar las "pantallas")
                    switch ($data) {//Segun la informacion que se esta pidiendo hacer
                        case 1: //Pequeño grupo / torneo / masivo
                            header('location: ../vista/vEventoCrear/pTamanoEvento.php');
                            break;
                        case 2: //Deportivo = cual deporte / Ocio = Que actividad.
                            header('location: ../vista/vEventoCrear/pTipoEvento.php');
                            break;
                        case 3:// Si es de pequeño grupo o torneo en el caso de que en paso anterior la actividad seleccionda
                            //fuera grupal, especificar la cantidad de grupos o participantes.
                            header('location: ../vista/vEventoCrear/pTamanoEspecifico.php');
                            break;
                        case 4://UBICACION
                            self::pedirUbicacion();
                            break;
                        case 5://Fecha y hora inicio / fin
                            header('location: ../vista/vEventoCrear/pTiemposEvento.php');
                            break;
                        case 6://Descripcion
                            header('location: ../vista/vEventoCrear/pDescripcionEvento.php');
                            break;
                        case 7://Si o no chat
                            header('location: ../vista/vEventoCrear/pDecidirChatEvento.php');
                            break;
                        case 8://resumen
                            $_SESSION['ajuste'] = 1;
                            header('location: ../vista/vEventoCrear/pCreacionEventoResumen.php');
                            break;
                    }
                }elseif($_GET[ 'info' ] == 1){//si ya se ha pedido la informacion
                    switch ($data) {//Segun la informacion que se esta pidiendo hacer
                        case 0:
                            self::pedirIDCreador();
                            break;
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
                            break;
                        case 5://Fecha y hora inicio / fin
                            self::pedirHora();
                            break;
                        case 6://Descripcion
                            self::pedirDescripcion();
                            break;
                        case 7://Si o no chat
                            self::pedirConfirmacionChat();
                            break;
                    }
                    echo $_SESSION['ajuste'];
                    echo $_SESSION['data'];
                    echo $_SESSION['err'];
                    self::crearEvento();
                }elseif($_GET[ 'info' ] == 400){//Si el usuario ya tiene un evento creado
                    return -1;// * NO SE PUDO CREAR EL EVENTO
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
                    return 1; // * EVENTO CREADO
                }
            }
        }
    }
    cEventoCrear::crearEvento();
    if(!isset($_SESSION))session_start();
    echo $_SESSION['data'];
    echo $_GET['info'];
    //cEventoCrear::pedirUbicacion();
    //cEventoCrear::pedirIDCreador(5);
    //$f = array (2021,05,25,12,10);
    //cEventoCrear::pedirHora($f);