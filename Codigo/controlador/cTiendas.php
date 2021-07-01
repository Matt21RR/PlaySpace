<?php
    include_once('cTiendaCrear.php');
    include_once('cTiendaEditar.php');
    include_once('../modelo/mTiendas.php');

    class cTiendas extends mTiendas{
        /**
         * Obtiene las ID de las tiendas creadas por un usuario
         * @param   entero  ID del usuario
         * @return  lista   lista de las ID de las tiendas del usuario
         */
        static function consultarTiendasCreadas($ID_USUARIO){
            $info_IDTiendas = self::pedirIDTiendasCreador($ID_USUARIO);
            return $info_IDTiendas;
        }
        /**
         * Obtiene la información básica de una tienda en especifico
         * @param   entero  id del usuario para mostrar la información tienda activa
         * @return  lista   lista de información de la tienda 
         *                      [0] = Nombre Tienda
         *                      [1] = telefono Tienda
         *                      [2] = Correo Tienda
         *                      [3] = Fin publicación Tienda
         *                      [4] = Descripción Tienda
         *                      [5] = Dirección tienda
         */
        static function consultarInfoTienda($ID_USUARIO, $ID_TIENDA){
            $info_Tienda = self::pedirInformacionTienda($ID_USUARIO, $ID_TIENDA);
            return $info_Tienda;
        }
        /**
         * Obtener la info básico de todos los productos de una tienda
         * @param   entero  ID de la tienda
         * @return  lista   Lista de la info de los productos
         *                      [][0] = NOMBRE_PRODUCTO
         *                      [][1] = PRECIO_PRODUCTO
         *                      [][2] = RUTA_IMG_PRODUCTO
         */
        static function consultarInfoProductos($ID_TIENDA){
            $ID_PRODUCTOS = self::pedirInfoIDProductos($ID_TIENDA);
            for($i=0; $i<count($ID_PRODUCTOS); $i++){   // Almacena toda la infromación de todos los productos
                $INFO_PRODUCTOS[$i] = self::pedirInfoProducto($ID_PRODUCTOS[$i]);
            }
            return $INFO_PRODUCTOS;
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
        static function busquedaProductos($ID_TIENDA,$productoBuscar=''){
            return self::buscarProductos($ID_TIENDA,$productoBuscar);  // Buscar segun los caracteres indicados
        }
        /**
         * Conseguir las id de los tipos de productos que posee la tienda y ordenarlos segun deportivos u ocio
         * @param   entero  ID_TIENDA
         * @return  lista   Lista de los tipos de productos que posee la tienda
         *                      vista/list/actividades.php  (Tipos de actividades junto a sus id)
         *                      [0] = deportivo
         *                      [1] = ocio
         *                      [][] = id_actividad
         */
        static function busquedaTiposProductos($ID_TIENDA){
            $tipo_Producto_Tienda = self::pedirInfoTipoProducto($ID_TIENDA);
            for($i=0; $i<count($tipo_Producto_Tienda); $i++){   // Reorganiza las aactividades
                if(intval($tipo_Producto_Tienda[$i]) < 100){    // Deportivas < 100
                    $tipoProducto[0][$i] = $tipo_Producto_Tienda[$i];
                } else if(intval($tipo_Producto_Tienda[$i]) > 100 && intval($tipo_Producto_Tienda[$i]) < 200){  // Ocio > 100 && Ocio < 200
                    $tipoProducto[1][$i] = $tipo_Producto_Tienda[$i];
                }
            }

            return $tipoProducto;
        }
    }