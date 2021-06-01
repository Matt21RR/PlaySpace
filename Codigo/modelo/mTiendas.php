<?php
    include_once('../mMaster.php');
    include_once('../mBaseDatos.php');

    class mTiendas
    {
// ------- |SELECT| ID_TIENDAS/INFO_TIENDA -------------------------------------------------------
        /**
         * Almacena y muestra el ID de las tiendas creadas por un usuario especifico
         * @param   entero  ID del usuario
         * @return  lista   lista de las ID de las tiendas de un usuario
         */
        static function pedirIDTiendasCreador($ID_USUARIO){
            $connect = conexionBaseDatos();

            $sql  = "SELECT * ";
            $sql .= "FROM TIENDAS ";
            $sql .= "WHERE ID_USUARIO = '$ID_USUARIO'";

            $result = $connect -> query($sql);

            //Almacenar las ID de las tiendas
            $cantidadTiendas = 0;
            $info_IDTiendas = null;
            while ($fila = mysqli_fetch_assoc($result)){
                $info_IDTiendas[$cantidadTiendas] = $fila ['ID_TIENDA'];
                $cantidadTiendas++;
            }

            //Salida por consola
            $i = 0;
            $num = 1;
            echo "<script>console.log('mTiendas::pedirIDTiendasCreador')</script>";

            while ( $i < $cantidadTiendas ){
                echo "<script>console.log(' ID_TIENDA #$num: $info_IDTiendas[$i] ')</script>";
                $i++;
                $num++;
            }
            $connect -> close();
            if($info_IDTiendas == null){
                $info_IDTiendas = 0;
            }
            return $info_IDTiendas;
        }

        /**
         * Almacena y muetra la información establecida
         * @param   entero  id del usuario para mostrar la información tienda activa
         * @return  lista   lista de información de la tienda 
         *                      [0] = Nombre Tienda
         *                      [1] = telefono Tienda
         *                      [2] = Correo Tienda
         *                      [3] = Fin publicación Tienda
         *                      [4] = Descripción Tienda
         *                      [5] = Dirección Tienda
         */
        static function pedirInformacionTienda($ID_USUARIO, $ID_TIENDA){
            $connect = conexionBaseDatos();
            
            $sql  = "SELECT * ";
            $sql .= "FROM TIENDAS ";
            $sql .= "WHERE ID_USUARIO = '$ID_USUARIO'";
            $sql .= "AND ID_TIENDA = '$ID_TIENDA'";

            $result = $connect -> query($sql);

            $descripcionVariable = array('NOMBRE_TIENDA','TELEFONO','CORREO', 'FIN_PUBLICACION',
                                        'DESCRIPCION', 'DIRECCION');  //Diccionario de variables a conseguir
            $elementos = (count($descripcionVariable));
            //Almacen de variables en la lista info_tienda
            $i = 0;
            while ($fila = mysqli_fetch_assoc($result)){//realizar la busqueda

                while ($i < $elementos){//ingresar cada uno de los valores de la tienda en una lista
                    $info_tienda[$i] = $fila [$descripcionVariable[$i]];
                    $i++;
                }
            }

            echo "<script>console.log('mTiendas::pedirInformacionTiendas')</script>";

            $connect -> close();
            return $info_tienda;
        }
//------------------------------------------------------------------------------------------------
    }

    