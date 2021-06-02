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

        static function generarUbicacionSeleccion($nomArch,$limiteDistancia = 1000){
            
            $unselectedCoords = 1; //Coordenadas no seleccionadas
            $voidCoords = 1; //Coordenadas vacias
            $coordsOutOfRange = 1; //Coordenadas fuera de rango
            
            if ((array_key_exists('latCustom', $_GET)) && (array_key_exists('lonCustom', $_GET))){
                $unselectedCoords = 0;
                if(($_GET[ 'latCustom' ] != "") && ($_GET[ 'lonCustom' ] != "")){
                    $voidCoords = 0;
                    //OBTENER LOS VALORES
                    $coordsAct[0] = $_GET[ 'latitud' ];
                    $coordsAct[1] = $_GET[ 'longitud' ];
                    $coords[0] = $_GET[ 'latCustom' ];
                    $coords[1] = $_GET[ 'lonCustom' ];
                    if (cUbicacion::haversineGreatCircleDistance($coordsAct[0],$coordsAct[1],$coords[0],$coords[1]) < $limiteDistancia){
                        $coordsOutOfRange = 0;
                        echo "<p>";
                        echo "<script>console.warn('Distancia entre puntos menor a ".$limiteDistancia."Mts')</script>";
                        echo "<p>";
                        include ("vUbicacionSeleccionada.php");
                    }else{
                        echo "<p>";
                    echo "<script>console.error('Distancia entre puntos mayor a ".$limiteDistancia."Mts')</script>";
                    }
                }
            }
            if (($unselectedCoords == 1) || ($voidCoords == 1) || ($coordsOutOfRange == 1)){
            //LLAMAR AL MAPA
            
                include_once ("vUbicacion.php");
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
            return $angle * $radioTierra;
        }
    }

    
    cUbicacion::generarUbicacionSeleccion("cUbicacion.php");

    

    
    
    
    