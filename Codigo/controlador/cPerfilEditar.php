<?php
    include_once('../modelo/mPerfilEditar.php');
    include_once('cAutenticacion.php');
    include_once('../modelo/mPerfil.php');      //Temporal
    include_once('cCuentaCrear.php');            //Temporal se agrega por el combrobar ID_FOTO_PERFIL
    include_once('../mMaster.php');             //Temporal

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
            $posicionDatosValidar = [1, 2, 3];
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
         * @return  entero   1 = Tiempo límite superado
         *                  -1 = Tiempo límite no superado
         */
        static function compararFechaCambioNombre($ID_USUARIO){
            $fecha_cambio_nombre = date_create(mMaster::convertirTiempo(self::pedirFechaCambioNombre($ID_USUARIO)));  //Pedir ultima fecha del cambio del nombre
            $fecha_actual = date_create(date("Y-m-d"));          //Pedir fecha actual

            $fecha_minima = date_modify($fecha_cambio_nombre, "+15 days");  //Tiempo MINIMO para el cambio de nombre

            if($fecha_minima < $fecha_actual){
                self::actualizarFechaCambioNombre($ID_USUARIO);
                $actualizarNombre = 1;
            } else{
                echo "<script>console.error('Tiempo límite no alcanzado')</script>";
                $actualizarNombre = -1;
            }
            echo "<script>console.log('cPerfilEditar::compararFechaCambioNombre')</script>";
            return $actualizarNombre;
        }
    }