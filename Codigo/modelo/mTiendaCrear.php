<?php
    include_once('../mMaster.php');
    include_once('../mBaseDatos.php');

    class mTiendaCrear 
    {
// ------- CREAR INFO_TIENDA / PRODUCTOS / TIPO_PRODUCTOS -----------------------------------------
        /**
         * Creación de tiendas
         * @param   entero  id del usuario|Solo hacer mension del mismo|no subministrar ningun valor
         * @param   entero  id de la tienda
         * @param   texto   nombre de la tienda
         * @param   texto   descripción de la tienda
         * @param   entero  telefono de la tienda
         * @param   texto   correo de la tienda
         * @param   texto   dirección de la tienda
         */
        static function enviarInformacionTienda($ID_USUARIO, $ID_TIENDA, $NOMBRE_TIENDA, 
                                                $DESCRIPCION, $TELEFONO, $CORREO, 
                                                $DIRECCION, $FIN_PUBLICACION){
            $connect = conexionBaseDatos();

            $sql  = "INSERT INTO TIENDAS ";
            $sql .= "VALUES ('$ID_USUARIO', ";
            $sql .= "'$ID_TIENDA', ";
            $sql .= "'$NOMBRE_TIENDA', ";
            $sql .= "6.578139480, ";
            $sql .= "3.8902312, ";
            $sql .= "'$DESCRIPCION', ";
            $sql .= "'$TELEFONO', ";
            $sql .= "'$CORREO', ";
            $sql .= "'$DIRECCION', ";
            $sql .= "'$FIN_PUBLICACION')";

            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);

            echo "<script>console.log('mCrearTienda::enviarInformacionTienda')</script>";
            $connect -> close();
        }
        /**
         * Subir productos a una tienda especifica
         * @param   entero  ID de la tienda en donde se subira el producto
         * @param   lista   Lista de los elementos que conforman al producto 
         *                  que seran almacenados en la base de datos
         *                      [0] = Nombre del producto
         *                      [1] = Precio del producto
         *                      [2] = Ruta de la imagen del producto
         *                      [3] = ID del producto
         */
        static function agregarProductos($ID_TIENDA, $productos){
            $connect = conexionBaseDatos();
            $sql  = "INSERT INTO PRODUCTOS ";
            $sql .= "VALUES ('$ID_TIENDA','$productos[3]','$productos[0]','$productos[1]','$productos[2]')";
            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);

            echo "<script>console.log('mTiendaCrear::agregarProductos')</script>";
            $connect -> close();
        }
        /**
         * Ingresa los tipos de actividades con los que la tienda tiene productos
         * @param   entero  ID Tienda
         * @param   entero  Número tipo de actividad
         */
        static function tipoProducto($ID_TIENDA, $tipoProducto){
            $connect = conexionBaseDatos();

            $sql = "INSERT INTO TIPO_PRODUCTOS 
                    VALUES ('$ID_TIENDA', '$tipoProducto');";

            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);

            $connect -> close();
        }
// ------- ACTUALIZAR INFO_TIENDA / FIN_PUBLICACION / PRUEBA_TIENDA -------------------------------
        /**
         * Actualiza la infromación de la tienda
         * @param   entero  id del usuario|Solo hacer mension del mismo|no subministrar ningun valor
         * @param   entero  id de la tienda|Solo hacer mension del mismo|no subministrar ningun valor
         * @param   texto   nuevo nombre de la tienda
         * @param   texto   nueva descripción de la tienda
         * @param   entero  nuevo telefono de la tienda
         * @param   texto   nuevo correo de la tienda
         * @param   texto   nueva dirección de la tienda
         */
        static function actualizarInformacionTienda($ID_USUARIO, $ID_TIENDA, 
                                            $NUEVO_NOMBRE_TIENDA, $NUEVA_DESCRIPCION, 
                                            $NUEVO_TELEFONO, $NUEVO_CORREO, 
                                            $NUEVA_DIRECCION){
            $connect = conexionBaseDatos();

            $sql  = "UPDATE TIENDAS ";
            $sql .= "SET NOMBRE_TIENDA = '$NUEVO_NOMBRE_TIENDA', ";
            $sql .= "DESCRIPCION = '$NUEVA_DESCRIPCION', ";
            $sql .= "TELEFONO = '$NUEVO_TELEFONO', ";
            $sql .= "CORREO = '$NUEVO_CORREO', ";
            $sql .= "DIRECCION = '$NUEVA_DIRECCION' ";
            $sql .= "WHERE ID_TIENDA = '$ID_TIENDA' ";
            $sql .= "and ID_USUARIO = '$ID_USUARIO'";

            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);

            echo "<script>console.log('mCrearTienda::actualizarInformacionTienda')</script>";
            $connect -> close();
        }
        /**
         * Actualizar la fecha fin de la publicación de la tienda en la base de datos
         * @param   entero  ID de usuario
         * @param   entero  ID de la tienda del usuario
         * @param   texto   fecha fin de la publicación 
         */
        static function actualizarFechaFinPublicacion($ID_USUARIO, $ID_TIENDA, $FIN_PRUBLICACION){
            $connect = conexionBaseDatos();

            $sql  = "UPDATE TIENDAS "; 
            $sql .= "SET FIN_PUBLICACION = '$FIN_PRUBLICACION' ";
            $sql .= "WHERE ID_USUARIO = '$ID_USUARIO' ";
            $sql .= "AND ID_TIENDA = '$ID_TIENDA'";

            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);

            echo "<script>console.log('mTiendasCrear::actualizarFechaFinPublicacion')</script>";
            $connect -> close();
        }
        /**
         * Deshabilita la opción gratuita (Prueba) de 7 días al crear una tienda
         * @param   entero  ID de usuario
         */
        static function deshabilitarTiempoPublicacionPrueba($ID_USUARIO){
            $connect = conexionBaseDatos();

            $sql  = "UPDATE TIENDAS "; 
            $sql .= "SET TIENDA_PRUEBA = -1 ";
            $sql .= "WHERE ID_USUARIO = '$ID_USUARIO'";

            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);

            echo "<script>console.log('mTiendasCrear::deshabilitarTiempoPublicaciónPrueba')</script>";
            $connect -> close();
        }
//-------- COMPROBAR REPETIDO NOMBRE_TIENDA --------------------------------------------------------
        /**
         * Comprobar que el nombre de la tienda no se encuentre registrado por otro o él mismo usuario
         * @param   texto   Nombre de la tienda
         * @return  entero  0 = Nombre no repetido
         *                  1 = Nombre repetido
         */
        static function comprobarNombreTiendaRepetido($NOMBRE_TIENDA){
            $connect = conexionBaseDatos();
            $nombre_tiendas = 0;
            
            $sql = "SELECT NOMBRE_TIENDA FROM TIENDAS 
                    WHERE NOMBRE_TIENDA = '$NOMBRE_TIENDA'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $nombre_tiendas = $fila ['NOMBRE_TIENDA'];
            }
            if ($nombre_tiendas!=0){
                $repetido = 1;
            }else{
                $repetido = 0;
            }

            $tipoMensaje = "log";
            if($repetido == 1){
                $tipoMensaje = "error";
            }
            echo "<script>console.$tipoMensaje('mTiendaCrear::comprobarNombreTiendaRepetido-> $repetido')</script>";
            $connect->close();
            return $repetido;
        }
//-------- ELIMINAR TIENDA / PRODUCTOS ------------------------------------------------------------
    }