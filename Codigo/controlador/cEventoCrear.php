<?php
    // TODO: COMO USAR:
    // TODO: Paso 1 - Escribir $_GET['info'] = 1;
    // TODO: Paso 2 - Escribir $_SESSION['data'] = 0;
    // TODO: Paso 3 - Llamar al archivo por medio de "include_once ("cEventoCrear.php");"
    include_once ("../modelo/mEventos.php");
    include_once ("../modelo/mEventoCrear.php");
    include_once ('../mMaster.php');
    include_once ("../controlador/cUbicacion.php");
    include_once ("../controlador/cValidacion.php");

    
    class cEventoCrear{
        /**
         * Busca si el usuario tiene creado algun evento
         * @param   numero  id del usuario
         */
        static function pedirIDCreador(){// ? TERMINADO
            //pedir la cantidad de eventos creados
            $eventosCreados = mEventos::pedirIDEventosCreador($_SESSION['ID_USUARIO']);
            if($eventosCreados[0] == -1){
                echo "<script>console.warn('cEventoCrear::pedirIDCreador-> Iniciando creacion de evento')</script>";
                $_SESSION['id_usuario'] = $_SESSION['ID_USUARIO'];
                $_SESSION['id_evento'] = $_SESSION['ID_USUARIO'].""."1";
                $_SESSION['data'] = $_SESSION['data'] + 1;
                $_GET['info'] = 0;
            }else{
                echo "<script>console.error('cEventoCrear::pedirIDCreador-> Ya tienes un evento creado')</script>";
                $_GET['info'] = 400;
            }
            header("location: ../controladorVista/cvEventoCrear.php?info=".$_GET['info']);
        }
        /**
         * Almacena el tamaño de evento que se obtuvo en la pagina para ello.
         */
        static function pedirTamanoEvento(){// ? TERMINADO
            $_SESSION['tamano_evento'] = $_GET['tamano_evento'];
            $_GET['info'] = 0;
            if($_SESSION['ajuste']==0){
                $_SESSION['data'] = $_SESSION['data'] + 1; 
            }else{
                $_SESSION['data'] = 2;//pedir el siguiente dato
                echo $_SESSION['data'];
            }
            header("location: ../controladorVista/cvEventoCrear.php?info=".$_GET['info']);
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
            header("location: ../controladorVista/cvEventoCrear.php?info=".$_GET['info']);
        }
        static function pedirTamanoEspecifico( ){// ? TERMINADO
            include_once ("../modelo/lists.php");
            $tamEv = $_SESSION['tamano_evento'];
            $tipEv = $_SESSION['tipo_evento'];
            if($tamEv != 3){ //Si no es un evento de tipo masivo hacer
                $tamEsEv = $_GET['cantidad_paticipantes'];
                if($tamEv == 1){//un pequeño grupo
                    $iCant = count($individual8)-1;
                    $g1Cant= count($grupal10);
                    $g2Cant= count($grupal12);
                    $g3Cant= count($grupal14);
                    $g4Cant= count($grupal18);
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
                    $iCant = count($individual)-1;
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
                        case 0://tipo torneo individual
                            $tamEsMax = 50;
                            break;
                        case 1:// tipo torneo por grupos
                            $tamEsMax = 30;
                            break;
                    }
                }
                //Comparar la cantidad de participantes introducida con la maxima posible
                if (($tamEsEv<=$tamEsMax) && ($tamEsEv >= 2)){
                    $_SESSION['cantidad_paticipantes'] = $tamEsEv;
                    if($_SESSION['ajuste'] == 0){//Si no se esta realizando un ajuste desde la pantalla de resumen
                        $_SESSION['data'] = $_SESSION['data'] + 1;
                        $_SESSION['mapa'] = 123;
                    }else{//si si
                        $_SESSION['data'] = 8;
                    }
                }
            }elseif($tamEv == 3){//si sí es un evento masivo hacer
                $_SESSION['cantidad_paticipantes'] = 0; //cero = cantidad indefinida
                    if($_SESSION['ajuste'] == 0){//Si no se esta realizando un ajuste desde la pantalla de resumen
                        $_SESSION['data'] = $_SESSION['data'] + 1;
                        $_SESSION['mapa'] = 123;
                    }else{//si si
                        $_SESSION['data'] = 8;
                    }
            }
            $_GET['info'] = 0;//para que muestre la proxima pantalla
            header("location: ../controladorVista/cvEventoCrear.php?info=0");
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
            $fechaAct = date_create(mMaster::tiempo()); 

            $fecha1 = date_create("".$fi." ".$hi.""); //sacar una copia
            $fecha2 = date_create("".$fi." ".$hi."");
            $fecha3 = date_create("".$fi." ".$hi."");
            $fechaFin1 = date_create("".$ff." ".$hf.""); //sacar una copia
            $fechaFin2 = date_create("".$ff." ".$hf."");
            if ((date_modify($fecha1, "-12 hours") <= $fechaAct) || (date_modify($fechaFin1, "-12 hours") <=$fechaAct)){
                echo "la fecha de inicio o la fecha de fin son muy cercanas o inferiores a la actual";
            }elseif($fecha >= date_modify($fechaFin2,"+2 hours")){
                echo "debe de haber minimo una hora entre la fecha de inicio y la fecha de fin";
            }elseif($tipoE == 1 && (date_modify($fecha2, "+12 hours") < $fechaFin)){//fechas E grupal
                echo "No puede haber mas de 12 horas entre la fecha de inicio y la fecha de fin";
            }elseif($tipoE != 1 && (date_modify($fecha3, "+30 days") < $fechaFin)){//fechas E torneo / masivo
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
            header("location: ../controladorVista/cvEventoCrear.php?info=".$_GET['info']);
        }
        static function pedirUbicacion(){ // ? TERMINADO
            $distMax = 2000; //En metros, las distancia maxima que puede haber entre la 
                             //ubicacion actual del usuario y la ubicacion que el seleccione.
            $nomArch = "../controladorVista/cvEventoCrear.php"; //Archivo desde donde se decide que se ejecuta
            
            $_GET['info'] = 0;
            if($_SESSION['ajuste']==0){
                $_SESSION['data'] = $_SESSION['data'] + 1;
                cUbicacion::generarUbicacionSeleccion($nomArch ,$distMax);
            }else{
                $_SESSION['data'] = 8 ;
                header("location: ../vista/pUbicacionSeleccionada.php");
                exit();
            }
            header("location: ../controladorVista/cvEventoCrear.php?info=0");
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
                header("location: ../controladorVista/cvEventoCrear.php?info=".$_GET['info']);
        }
        static function pedirConfirmacionChat(){// ? TERMINADO
            $_SESSION['chat'] = 0;
            // ! habilitar cuando ya se tenga un chat
            //$_SESSION['chat'] = $_GET['chat']; 
            if($_SESSION['ajuste']==0){
                $_SESSION['data'] = $_SESSION['data'] + 1; 
            }else{
                $_SESSION['data'] = 8 ; 
            }
            $_GET['info'] = 0;
            header("location: ../controladorVista/cvEventoCrear.php?info=".$_GET['info']);
        }
    }
    //cEventoCrear::pedirUbicacion();
    //cEventoCrear::pedirIDCreador(5);
    //$f = array (2021,05,25,12,10);
    //cEventoCrear::pedirHora($f);