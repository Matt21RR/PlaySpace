<?php
    include_once("../modelo/mBusqueda.php");
    class cBusqueda{
        /**
         * Realizar la busqueda de las ubicaciones segun las especificaciones del usuario
         * @param   float   coordenadas en latitud del usuario
         * @param   float   coordenadas en longitud del usuario
         * @param   int     Distancia maxima que debe haber entre los resultados de busqueda y el usuario(en Metros)
         *                  (por defecto 1000)
         * @return  array   Resultados de busqueda ó -1 en la posicion [0][0]
         */
        static function realizarBusqueda($latitud,$longitud,$distancia = 1000){
            $coordsConvertidas = self::obtenerUbicacionBusqueda($latitud,$longitud);
            $latRad = $coordsConvertidas[0];
            $lonRad = $coordsConvertidas[1];
            $resultadosEventos = mBusqueda::pedirBusquedaEventos($latRad,$lonRad,$distancia);
            $resultadosTiendas = mBusqueda::pedirBusquedaTiendas($latRad,$lonRad,$distancia);
            //TODO: AGREGAR LA POSICION DONDE TERMINA EL ARRAY DE TIENDAS AL FINAL DEL ARRAY DE RESULTADOS
            if($resultadosEventos[0][0] != -1){
                $resultadosEventos = self::consultarInfoResultadosEventos($resultadosEventos);
                $resultados = $resultadosEventos;
            }
            if($resultadosTiendas[0][0] != -1){
                if(isset($resultados)){
                    $resultados = array_merge($resultados,$resultadosEventos);
                }else{
                    $resultados = $resultadosTiendas;
                }
                
            }
            return $resultados;
        }
        /**
         * Convierte las coordenadas introducidas a radianes
         * @param   float   latitud
         * @param   float   longitud
         * @return  array   latitud en radianes/longitud en radianes
         */
        static function obtenerUbicacionBusqueda($latitud,$longitud){
            include_once("../controlador/cUbicacion.php");
            $coordsRad = cUbicacion::haversinePreComp($latitud,$longitud); //Convertir las coordenadas obtenidas a radianes
            return $coordsRad;
        }

        /**
         * Obtener informacion acerca de los resultados de busqueda de eventos
         * @param   array   resultados de busqueda de eventos
         * @return  array   id del evento | latitud | longitud | distancia | Tipo de ubicacion(Evento)=1 |
         *                   tipo evento | cantidad inscritos | cantidad participantes | fecha inicio | tamaño evento
         */
        static function consultarInfoResultadosEventos($resultados){
            include_once("../controlador/cEventos.php");
            if($resultados[0][0] != -1){
                for($posX = 0;$posX != count($resultados); $posX++){//para cada uno de los resultados
                    $idEvento = intVal($resultados[$posX][0]);
                    $iE = cEventos::consultarInfoBasicaEvento($idEvento);//informacion del evento
                    array_push($resultados[$posX],1,$iE[1],$iE[2],$iE[3],$iE[4],$iE[5]); 
                }
            }
            if($resultados == null)$resultados[0][0] = -1;
            return $resultados;
        }

        /**
         * Obtener informacion acerca de los resultados de busqueda de tiendas
         * @param   array   resultados de busqueda de tiendas
         * @return  array   id del evento | latitud | longitud | distancia | Tipo de ubicacion(Tienda)=2 |
         *                   tipo producto1 | tipo producto2 | tipo producto3 | tipo producto4
         */
        static function consultarInfoResultadosTiendas($resultados){
            //! SIN TERMINAR
            include_once("../controlador/cTiendas.php");
            if($resultados[0][0] != -1){
                for($posX = 0;$posX != count($resultados); $posX++){//para cada uno de los resultados
                    $idEvento = intVal($resultados[$posX][0]);
                    $iE = cEventos::consultarInfoBasicaEvento($idEvento);//informacion del evento
                    array_push($resultados[$posX],1,$iE[1],$iE[2],$iE[3],$iE[4],$iE[5]); 
                }
            }
            if($resultados == null)$resultados[0][0] = -1;
            return $resultados;
        }
    }
