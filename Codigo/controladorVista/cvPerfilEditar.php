<?php
// INICIAR SESION
    session_start();
// INCLUSION DEL VALIDADORES
    include_once('../controlador/cCuentaCrear.php');
    include_once('../controlador/cPerfilEditar.php');
    include_once('../controlador/cPerfil.php');
// BORRAR CUENTA
    if(isset($_GET['DELETE_USUARIO'])){
        cPerfilEditar::eliminarCuenta($_SESSION['ID_USUARIO']);
        header('Location: ../vista', false);
        exit;
    }
// VALIDAR LA INFORMACIÓN NUEVA 
    $nameForm_EditarPerfil = ['ID_FOTO_PERFIL','NOMBRE_USUARIO','CONTRASENA_USUARIO','CORREO_USUARIO']; // Array POST
    $posicionValidar = [3,0,1,2];
    $posicionINFO_USUARIO = [9,0,1,2];
    $infoCorrecta = -1;
    $noActualizar = 0;
    // REQUERIMIENTOS
        // ID_FOTO_PERFIL = -1 < ID_FOTO_PERFIL > 12
        // NOMBRE_USUARIO
            //     MINIMO = 5 LETRAS
            //              3 NÚMEROS
        //  CONTRASEÑA
            //     MINIMO = 7 LETRAS
            //              3 NÚMEROS
        // CORREO_USUARIO 
    $alertas = [
        '',
        'El nombre del usuario debe poseer un mínimo de: 5 LETRAS y 3 NÚMEROS',
        'La contraseña del usuario debe poseer un mínimo de: 7 LETRAS y 3 NÚMEROS ',
        'Correo no válido',
        'No existe nueva información para actualizar el perfil del usuario'
    ];

    for($i=0; $i<count($nameForm_EditarPerfil); $i++){
        if($posicionINFO_USUARIO[$i] != 1){     // Valida el momento de usar contraseña para acceder a ella desde otra session
            $instruccion = $_SESSION['INFO_USUARIO'][$posicionINFO_USUARIO[$i]];
        } else{
            $instruccion = $_SESSION['CONTRASENA'];
        }
    // COMIENZO DE VALIDACIONES
        if($_POST[$nameForm_EditarPerfil[$i]] != $instruccion && $_POST[$nameForm_EditarPerfil[$i]] != ""){
            $noActualizar = 1;
            $validacionTiempo = cPerfilEditar::compararFechaCambioNombre($_SESSION['ID_USUARIO'],1);
            if($posicionINFO_USUARIO[$i] == 0 && $validacionTiempo != 1){     // Comprobación del límite de tiempo para actualizar el nombre
                $_SESSION['ALERTA'] = $validacionTiempo;        // Mensaje de alerta
                $infoCorrecta = -1;                                                                     // 1 = Puede realizar el cambio de nombre
                break;
            }
            $validador = cCuentaCrear::validarDatosCuenta($_POST[$nameForm_EditarPerfil[$i]], $posicionValidar[$i]);
            if($validador == -1){
                $_SESSION['ALERTA'] = $alertas[$i];     // Mensaje de alerta
                $infoCorrecta = -1;
                break;
            } else{
            // ENVIAR EMAIL (ACTIVAR CUANDO ESTE EN UN SERVIDOR)
                // if($posicionINFO_USUARIO[$i] == 2 && cPerfil::enviarEmail($_POST['CORREO_USUARIO'],2,$_SESSION['INFO_USUARIO'][0]) != 1){
                //     $_SESSION['ALERTA'] = $alertas[$i];     // Mensaje de alerta
                //     $infoCorrecta = -1;
                // break;
                // } 
                if($posicionINFO_USUARIO[$i] != 1){     // Diferenciar el almacenaje de contraseña
                    $variableAlmacenar = $_POST[$nameForm_EditarPerfil[$i]];
                } else{
                    $variableAlmacenar = $validador;    // Almacenar contraseña
                }
                $infoCorrecta = 1;
                $_SESSION['INFO_USUARIO'][$posicionINFO_USUARIO[$i]] = $variableAlmacenar;  // Edita la infomación almacenada
            }
        }
        if(!isset($variableAlmacenar)){
            $variableAlmacenar = 0; // Asigna 0 a los valores que permanecen iguales
        }
        $newPerfil[$i] = $variableAlmacenar;  // Valores a editar
        $variableAlmacenar = null;      // Elimina la info almacenada
    }

    if($infoCorrecta == -1){    // Reemplaza la información editada si su contenido no es válido
        if($noActualizar == 0){
            $_SESSION['ALERTA'] = $alertas[4];      // Mensaje de alerta
        }
        $_SESSION['INFO_USUARIO'] = $_SESSION['COPIA_SEGURIDAD_INFO_USUARIO'];
        header('Location: ../vista/pPerfilEditar.php', false);
    } else{ // Actualización de la información en la BD
        cPerfilEditar::editarPerfil($_SESSION['ID_USUARIO'],$newPerfil[1],
                                    $newPerfil[3],$newPerfil[2],$_SESSION['INFO_USUARIO'][9]);
        $_SESSION['NOMBRE_USUARIO'] = $_SESSION['INFO_USUARIO'][0];     // Valores para el menú
        $_SESSION['ID_FOTO_PERFIL'] = $_SESSION['INFO_USUARIO'][9];     // Valores para el menú
        $_SESSION['INFO_USUARIO'] = null;   // Para que almacene la nueva información alojada en la BD
        header('Location: ../vista/pPerfil.php', false);
    }
    
