<?php
// -- INCLUIR cTiendas y mMaster
    include_once('../controlador/cTiendas.php');
    include_once('../mMaster.php');
// Obtener ID de las tiendas creadas por el usuario
    $ID_TIENDAS = cTiendas::consultarTiendasCreadas($_SESSION['ID_USUARIO']);
// -- ALMACENA LAS TIENDAS CREADAS (SI LAS TIENE) EN SESSION['INFO_TIENDAS']
    // [][0] = Nombre Tienda
    // [][1] = telefono Tienda
    // [][2] = Correo Tienda
    // [][3] = Fin publicación Tienda
    // [][4] = Descripción Tienda
    // [][5] = Dirección Tienda
    // [][6] = ID Tienda
    if($ID_TIENDAS > 0){
        for($i=0; $i<count($ID_TIENDAS); $i++){
            $_SESSION['INFO_TIENDAS'][$i] = cTiendas::consultarInfoTienda($_SESSION['ID_USUARIO'], $ID_TIENDAS[$i]);
        }
    // Creación del apartado visual de cada tienda
        for($i=0; $i<count($_SESSION['INFO_TIENDAS']); $i++){
            echo '  <div>
                        <p>'.$_SESSION['INFO_TIENDAS'][$i][0].'</p>
                        <p>Fin publicidad: '.mMaster::tiempoTexto($_SESSION['INFO_TIENDAS'][$i][3],1).'</p>
                        <form action="../controladorVista/cvTienda_VerEditar.php" method="post">
                            <input type="hidden" name="posicionTienda" value="'.$i.'">
                            <input type="submit" value="Ver">
                            <input type="submit" value="Editar" name="editarTienda">
                        </form>
                    </div>';
        }
        echo '<hr>';
    }