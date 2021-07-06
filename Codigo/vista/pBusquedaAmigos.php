<div class="container-fluid g-0 py-1" style="z-index:-1; display:none;" id="buscar"><!--Cuadro de busqueda-->
    <form action="" method="get">
        <input type="number" name="id_usuario_buscar" id="id_usuario_buscar" placeholder="Introduce la id de usuario">
        <div class="btn btn-primary" onclick="buscarUsuario()">Buscar usuario</div>
    </form>


    <div class="container-fluid g-0 py-1" style="z-index:-1; display:none;" id="resultado_busqueda"><!--RESULTADOS DE BUSQUEDA-->
        <div style="white-space: nowrap;">
            <div class="friend mx-sm-3">
                <div class="friend-content h-100 w-100">
                    <div class="row g-0 h-100">
                        <div class="col-sm-3 col-auto h-100 g-0">
                            <img class="friendPhoto my-auto" id="foto_perfil_amigo_buscado" src=""><!--FOTO DE PERFIL-->
                        </div>
                        <div class="col-sm-9 col-8">
                            <div class="friendInfo">
                                <div class="friendName" id="nombre_amigo_buscado">
                                </div>
                                <div class="friendId" id="id_amigo_buscado">
                                </div>
                                <div class="container-fluid g-0">
                                    <div onclick="enviarSolicitudAmistad()" class="buttonSelectorList btn btn-primary text-wrap">
                                        Enviar solicitud de amistad
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr size=5>
    </div>
<div>