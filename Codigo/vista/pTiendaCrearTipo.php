<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
//----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
?> 
    <script src="js/options-container.js"></script>
    <title>CrearTiendaTipo</title>
</head>
<body class="justify-content-center align-items-center text-center">
<!----- CONTENEDOR MENU -->
    <div class="container-menu w-100"></div>
<!----- Texto PROGRESO -->
    <div class="guia-text my-3">
        <p>Progreso</p>
    </div>
<!----- BARRA PROGRESO -->
    <div class="container-progress-bar mx-auto">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" rol="progressbar"
                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
        </div>
    </div>
<!----- TEXTO GUIA -->
    <div class="guia-text-crear-tienda mx-auto my-2">
        <p>Selecciona el tipo de evento relacionado con los productos de su tienda</p>
    </div>
<!----- SELECCIÓN INTERATIVA DEL TIPO DE TIENDA -->
    <form action="../controladorVista/cvTiendaCrearTipo.php" method="post">

    <!----- Contenedor Tipo Deportivo -->
    <div class="text-center my-1" id="btn_container_type_deportivo" 
                onclick="optionsTypeSport('options_type_deportivo'), btn_opacity('btn_container_type_deportivo')">Deportivo</div>
        <div id="options_type_deportivo">
            <?php
                $deportesTipoDeportivo = ["Futbol", "Voleibol", "Baloncesto"];

                for($i=0; $i<count($deportesTipoDeportivo); $i++){ //Condicional para generar las opciones de Deporte Tipo Deportivo
                    $id_option = "option_".$i."_deportivo";  //Nombres de ID para las opciones del tipo de deporte 
                    $btn_opacity = "'option_".$i."_deportivo'";  //uso del ID agregando comillas simples('') para su uso en el js(options-container.js)
                    $id_value_option = "value_".$id_option; //Nombres de los input para las opciones del tipo de deporte 
                    $btn_value_option = "'value_".$id_option."'"; //uso del nombre del input agregando comillas simples('') para su uso en el js(options-container.js)
                echo '<div class="option_deportivo option_sport" id="'.$id_option.'"
                        onclick="btn_opacity('.$btn_opacity.'), send_value_option('.$btn_value_option.')">';
                        echo $deportesTipoDeportivo[$i];    //Caja opción del tipo de tienda deportivo
                    echo '<input type="hidden" name="option_sport" class="value_option_sport" 
                            id="'.$id_value_option.'" value="'.$deportesTipoDeportivo[$i].'" disabled>';    //Valor que poseera la opción seleccionada
                echo '</div>';
                }
            ?>
        </div>

    <!----- Contenedor Tipo Ocio -->
        <div class="text-center my-1" id="btn_container_type_ocio" 
                onclick="optionsTypeSport('options_type_ocio'), btn_opacity('btn_container_type_ocio')">Ocio</div>
        <div id="options_type_ocio">
            <?php
                $deportesTipoOcio = ["Ajedrez", "Parquez", "Damas Chinas"];

                for($i=0; $i<count($deportesTipoOcio); $i++){ //Condicional para generar las opciones de Deporte Tipo Ocio
                    $id_option = "option_".$i."_ocio";  //Nombres de ID para las opciones del tipo de deporte 
                    $btn_opacity = "'option_".$i."_ocio'";  //uso del ID agregando comillas simples('') para su uso en el js(options-container.js)
                    $id_value_option = "value_".$id_option; //Nombres de los input para las opciones del tipo de deporte 
                    $btn_value_option = "'value_".$id_option."'"; //uso del nombre del input agregando comillas simples('') para su uso en el js(options-container.js)
                echo '<div class="option_ocio option_sport" id="'.$id_option.'" 
                        onclick="btn_opacity('.$btn_opacity.'), send_value_option('.$btn_value_option.')">';
                        echo $deportesTipoOcio[$i];         //Caja opción del tipo de tienda ocio
                    echo '<input type="hidden" name="option_sport" class="value_option_sport" 
                            id="'.$id_value_option.'" value="'.$deportesTipoOcio[$i].'" disabled>';    //Valor que poseera la opción seleccionada
                echo '</div>';
                }
            ?>
        </div>
            <a href="pIniciarSesion.php">Cancelar</a>
        <input type="submit">
    </form>
</body>
</html>