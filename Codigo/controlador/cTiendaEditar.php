<?php
    include_once('cTiendaCrear.php');
    include_once('../modelo/mTiendas.php');             //Temporal

    class cTiendaEditar
    {
        /**
             * Actualiza los la fecha fin de la publicación de la tienda de un usuario
             * @param   entero  ID del usuario
             * @param   entero  paquete seleecionado por el usuario 
             *                          0 = 7 días
             *                          1 = 30 días
             *                          2 = 60 días
             *                          3 = 90 días
             *                          4 = 120 días
             * @param   entero ID de la tienda 
             */
        static function asignarFechaFinPublicacion($ID_USUARIO, $tiempoCompra, $ID_TIENDA){
                $FIN_PUBLICACION = cTiendaCrear::ofrecerEspacioPublicitario($ID_USUARIO, $tiempoCompra);
                self::actualizarFechaFinPublicacion($ID_USUARIO, $ID_TIENDA, $FIN_PUBLICACION);
        }

        /**
         * Actualizar datos basicos seleccionados de la tienda
         * @param   entero  ID de la cuenta con tienda
         * @param   entero  ID de la tienda
         * @param   texto   Nuevo NOMBRE_TIENDA
         * @param   texto   Nueva DESCRIPCION
         * @param   texto   Nuevo TELEFONO
         * @param   texto   Nuevo CORREO
         * @param   texto   Nueva DIRECCION
         */
        static function ActualizarTienda($ID_USUARIO, $ID_TIENDA, 
                                            $NUEVO_NOMBRE_TIENDA=0, 
                                            $NUEVA_DESCRIPCION=0, 
                                            $NUEVO_TELEFONO=0, 
                                            $NUEVO_CORREO=0, 
                                            $NUEVA_DIRECCION=0){
            $actualizar = 1;

            $almacenDatos = [$NUEVO_NOMBRE_TIENDA, $NUEVA_DESCRIPCION, $NUEVO_TELEFONO,
                             $NUEVO_CORREO, $NUEVA_DIRECCION];
            $posicionDatosObtener = [0, 4, 1, 2, 5];
            $posicionDatosValidar = [0, 1, 4, 6, 2];

            $info_Tienda = mTiendas::pedirInformacionTienda($ID_USUARIO, $ID_TIENDA);
            
            for($i=0; $i<count($almacenDatos); $i++){
                if($almacenDatos[$i] == 0){
                    $datosTienda[$i] = $info_Tienda[$posicionDatosObtener[$i]];
                } else{
                    if(cTiendaCrear::validarDatosTienda($almacenDatos[$i], $posicionDatosValidar[$i])!=0){
                        $datosTienda[$i] = $almacenDatos[$i];
                    } else{
                        $actualizar = -1;
                    }           
                }
            }

            if($actualizar==1){
                mTiendaCrear::actualizarInformacionTienda($ID_USUARIO, $ID_TIENDA, 
                                                        $datosTienda[0], $datosTienda[1], 
                                                        $datosTienda[2], $datosTienda[3], 
                                                        $datosTienda[4]);
            }

            echo "<script>console.log('cTiendaEditar::ActualizarTienda')</script>";
        }
    }