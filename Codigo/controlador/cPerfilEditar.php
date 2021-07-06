<?php
    include_once ('../modelo/mPerfilEditar.php');
    include_once ('cAutenticacion.php');
    include_once ('../modelo/mPerfil.php');      //Temporal
    include_once ('cCuentaCrear.php');            //Temporal se agrega por el combrobar ID_FOTO_PERFIL
    include_once ('../mMaster.php');             //Temporal
    include_once ('../controlador/cCifradoContrasena.php');

    class cPerfilEditar extends mPerfilEditar{
        /**
         * Editar información básica del usuario indicado
         * @param   entero  ID del usuario
         * @param   texto   Nuevo NOMBRE_USUARIO
         * @param   texto   Nuevo CORREO
         * @param   texto   Nueva CONTRASENA
         * @param   entero  Nueva ID_FOTO_PERFIL
         */
        static function editarPerfil($ID_USUARIO, $NUEVO_NOMBRE_USUARIO=0,
                                    $NUEVO_CORREO=0, $NUEVA_CONTRASENA=0,
                                    $NUEVA_ID_FOTO_PERFIL=0){
            $actualizar = 1;
            $almacenDatos = [$NUEVO_NOMBRE_USUARIO, $NUEVO_CORREO, $NUEVA_CONTRASENA, $NUEVA_ID_FOTO_PERFIL];
            $posicionDatosObtener = [0, 2, 1, 7];
            $posicionDatosValidar = [1, 2, 3, -1];
            $info_Usuario = mPerfil::pedirEstadisticas($ID_USUARIO);
            
            for($i=0; $i<count($almacenDatos); $i++){
                if($almacenDatos[$i] == 0){
                    $datosUsuario[$i] = $info_Usuario[$posicionDatosObtener[$i]];
                } else{
                    if($posicionDatosObtener[$i] == 7){
                        if(cCuentaCrear::seleccionarFotoPerfil($NUEVA_ID_FOTO_PERFIL)!=-1){
                            $datosUsuario[$i] = $almacenDatos[$i];
                        }
                    } elseif(cValidacion::validarTexto($almacenDatos[$i],$posicionDatosValidar[$i])==1){
                        if($posicionDatosObtener[$i] == 0 and self::compararFechaCambioNombre($ID_USUARIO)==-1){
                            $actualizar = -1;
                            break;
                        } else{
                            $datosUsuario[$i] = $almacenDatos[$i];
                        }
                    } else{
                        $actualizar = -1;
                        break;
                    }          
                }
            }

            if($actualizar==1){
                self::actualizarPerfil($ID_USUARIO, $datosUsuario[0],
                                        $datosUsuario[1], $datosUsuario[2],
                                        $datosUsuario[3]);
            }
            echo "<script>console.log('cPerfilEditar::editarPerfil')</script>";
        }
        /**
         * Elimina la cuenta indicada por medio del ID de la cuenta de la base de datos
         * @param   entero  ID del usuario
         */
        static function eliminarCuenta($ID_USUARIO){
            self::borrarCuenta($ID_USUARIO);
        }
        /**
         * Comparar la ultima vez que el usuario cambio el nombre de su perfil (NOMBRE_USUARIO)
         * cuyo caso haya superado el tiempo mínimo de 15días desde el ulitmo cambio o desde la creación de la cuenta
         * podra proceder a cambiar el nombre de su perfil
         * @param   entero  ID del usuario
         * @param   entero  != 0 comprueba si cumple con el limite
         *                  == 0 actualiza la BD si cumple con el límite
         * @return  entero  1 = Tiempo límite superado
         *          texto   Mensaje de cuantos días faltan para poder actualizar el nombre de usuario
         */
        static function compararFechaCambioNombre($ID_USUARIO, $comprobar=0){
            $fecha_cambio_nombre = date_create(mMaster::convertirTiempo(self::pedirFechaCambioNombre($ID_USUARIO)));  //Pedir ultima fecha del cambio del nombre
            $fecha_actual = date_create(mMaster::tiempo());          //Pedir fecha actual

            $fecha_minima = date_modify($fecha_cambio_nombre, "+15 days");  //Tiempo MINIMO para el cambio de nombre

            if($fecha_minima < $fecha_actual){
                if($comprobar == 0){
                    self::actualizarFechaCambioNombre($ID_USUARIO);
                }
                $actualizarNombre = 1;
            } else{     // Generar mensaje de cuanto tiempo falta para poder actualizar nuevamente el nombre de usuario
                $diferenciaTiempoDias = date_diff($fecha_minima,$fecha_actual);
                $tiempofaltante = $diferenciaTiempoDias->format("%R%a");
                $tiempofaltante = str_replace("-", "", $tiempofaltante);
                $tiempofaltante = str_replace("+", "", $tiempofaltante);
                if($tiempofaltante == "0"){
                    $diferenciaTiempoDias = "mañana";
                } else if($tiempofaltante == "1"){
                    $diferenciaTiempoDias = "pasado mañana";
                } else{
                    $diferenciaTiempoDias = "dentro de ".$tiempofaltante." días";
                }
                $diferenciaTiempoDias = "Podras actualizar el nombre de usuario ".$diferenciaTiempoDias;
                $actualizarNombre = $diferenciaTiempoDias;
            }
            return $actualizarNombre;
        }
        /**
         * Compara la contraseña que se esta introduciendo con la contraseña que esta en la base de datos
         * @param   texto   contrasena 
         * @param   numero  id del usuario
         * @return  numero  -1 = las contraseñas son iguales
         *                  1 = Las contraseñas no son iguales
         *                  0 = No hay ninguna contraseña en la base de datos
         */
        static function compararContrasenas ($contrasenaNueva, $ID_USUARIO){
            $contrasenaBDHashed = mPerfilEditar::pedirContrasenaHasheada($NOMBRE_USUARIO);
            if ($contrasenaBDHashed != ''){
                //se extrae la semilla de la contraseña que esta en la base de datos
                $semilla =  cCifradoContrasena::extraerSemilla($contrasenaBDHashed);
                //se le aplica el mismo proceso que sufre una contraseña cuando se crea una cuenta
                $contrasenaNuevaHashed = cCifradoContrasena::incrustarSemilla(cCifradoContrasena::hashearContrasena($contrasenaNueva,$semilla),$semilla);
                if($contrasenaBDHashed == $contrasenaNuevaHashed){
                    //Las contraseñas son iguales
                    $resultado = -1;
                }else{
                    //las contraseñas NO son iguales
                    $resultado = 1;
                }
            }else{
                $resultado = 0;
            }
            return $resultado;
        }
    //-------- BLOQUEO DE PAQUETE (7 días == pack 0) ---------------------------------------------------------------
        /**
         *  Actualiza el valor 1 de (No ha creado ninguna tienda y puede adquiir el paquete 0) a
         *  el valor 0 de (Ha creado una tienda y no puede adquiir el paquete 0)
         * @param   entero  ID del usuario
         */
        static function bloqueoTiendaPrueba($ID_USUARIO){
            $connect = conexionBaseDatos();

            $sql = "UPDATE USUARIOS 
                    SET TIENDA_PRUEBA = 0 
                    WHERE ID_USUARIO = '$ID_USUARIO'";
                        
            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);

            echo "<script>console.log('mTiendasCrear::bloqueoTiendaPrueba')</script>";
            $connect -> close();
        }
    }