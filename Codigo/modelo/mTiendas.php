<?php
    include_once('../mMaster.php');
    include_once('../mBaseDatos.php');

    class mTiendas
    {
// ------- MOSTRAR ID_TIENDAS / INFO_TIENDA -------------------------------------------------------
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
         * @param   entero  id de la tienda
         * @return  lista   lista de información de la tienda 
         *                      [0] = Nombre Tienda
         *                      [1] = telefono Tienda
         *                      [2] = Correo Tienda
         *                      [3] = Fin publicación Tienda
         *                      [4] = Descripción Tienda
         *                      [5] = Dirección Tienda
         *                      [6] = ID Tienda
         */
        static function pedirInformacionTienda($ID_TIENDA){
            $connect = conexionBaseDatos();
            
            $sql  = "SELECT * ";
            $sql .= "FROM TIENDAS ";
            $sql .= "WHERE ID_TIENDA = '$ID_TIENDA'";

            $result = $connect -> query($sql);

            $descripcionVariable = array('NOMBRE_TIENDA','TELEFONO','CORREO', 'FIN_PUBLICACION',
                                        'DESCRIPCION', 'DIRECCION', 'ID_TIENDA');  //Diccionario de variables a conseguir
            //Almacen de variables en la lista info_tienda
            while ($fila = mysqli_fetch_assoc($result)){//realizar la busqueda

                for($i=0; $i<count($descripcionVariable); $i++){//ingresar cada uno de los valores de la tienda en una lista
                    $info_tienda[$i] = $fila[$descripcionVariable[$i]];
                    // echo $info_tienda[$i]."<br>";
                }
            }
            echo "<script>console.log('mTiendas::pedirInformacionTiendas')</script>";

            $connect -> close();
            return $info_tienda;
        }
        /**
         * Conseguir las id de los tipos de productos que posee la tienda
         * @param   entero  ID_TIENDA
         * @return  lista   Lista de los tipos de productos que posee la tienda
         *                      vista/list/actividades.php  (Tipos de actividades junto a sus id)
         */
        static function pedirInfoTipoProducto($ID_TIENDA){
            $connect = conexionBaseDatos();
            
            $sql = "SELECT TIPO_PRODUCTOS 
                    FROM TIPO_PRODUCTOS 
                    WHERE ID_TIENDA = '$ID_TIENDA'";
            $result = $connect -> query($sql);

            
            for($i=0; $i<$fila = mysqli_fetch_assoc($result); $i++){        // $i = Filas
                $info_tienda[$i] = $fila['TIPO_PRODUCTOS'];
            }

            $connect -> close();
            return $info_tienda;
        }
//-------- INFO_PRODUCTOS -------------------------------------------------------------------------
        /**
         * Almacenar en un Array(Diccionario) los ID de todos los productos segun el ID de la tienda
         * @param   entero  ID_TIENDA
         * @return  lista   Lista de todas las ID de los productos
         */
        static function pedirInfoIDProductos($ID_TIENDA){
            $connect = conexionBaseDatos();
            
            $sql  = "SELECT ID_PRODUCTO ";
            $sql .= "FROM PRODUCTOS ";
            $sql .= "WHERE ID_TIENDA = '$ID_TIENDA'";

            $result = $connect -> query($sql);

            //Almacen de variables en la lista info_producto
            for($i=0; $i<$fila = mysqli_fetch_assoc($result); $i++){        // $i = Filas
                $info_producto[$i] = $fila['ID_PRODUCTO'];  //se almacena la ID de 
            }
            echo "<script>console.log('mTiendas::pedirInfoProducto')</script>";

            $connect -> close();
            return $info_producto;
        }
        /**
         * Almacenar en un Array la información de los productos segun su ID
         * @param   texto   ID del producto
         * @return  lista   Info del producto
         *                      [0] = NOMBRE_PRODUCTO
         *                      [1] = PRECIO_PRODUCTO
         *                      [2] = RUTA_IMG_PRODUCTO
         *                      [3] = ID_PRODUCTO
         */
        static function pedirInfoProducto($ID_PRODUCTO){
            $connect = conexionBaseDatos();
            
            $sql  = "SELECT * ";
            $sql .= "FROM PRODUCTOS ";
            $sql .= "WHERE ID_PRODUCTO = '$ID_PRODUCTO'";

            $result = $connect -> query($sql);

            $descripcionVariable = array('NOMBRE_PRODUCTO','PRECIO_PRODUCTO','FOTO_PRODUCTO', 'ID_PRODUCTO');  //Diccionario de variables a conseguir
            //Almacen de variables en la lista info_producto
            while ($fila = mysqli_fetch_assoc($result)){//realizar la busqueda

                for($i=0; $i<count($descripcionVariable); $i++){//ingresar cada uno de los valores del producto en una lista
                    $info_producto[$i] = $fila[$descripcionVariable[$i]];
                }
            }
            echo "<script>console.log('mTiendas::pedirInfoProducto')</script>";

            $connect -> close();
            return $info_producto;
        }
        /**
         * Busqueda de productos según la tienda y los caracteres que desee buscar
         * @param   entero  ID_TIENDA
         * @param   texto   Caracteres que se desean buscar
         * @return  lista   Lista Productos que coinciden con los caracteres buscados
         *                      [][0] = NOMBRE_PRODUCTO
         *                      [][1] = PRECIO_PRODUCTO
         *                      [][2] = URL_FOTO_PRODUCTO
         *                      [][3] = ID_PRODUCTO
         */
        static function buscarProductos($ID_TIENDA,$productoBuscar=''){
            $connect = conexionBaseDatos();

            $sql  = "SELECT * FROM PRODUCTOS ";
            if($productoBuscar==''){
                $sql .= "WHERE ID_TIENDA = '$ID_TIENDA'";   // Obtener todos los productos
            }else{
                $sql .= "WHERE NOMBRE_PRODUCTO LIKE '%".$productoBuscar."%' 
                            AND ID_TIENDA = '$ID_TIENDA'";  // Obtener todos los productos segun la busqueda
            }
            $result = $connect -> query($sql);

            $descripcionVariable = array('NOMBRE_PRODUCTO','PRECIO_PRODUCTO','FOTO_PRODUCTO','ID_PRODUCTO');  //Diccionario de variables a conseguir
            $elementos = (count($descripcionVariable));
            //Almacen de variables en la lista info_productos

            for($i=0; $i<$fila = mysqli_fetch_assoc($result); $i++){        // $i = Filas
                for($j=0; $j<$elementos; $j++){     // $j = Columnas
                    $info_productos[$i][$j] = $fila [$descripcionVariable[$j]];
                }
            }
            $connect -> close();
            if(!isset($info_productos)){    // Si no existen productos con los terminos buscados asignar vacio('') a la variable
                $info_productos = '';
            }
            return $info_productos;
        }
    }