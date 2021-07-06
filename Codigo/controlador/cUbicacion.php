<?php
    class cUbicacion{
        /**
         * Obtiene la ubicacion de la seleccion de un punto en el mapa.
         * -Si no se selecciona ninguna ubicacion, la ejecucion del mapa se repite.
         * -Si la distancia entre la ubicacion actual y el punto seleccionado es mayor
         *  a la distancia limite determinada, se repite la ejecucion del mapa.
         * @param   texto   Nombre del archivo al cual hay que enviar las coordenadas.
         * @param   numero  (Default 1000) / Limite entre las distancias de la ubicacion actual y el punto
         *                  seleccionado (en Metros).
         * @return  arreglo Arreglo con las coordenadas.
         */

        static function generarUbicacionSeleccion($nomArch = "",$limiteDistancia = 1000){
            
            $unselectedCoords = 1; //Coordenadas no seleccionadas
            $voidCoords = 1; //Coordenadas vacias
            $coordsOutOfRange = 1; //Coordenadas fuera de rango
            //inicio sesion
            if(!isset($_SESSION))session_start();
            if($nomArch!=""){
                $_SESSION[ 'nomArch' ] = $nomArch;
            }

            if ((array_key_exists('latCustom', $_GET)) && (array_key_exists('lonCustom', $_GET))){
                $unselectedCoords = 0;
                if(($_GET[ 'latCustom' ] != "") && ($_GET[ 'lonCustom' ] != "")){
                    $voidCoords = 0;
                    //OBTENER LOS VALORES
                    $_SESSION[ 'coordsAct0' ] = $_GET[ 'latitud' ];
                    $_SESSION[ 'coordsAct1' ] = $_GET[ 'longitud' ];
                    $_SESSION[ 'coords0' ] = $_GET[ 'latCustom' ];
                    $_SESSION[ 'coords1' ] = $_GET[ 'lonCustom' ];
                    if (cUbicacion::haversineGreatCircleDistance(   $_SESSION[ 'coordsAct0' ],
                                                                    $_SESSION[ 'coordsAct1' ],
                                                                    $_SESSION[ 'coords0' ],
                                                                    $_SESSION[ 'coords1' ]) < $limiteDistancia){
                        $coordsOutOfRange = 0;
                        echo "<p>";
                        echo "<script>console.warn('Distancia entre puntos menor a ".$limiteDistancia."Mts')</script>";
                        echo "<p>";
                        header ("location: ../vista/pUbicacionSeleccionada.php",false);
                    }else{
                        echo "<p>";
                    echo "<script>console.error('Distancia entre puntos mayor a ".$limiteDistancia."Mts')</script>";
                    }
                }
            }
            if(array_key_exists('confirmar', $_GET)){
                if(($_GET[ 'confirmar' ]) == '1'){
                    $_SESSION['latitud'] = $_SESSION['coords0'];
                    $_SESSION['longitud'] = $_SESSION['coords1'];
                    header("location: ".$_SESSION[ 'nomArch' ]."?info=0");
                    exit();
                }else{
                    header("location: ../vista/pUbicacionSeleccionar.php");
                    exit();
                }
            }
            if (($unselectedCoords == 1) || ($voidCoords == 1) || ($coordsOutOfRange == 1)){
            //LLAMAR AL MAPA
                header("location: ../vista/pUbicacionSeleccionar.php");
                exit();
            }
        }
        /**
         * Calcula la distancia entre dos puntos con la formula de Haversine
         * @param float Latitud posicion actual
         * @param float Longitud posicion actual
         * @param float Latitud posicion custom
         * @param float Longitud posicion custom
         * @return float Distancia entre las dos posiciones
         */
        static function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
        {
            $radioTierra = 6371000;
            // CONVERTIR DE GRADOS A RADIANES
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);
            
            //DIFERENCIA ENTRE LATITUDES Y LONGITUDES
            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;
        
            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            if(!isset($_SESSION))session_start();
            $_SESSION['dist'] = ($angle * $radioTierra);
            return $angle * $radioTierra;
        }
        /**
         * Realiza calculos basicos sobre la ubicacion del usuario para realizar
         * la busqueda de puntos de interes. (Convierte las coordenadas de grados a radianes)
         * @param   float   Latitud posicion actual en grados
         * @param   float   Longitud posicion actual en grados
         * @return  array   Longitud y latitud en radianes
         */
        static function haversinePreComp($latActual,$lonActual){
            $latitudRad = deg2rad($latActual);
            $longitudRad = deg2rad($lonActual);
            $coords = array($latitudRad,$longitudRad);
            return $coords;
        }
        static function generarUbicacionGPS(){

        }
    }if (((array_key_exists('latCustom', $_GET)) && (array_key_exists('lonCustom', $_GET))) || array_key_exists('confirmar', $_GET)){//para que no se ejecute apenas se realize el include
        if(!isset($_SESSION))session_start();
        if(array_key_exists('nomArch', $_SESSION)){
            cUbicacion::generarUbicacionSeleccion();
        }
    }
    
    

    
    
    
    