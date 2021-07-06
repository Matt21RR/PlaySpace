<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
//----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
?> 
    <script src="js/options-container.js"></script>
    <title>CrearTiendaTipo</title>
</head>
<body class="justify-content-center align-items-center text-center">
<!----- Texto PROGRESO -->
    <div class="guia-text my-3">
        <p>Progreso</p>
    </div>
<!----- BARRA PROGRESO -->
    <!-- <div class="container-progress-bar mx-auto">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" rol="progressbar"
                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
        </div>
    </div> -->
<!----- TEXTO GUIA -->
    <div class="guia-text-crear-tienda mx-auto my-2">
        <p>Selecciona el tipo de evento relacionado con los productos de su tienda</p>
    </div>
<!----- SELECCIÓN INTERATIVA DEL TIPO DE TIENDA -->
    <form action="../controladorVista/cvTiendaCrearTipo.php" method="post">

    <!----- Incluir los tipos de actividades y sus actividades correspondientes -->
    <?php
    // -- Tipo Deportivo / Ocio
        include_once('lists/actividades.php');
        for($i=0; $i<count($tipos); $i++){
            $typeSport = "type_".$tipos[$i];
            $optionSport = "'options_".$typeSport."'";
            $id_btn_containerSport = "btn_container_".$typeSport;
            $btn_containerSport = "'btn_container_".$typeSport."'";
            $optionType = "option_".$tipos[$i];
            echo '
                <div class="text-center my-1" id='.$id_btn_containerSport.'
                            onclick="optionsTypeSport('.$optionSport.'), btn_opacity('.$btn_containerSport.')">'.$tipos[$i].'</div>
                    <div id='.$optionSport.'>';

        // -- Actividades
            for($j=0; $j<count($actividades[$i]); $j++){ //Condicional para generar las opciones de las actividades
                $id_option = "option_".$j."_".$tipos[$i];  //Nombres de ID para las opciones de las actividades
                $btn_opacity = "'option_".$j."_".$tipos[$i]."'";  //uso del ID agregando comillas simples('') para su uso en el js(options-container.js)
                $id_value_option = "value_".$id_option; //Nombres de los input para las opciones de las actividades 
                $btn_value_option = "'value_".$id_option."'"; //uso del nombre del input agregando comillas simples('') para su uso en el js(options-container.js)
            echo '<div class="'.$optionType.' option_sport" id="'.$id_option.'"
                        onclick="btn_opacity('.$btn_opacity.'), send_value_option('.$btn_value_option.')">';
                    echo $actividades[$i][$j];    //Caja opción del tipo de tienda
                echo '<input type="hidden" name="option_sport_'.$sport_sinEspacio[$i][$j].'" class="value_option_sport" 
                            id="'.$id_value_option.'" value="'.$value_actividades[$i][$j].'" disabled>';    //Valor que poseera la opción seleccionada
            echo '</div>';
            }
            echo '
                    </div>';
        }
    ?>
        
    <!-- BOTONES CANCELAR / CONTINUAR -->
        <input type="submit" value="Cancelar" name="cancelar">
        <input type="submit" value="Continuar">
    </form>
</body>
</html>