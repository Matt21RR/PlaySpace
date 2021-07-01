<?php
    $tipos = array(
        "deportivo",
        "ocio"
    );
    $cantTiposStart = 1;
    $cantTipos = 2; //empezar desde 1

    $deportes = array(
        "Voleibol",  //1 
        "Baloncesto",//2 
        "Futbol",//3
        "Tenis",//4
        "Patinaje",//5
        "Artes Marciales",//6
        "Golf",//7
        "Bolos",//8
        "Boxeo",//9
        "Microfutbol",//10
        "Ping Pong",//11
        "Balonmano",//12
        "Waterpolo",//13
        "Beisbol",//14
        "Criquet",//15
        "Polo",//16
        "Rugby",//17
        "Hockey sobre Pasto",//18
        "Hockey sobre Hielo",//19
        "Ciclismo de montaña",//20
        "Ciclismo BMX",//21
        "Esquí",//22
        "Motocross",//23
        "Futbol Americano",//24
        "Patinaje sobre hielo"//25
    );

    $cantDeportesStart = 1;
    $cantDeportes = 25; //empezar desde 1
    //===========================================
    $ocio = array(
        "Karaoke",//101
        "Juegos de Tablero",//102
        "Juegos de Cartas",//103
        "Videojuegos"//104
    );
    $cantOcioStart = 101;
    $cantOcio = 104; //empezar desde 101
    //===========================================
    $masivos = array(
        "Concierto",//201
        "Teatro",//202
        "Festival Cultural",//203
        "Festival",//204
        "Feria",//205
        "Partido o competicion",//206
        "Carrera"//207
    );
    $cantMasivosStart = 201;
    $cantMasivos = 207; //Empezar desde 201

    // ------------------------   
    $actividades = [
        $deportes,
        $ocio
    ];
    
    for($i=0; $i<count($actividades); $i++){
        for($j=0; $j<count($actividades[$i]); $j++){
            $sport_sinEspacio[$i][$j] = str_replace(" ", "_", $actividades[$i][$j]);
        }
    }
    // -------------------------------
    $j = 1;
    for($i=0; $i<count($deportes); $i++){
        $value_deportes[$i] = $j;
        $posicion_deportes[$j] = $deportes[$i];
        $j += 1;
    }
    $k = 101;
    for($i=0; $i<count($ocio); $i++){
        $value_ocio[$i] = $k;
        $posicion_ocio[$k] = $ocio[$i];
        $k += 1; 
    }
    $l = 201;
    for($i=0; $i<count($masivos); $i++){
        $value_masivos[$i] = $l;
        $posicion_masivos[$l] = $masivos[$i];
        $l += 1;
    }
    // Listas de los valores segun la actividad
    $value_actividades = [
        $value_deportes,
        $value_ocio     
    ];

    $posicionActividad = [
        $posicion_deportes,
        $posicion_ocio
    ];
