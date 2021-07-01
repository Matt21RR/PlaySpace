<?php
    include_once('../modelo/mTiendas.php');             //Temporal
    include_once('cUsuario.php');                       //Temporal
    include_once('cAutenticacion.php');                 //Temporal
    include_once('../modelo/mTiendaCrear.php');         //-- Herencia --
    include_once('../mMaster.php');
    include_once('cValidacion.php');                    //Temporal
    include_once('cPerfil.php');                        //Temporal
    include_once('cPerfilEditar.php');                        //Temporal
    
    class cTiendaCrear extends mTiendaCrear
    {
// ------- ESPACIO PUBLICITARIO ------------------------------------------------------------------
        /**
         * Calcula el tiempo que se le asignara al creador de la tienda 
         * tomando encuenta el paquete de tiempo seleccionado
         * @param   entero  ID del usuario quien crea la tienda
         * @param   entero  paquete de tiempo seleccionado
         * @param   entero  1 = Crear Tienda
         *                  0 = Actualizar Fecha Tienda
         * @return  texto   fecha de fin de publicación
         */
        static function ofrecerEspacioPublicitario($ID_USUARIO, $tiempoCompra, $crearTienda=0){
            if($crearTienda == 0){
                $info_tienda = mTiendas::pedirInformacionTienda($ID_USUARIO);
                $fechaTienda = $info_tienda[3];     //3 = FIN_PUBLICACION
            } else{                 //Fecha actual == Creación de la tienda
                $fechaTienda = date('Y-m-d');
            }
            $fechaCreacionTienda = date_create(mMaster::convertirTiempo($fechaTienda));

            if( $tiempoCompra == 0 and $crearTienda == 1 ){
                $tiempoPublicacion = 7;
            } else{
                $tiempoPublicacion = $tiempoCompra*30;
            }
            date_modify($fechaCreacionTienda, "+$tiempoPublicacion days");
            $FIN_PUBLICACION = date_format($fechaCreacionTienda, "Y-m-d");
            
            echo "<script>console.log('cTiendaCrear::ofrecerEspacioPublicitario')</script>";
            return $FIN_PUBLICACION;
        }
        /**
         * Actualiza los la fecha fin de la publicación de la tienda de un usuario
         * @param   entero  ID del usuario
         * @param   entero  paquete seleccionado por el usuario 
         *                          0 = 7 días
         *                          1 = 30 días
         *                          2 = 60 días
         *                          3 = 90 días
         *                          4 = 120 días
         * @param   entero ID de la tienda 
         */
        static function asignarFechaFinPublicacion($ID_USUARIO, $tiempoCompra, $ID_TIENDA){
            $FIN_PUBLICACION = self::ofrecerEspacioPublicitario($ID_USUARIO, $tiempoCompra);
            self::actualizarFechaFinPublicacion($ID_USUARIO, $ID_TIENDA, $FIN_PUBLICACION);
        }
// ------- VALIDAR DATOS -------------------------------------------------------------------------
        /**
         * Válida los datos ingresados por el usuario para la creación de la tienda
         *@param    texto   Información ingresada por el usuario
         *@param    entero  Selección tomando en cuenta la información ingresada
         *                      0 = Nombre de la tienda
         *                      1 = Descripción de la tienda
         *                      2 = Dirección de la tienda
         *                      4 = Telefono de la tienda
         *                      6 = Correo Tienda
         *                   ----------------------------------------
         *                      3 = Nombre Producto
         *                      5 = Precio Producto
         *                     #7 = Foto Producto (Falta)
         *@return   texto   (Condición)  1 = Variable disponible para su uso
         *          entero  (Condición) -1 = Variable no disponible para su uso
         */
        static function validarDatosTienda($datoIngresado=0, $datoSeleccionar){
            $condicion = -1;
            
            if(($datoIngresado == 0 or $datoIngresado == "") && ($datoSeleccionar == 1 or $datoSeleccionar == 2 or $datoSeleccionar == 4 or $datoSeleccionar == 6)){
                $condicion = 1;
            } else if( $datoSeleccionar > -1 && $datoSeleccionar < 4){
                if(cValidacion::validarTexto($datoIngresado) == 1){
                    $condicion = 1;
                    if($datoSeleccionar == 0){
                        if(self::comprobarNombreTiendaRepetido($datoIngresado) == 1) $condicion = -1;
                    }
                }
            } else if($datoSeleccionar == 4){
                $datoIngresado = str_replace("(", "", $datoIngresado);
                $datoIngresado = str_replace(")", "", $datoIngresado);
                $datoIngresado = str_replace("-", "", $datoIngresado);
                $datoIngresado = str_replace(" ", "", $datoIngresado);

                if(is_numeric($datoIngresado)){
                    if(cUsuario::pedirVariables(cUsuario::decidir(3), $datoIngresado) == 1){
                        $condicion = 1;
                    }
                }
            } else if($datoSeleccionar == 5){
                $datoIngresado = str_replace("'", "", $datoIngresado);
                $datoIngresado = str_replace(".", "", $datoIngresado);

                if(is_numeric($datoIngresado) and $datoIngresado > 0){
                    $condicion = 1;
                }
            } else if($datoSeleccionar == 6){
                if(cAutenticacion::pedirCorreo($datoIngresado) == 1){
                    $condicion = 1;
                }    
            }
            echo "<script>console.log('cTiendaCrear::validarDatosTienda')</script>";

            if($condicion != 1){
                echo "<script>console.error('Datos ingresados no válidos')</script>";
            }
            return $condicion;
        }
        /**
         * Valida la primera creación de una tienda y no pueda volver a obtener los (7 días o Paquete 0) nuevamente
         * @param   entero  ID de usuario
         */
        static function primeraTienda($ID_USUARIO){
            $info_usuario = cPerfil::consultarPerfil($ID_USUARIO);  // Obtener toda la info del usuario
            if($info_usuario[8] == 1){
                cPerfilEditar::bloqueoTiendaPrueba($ID_USUARIO);    // Bloquea el paquete
            }
        }

// ------- CREAR PRODUCTOS / ID_TIENDA / TIENDA ------------------------------------------------------
        /**
         * Creación de productos en la base de datos
         * @param   entero  ID de la tienda en donde se subira el producto
         * @param   texto   Nombre del producto
         * @param   decimal Precio del producto
         * @param   archivo Imagen del producto
         */
        static function crearProductos($ID_TIENDA, $nombreProducto, $precioProducto, $fotoProducto, $IDProducto){

            if(is_numeric(self::validarDatosTienda($nombreProducto, 3))){               //Validar nombre producto
                if(is_numeric(self::validarDatosTienda($precioProducto, 5))){           //Validar precio producto                                                   //Validar foto producto(falta)
                    $datosProductos = [$nombreProducto,$precioProducto,$fotoProducto,$IDProducto];
                        
                    for($fila = 0; $fila < count($datosProductos); $fila++)
                    {
                        $productos[$fila] = $datosProductos[$fila];
                    }
                    self::agregarProductos($ID_TIENDA, $productos);                 //Subida del producto a la BD
                }
            }
            echo "<script>console.log('cTiendaCrear::mTiendaCrear')</script>";
        }
        /**
         * Crear la ID de un nuevo producto
         * @param   entero  ID_TIENDA
         * @param   entero  ID_USUARIO
         * @return  texto   ID_PRODUCTO = (ID_TIENDA _ ID_USUARIO _ ID_PRODUCTO_MAX) 
         */
        static function crearIDProducto($ID_TIENDA, $ID_USUARIO){
            $ID_PRODUCTOS = mTiendas::pedirInfoIDProductos($ID_TIENDA); // Adquisición de todas la ID de una tienda especifica

            $ID_USUARIO_TIENDA = $ID_USUARIO."_".$ID_TIENDA."_";    // Parte de la ID_PRODUCTO que sera eliminada
            for($i=0; $i<count($ID_PRODUCTOS); $i++){
                $ID_PRODUCTOS[$i] = str_replace($ID_USUARIO_TIENDA,"",$ID_PRODUCTOS[$i]);   // Eliminar parte de la ID (ID_USUARIO_$ID_TIENDA_)
                $ID_PRODUCTOS[$i] = intval($ID_PRODUCTOS[$i]);  // Conversión de todos los ID a int
                $ID_PRODUCTO_MAX = max($ID_PRODUCTOS);      // Obtención del ID mayor
            }
            return $ID_USUARIO_TIENDA.($ID_PRODUCTO_MAX + 1);    // Retorno del ID_PRODUCTO
        }
        /**
         * Se crea el ID de la tienda teniendo encuenta el ID de usuario del creador y el número de tiendas creadas
         * @param   entero  ID de usuario
         * @param   entero  ID de la tienda
         */
        static function crearIDTienda($ID_USUARIO){
            $info_tienda = mTiendas::pedirIDTiendasCreador($ID_USUARIO);
            if($info_tienda == 0){
                $cantidadTiendas = 0;             
            } else{
                $cantidadTiendas = count($info_tienda);         
            }
            $ID_TIENDA = $ID_USUARIO.$cantidadTiendas;

            echo "<script>console.log('cTiendaCrear::crearIDTienda')</script>";
            return $ID_TIENDA;
        }
        /**
         * Se crea la tienda tomando los valores ingresados por el usuarios
         * @param   entero  ID del usuario
         * @param   texto   nombre de la tienda
         * @param   texto   descripción de la tienda
         * @param   texto   dirección tienda
         * @param   entero  telefono tienda
         * @param   texto   correo tienda
         * @param   entero  paquete seleccionado que durara la tienda
         *                          0 = 7 días
         *                          1 = 30 días
         *                          2 = 60 días
         *                          3 = 90 días
         *                          4 = 120 días
         * @return  texto   ID de la tienda creada
         */
        static function crearTienda($ID_USUARIO, $nombreTienda, /*$ubicacionTienda,*/ 
                                    $descripcionTienda, $direccionTienda, $contactoTienda, 
                                    $correoTienda, $tiempoCompra){
            $crearTienda = 1;
            $almacenarDatos = [ $nombreTienda, $descripcionTienda, $direccionTienda, 
                                $contactoTienda, $correoTienda];            //Se almacenan los valores en un diccionario para un uso mas autonomo
            $posicionValidar = [0,1,2,4,6];     //Posición requerida para validar adecuadamente los valores ingresados

            for($i=0; $i<count($almacenarDatos); $i++){
                if(self::validarDatosTienda($almacenarDatos[$i], $posicionValidar[$i]) == -1){
                    $crearTienda = -1;
                    break;
                }
            }

            if($crearTienda == 1){
                $ID_TIENDA = self::crearIDTienda($ID_USUARIO);
                $FIN_PUBLICACION = self::ofrecerEspacioPublicitario($ID_USUARIO, $tiempoCompra, $crearTienda);
                self::enviarInformacionTienda($ID_USUARIO, $ID_TIENDA, $nombreTienda, $descripcionTienda, 
                                            $contactoTienda, $correoTienda, $direccionTienda, $FIN_PUBLICACION);
                self::deshabilitarTiempoPublicacionPrueba($ID_USUARIO);
            } else{
                echo "<script>console.error('Tienda no creada')</script>";
            }
            echo "<script>console.log('cTiendaCrear::crearTienda')</script>";
            return $ID_TIENDA;
        }
//-------- TIPO DE PRODUCTOS DE LA TIENDA --------------------------------------------------------------------
        /**
         * Ingresa los tipos de actividades con los que la tienda tiene productos
         * @param   entero  ID Tienda
         * @param   entero  Número tipo de actividad
         */
        static function tipoProductosTienda($ID_TIENDA, $tipoProducto){
            self::tipoProducto($ID_TIENDA, $tipoProducto);  // Inserción de los tipos de productos
        }
    }
