<?php
    include_once('../mMaster.php');
    include_once('../mBaseDatos.php');

    class mTiendaCrear 
    {
// ------- |INSERT| INFO_TIENDA/PRODUCTOS --------------------------------------------------------
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
         *                      0 = Nombre del producto
         *                      1 = Precio del producto
         *                      2 = Imagen del producto
         */
        static function agregarProductos($ID_TIENDA, $productos){
            $connect = conexionBaseDatos();
            $sql  = "INSERT INTO PRODUCTOS ";
            $sql .= "VALUES ('$ID_TIENDA', '$productos[0]', '$productos[1]', '$productos[2]')";
            
            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);

            echo "<script>console.log('mTiendaCrear::agregarProductos')</script>";
            $connect -> close();
        }

//------------------------------------------------------------------------------------------------
// ------- |UPDATE| INFO_TIENDA/FIN_PUBLICACION --------------------------------------------------
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
        static function actualizarInformacionTienda($ID_USUARIO, 
                                            $ID_TIENDA, 
                                            $NUEVO_NOMBRE_TIENDA, 
                                            $NUEVA_DESCRIPCION, 
                                            $NUEVO_TELEFONO, 
                                            $NUEVO_CORREO, 
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

            echo "<script>console.log('mTiendasCrear.php::actualizarFechaFinPublicacion')</script>";
            $connect -> close();
        }
//------------------------------------------------------------------------------------------------
    }
    