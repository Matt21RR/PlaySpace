<?php
    // TODO: De estas funciones solo importan 2 = validarTexto() : para buscar caracteres no admitidos en los textos introducidos
    // TODO:                                      busquedaGeneralPalabrasNoPermitidas() : para buscar palabras no permitidas en los textos introducidos
    
    class cValidacion{
        /**
         * Analiza los textos en funcion del tipo que sean, buscando caracteres no permitidos
         * que son preestablecidos internamente.
         * @param   texto   texto a analizar
         * @param   numero  el tipo de texto a analizar  /  0 = texto
         *                                                  1 = cadena de caracteres sin espacios y sin caracteres especiales
         *                                                  2 = correo
         *                                                  3 = contraseña
         * @return  numero  codigo del resultado del analisis
         *                      1 = Texto valido
         *                      0 = Caracter invalido presente en el texto
         *                      2 = Caracter especial presente al principio del correo o al final
         *                      3 = Caracter especial ("@") presente mas de una vez
         *                      4 = Caracter especial (".") presente junto a otro caracter del mismo tipo (".")
         *                      5 = Contraseña con menos de 4 numeros o 4 letras
         */
        static function validarTexto($texto,$tipoValidacion=0){
            $caracteresValidos = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'A', 'a', 'B', 'b', 'C', 'c', 'D', 'd', 'E', 'e', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'Ñ', 'ñ', 'O', 'o', 'P', 'p', 'Q', 'q', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'Z', 'z');
            $caracteresValidosTexto = array('á','à','é','è','í','ì','ó','ò','ú','ù','ü',' ', '!', '"', ',', '.', '?', '¡', '¿', ';', ':', '*', '(',')');
            
            $posicionBusqueda = 0;
            $caracteresCorrectos = 0;
            $palabra = str_split($texto);
            $textoValido = 0;
            $caracteresNumericos = 0;

            if($tipoValidacion ==2){ //evaluar el texto del correo
                $palabra = self::validarCorreo($palabra);
                $cantidadCaracteres = count($palabra);
                if($palabra[0] == '+'){
                    $posicionBusqueda = $cantidadCaracteres;// ! forzar deteccion de texto no valido
                    $textoValido = $palabra[1];//Enviar Codigo de requerimiento no cumplido
                }
            }
            $cantidadCaracteres = count($palabra);
            if ($tipoValidacion == 0) {
                $caracteresValidos = array_merge($caracteresValidos, $caracteresValidosTexto);
            }
            $cantidadCaracteresValidos = count($caracteresValidos);

            while ($posicionBusqueda != $cantidadCaracteres) { //Busqueda caracteres de la palabra
                
                for ($caracterExaminado = 0; $caracterExaminado != $cantidadCaracteresValidos; $caracterExaminado++){//Busqueda de un caracter en la lista de caracteres
                    if ($palabra[$posicionBusqueda] == $caracteresValidos[$caracterExaminado]) {
                        $caracteresCorrectos++;
                        if (is_numeric($caracteresValidos[$caracterExaminado]) == true){
                            $caracteresNumericos++;
                        }
                        break;
                    }
                }
                $posicionBusqueda++;
            }
            if ($cantidadCaracteres == $caracteresCorrectos) {
                $textoValido = 1;
                if (($tipoValidacion == 3) and (($caracteresNumericos<4) or (($cantidadCaracteres-$caracteresNumericos) < 4 ))){
                    $textoValido = 5;
                }
            }
            $tipoMen="warn";
            if($textoValido != 1){$tipoMen="error";}
            echo "<script>console.".$tipoMen."('cValidacion::validarTexto-> ".$textoValido."')</script>";//SALIDA POR CONSOLA
            return $textoValido;
        }
        /**
         * busca los caracteres validos en el correo y los remueve,
         * ademas advierte de problemas con el cumplimiento de los 
         * requisitos basicos del correo
         * @param   arreglo     Arreglo  con los caracteres del correo
         * @return   arreglo      Arreglo del correo sin los caracteres validos para un correo
         */
        static function validarCorreo($correo){
            //? el arroba solo puede existir una vez
            //? el arroba no puede ser el primer caracter o el ultimo
            //? el menos no puede ser el primer caracter
            //? los puntos no se pueden introducir al principio o al final
            //? no pueden haber puntos juntos
            $caracteresValidosCorreo = array('@','.','_','-','+');
            $listaPosicionCoincidencia = array(array(' '),array(' '),array(' '),array(' '),array(' '));

            // * Seccion de busqueda======================================================================
            for ($caracterComparado = 0; ($caracterComparado != count($caracteresValidosCorreo)); $caracterComparado++){//buscar cada uno de los caracteres especiales que se pueden usar en un correo
                $cantidadCoincidencias = 0;
                for($posX = 0; ($posX != count($correo)); $posX++){//buscar el caracter a lo largo de todo el correo
                    if ($caracteresValidosCorreo[$caracterComparado] == $correo[$posX]){
                        $listaPosicionCoincidencia[$caracterComparado][$cantidadCoincidencias] = $posX; //guardar la posicion de la coincidencia en una lista
                        $cantidadCoincidencias++;
                    }
                }
            }
            //* Fin seccion de busqueda===================================================================
            
            //*Inicio seccion logica de cumplimiento de requerimientos del correo=========================
            $incumplimiento = 0; //Almacena el codigo del requerimiento que se ha incumplido
            // ? los que no pueden ir de primero
            $noVaPrimero = array((array_search('@',$caracteresValidosCorreo)),  //se obtienen las posiciones donde estan los caracteres
                                (array_search('.',$caracteresValidosCorreo)),  //que no deben de estar al principio de un correo
                                (array_search('-',$caracteresValidosCorreo)));
            $noVaPrimeroCant = count($noVaPrimero); //cantidad de caracteres que no deben de ir de primero
            for ($busquedas = 0;(($noVaPrimeroCant != $busquedas) && ($incumplimiento==0)); $busquedas++){
                if (($correo[0] == $caracteresValidosCorreo[$noVaPrimero[$busquedas]]) or ($correo[count($correo)-1] == $caracteresValidosCorreo[$noVaPrimero[$busquedas]])){
                    $incumplimiento = 2;
                }
            }
            //? de los que no puede haber varios (el arroba)
            if ((count($listaPosicionCoincidencia[0]) != 1)  && ($incumplimiento==0)){
                $incumplimiento = 3;
            }
            //? no pueden estar pegados (los puntos)
            $cantidadPuntos = count($listaPosicionCoincidencia[1]);
            if (($cantidadPuntos > 1)  && ($incumplimiento==0)){
                for ($posExam = 1; (($cantidadPuntos != $posExam)  && ($incumplimiento==0)); $posExam++){
                    if (($listaPosicionCoincidencia[1][$posExam] - $listaPosicionCoincidencia[1][$posExam-1] ) == 1){
                        $incumplimiento = 4;
                    }
                }
            }
            //*Inicio seccion logica de cumplimiento de requerimientos del correo=========================

            //* Seccion de impresion DE TABLA(solo para debug)====================================================
            echo "<script>console.log('cValidacion::validarCorreo-> ')</script>";
            $columna = 0;
            while ($columna != count($listaPosicionCoincidencia)){
                $fila = 0;
                $cantidadResultados = count($listaPosicionCoincidencia[$columna]);//cantidad de resultados obtenidos para cada caracter de la lista
                $impResultado = "       | ".$caracteresValidosCorreo[$columna]." | ";
                while ($fila != $cantidadResultados){
                    
                    $impResultado .= ($listaPosicionCoincidencia[$columna][$fila])." | ";//se obtienen las posiciones en las cuales se encontraron los caracteres
                    $fila++;
                }
                echo "<script>console.log('".$impResultado."')</script>";
                $columna++;
            }
            // * Seccion impresion incumplimiento de requisito================================================
            switch($incumplimiento){
                case 2:
                    echo "<script>console.warn('Caracter no permitido al principio o al final del correo presente')</script>";
                    break;
                case 3:
                    echo "<script>console.warn('Caracter presente mas de una vez en el correo')</script>";
                    break;
                case 4:
                    echo "<script>console.warn('Caracter junto a otro caracter del mismo tipo que no pueden estar pegados encontrados')</script>";
                    break;
            }
            //* Fin seccion impresion======================================================================

            //* Seccion de eliminacion de caracteres permitidos================================================
            $listaLinealPosicionCoincidencia = array_merge ($listaPosicionCoincidencia[0],
                                                            $listaPosicionCoincidencia[1],
                                                            $listaPosicionCoincidencia[2],
                                                            $listaPosicionCoincidencia[3],
                                                            $listaPosicionCoincidencia[4],);
            sort($listaLinealPosicionCoincidencia);
            
            for ($columna = 0; ($columna != count($listaLinealPosicionCoincidencia)); $columna++){
                $caracterABorrar = $listaLinealPosicionCoincidencia[$columna];
                if($caracterABorrar != ' '){
                    $correo[$caracterABorrar] = '';
                }
            }
            $correo = str_split(implode($correo));
            if ($incumplimiento != 0){// Incrustar el codigo del incumplimiento en el texto del correo
                    $correo[0] = '+';
                    $correo[1] = $incumplimiento;
                }
            //* Fin Seccion de eliminacion de caracteres permitidos================================================
                return $correo;
        }
        //==============================================================================================================================
        /**
         * Busca en el texto los terminos malsonantes
         * @param   texto       El texto a evaluar
         * @return  numero      0 = Coincidencia no encontrada
         *                      1 = Coincidencia encontrada
         */
        static function busquedaGeneralPalabrasNoPermitidas($text){
            $texto = str_split($text);
            $palabrasNoPermitidas = array("tres", "ruso", "puto", "puta","furro");
            $posX = 0; //numero de la variable del arreglo en el cual se guarda la palabra no permitida a buscar
            $cantidadPalabrasNoPermitidas = count($palabrasNoPermitidas);
            $palabraEncontrada = 0;
            while ($posX != $cantidadPalabrasNoPermitidas && $palabraEncontrada == 0) {//se secciona la palabra a buscar
                $palabraNoPermitida = $palabrasNoPermitidas[$posX];//Se pide la palabra a buscar

                $ubicacionLetraACompararTexto = 0;
                $ubicacionLetraACompararPalabra = 0;
                while ($palabraEncontrada == 0 && $ubicacionLetraACompararTexto != (count($texto) - 1)) {//ciclo de comparacion letra por letra del texto
                    $ubicacionLetraACompararTexto++;

                    if (self::buscarLetraEnTexto($ubicacionLetraACompararTexto, 0, $texto, $palabraNoPermitida) != -1) {//se busca la primer letra de la palabra por todo el texto, y si se logra entonces.....
                        $ubicacionLetraACompararTexto++;
                        $ubicacionLetraACompararPalabra++;
                        
                        $ubicacionLetraACompararTexto = self::buscarCaracteresAOmitir($texto, $ubicacionLetraACompararTexto);
                        while ($palabraEncontrada == 0 && self::buscarLetraEnTexto($ubicacionLetraACompararTexto, $ubicacionLetraACompararPalabra, $texto, $palabraNoPermitida) != -1) {//ciclo de busqueda de los siguentes caracteres

                            if ($ubicacionLetraACompararPalabra == (strlen($palabraNoPermitida) - 1)) {
                                $palabraEncontrada = 1;
                                break;
                            }
                            $ubicacionLetraACompararTexto++;
                            $ubicacionLetraACompararTexto = self::buscarCaracteresAOmitir($texto, $ubicacionLetraACompararTexto);
                            $ubicacionLetraACompararPalabra++;
                        }
                        if ($palabraEncontrada == 0 && self::buscarLetraEnTexto($ubicacionLetraACompararTexto, $ubicacionLetraACompararPalabra, $texto, $palabraNoPermitida) == -1) {//Si al intentar buscar la siguiente letra de la palabra en el texto y no se encuentra entonces...
                            $ubicacionLetraACompararPalabra = 0;
                            $ubicacionLetraACompararTexto--;
                        }
                    }
                }
                $posX++;
            }
            echo "<script>console.log('cValidacion::busquedaGeneralPalabrasNoPermitidas->$palabraEncontrada')</script>";
            return $palabraEncontrada;
        }
        /**
         * Buscar una letra de una palabra en un texto
         * @param   numero  posicion de la letra del texto a comparar
         * @param   numero  posicion de la letra de la palabra a comparar
         * @param   texto   texto a comparar
         * @param   texto   palabra donde esta la letra a buscar en el texto
         * @return  numero  Retorna la posicion donde se encontró la coincidencia
         *                  -1 = no se encuentra la letra buscada en el texto
         */
        static function buscarLetraEnTexto($ubicacionLetraACompararTexto, $ubicacionLetraACompararPalabra, $texto, $palabraNoPermitida){
            $letraPalabraNoPermitida = $palabraNoPermitida[$ubicacionLetraACompararPalabra];
            $posTextoX = $ubicacionLetraACompararTexto;

            if ($posTextoX != count($texto)) {
                $letraDelTexto = $texto[$posTextoX];

                if (self::directorioInteligente($letraPalabraNoPermitida, $letraDelTexto) == 1) {
                    $posEnTextoLetraEncontrada = $posTextoX;
                } else {
                    $posEnTextoLetraEncontrada = -1;
                }
            } else {
                $posEnTextoLetraEncontrada = -1;
            }
            echo "<script>console.log('cValidacion::buscarLetraEnTexto-> $posEnTextoLetraEncontrada')</script>";
            return $posEnTextoLetraEncontrada;
        }
        /**
         * Busca los caracteres que pueden estar en el texto 
         * @param   texto   texto en el cual buscar los caracteres
         * @param   numero  posicion en la cual empezar la comparacion
         * @return  numero  posicion en la cual continuar la comparacion regular
         */
        static function buscarCaracteresAOmitir($texto, $ultimaPosicionValidaEscaneada){
            $caracteresOmitibles = array(' ', '!', '"', ',', '.', '?', '¡', '¿', ';', ':', '*', '(',')');
            $PosicionValidaEscaneada = $ultimaPosicionValidaEscaneada;
            $caracterProbado = 0;
            while (($caracterProbado != count($caracteresOmitibles)) && ($PosicionValidaEscaneada != count($texto))) {//mientras no se hayan probado todos los caracteres
                while ($texto[$PosicionValidaEscaneada] != $caracteresOmitibles[$caracterProbado]) {//mientras el caracter del texto no coincidica con algun caracter omitible
                    $caracterProbado++;

                    if ($caracterProbado == count($caracteresOmitibles)) {
                        break;
                    }
                }
                if ($caracterProbado == count($caracteresOmitibles)) {
                    break;
                }
                if ($texto[$PosicionValidaEscaneada] == $caracteresOmitibles[$caracterProbado]) {
                    $caracterProbado = 0;
                    $PosicionValidaEscaneada++;
                }
            }
            echo "<script>console.log('cValidacion::buscarCaracteresAOmitir-> $PosicionValidaEscaneada')</script>";
            return $PosicionValidaEscaneada;
        }
        /**
         * Compara todas las combinaciones para la letra que se encuentra en el texto
         * para compararla con una letra de las palabras malsonantes a buscar
         * @param   char    letra de la palabra a buscar en el texto
         * @param   texto   letra del texto a comparar con la letra de la palabra
         * @return  numero  0 = la letra de la palabra no coincide con la letra del texto
         *                  1 = la letra de la palabra coincide con la letra del texto
         */
        static function directorioInteligente($letraPalabraNoPermitida, $letraDelTexto){
            $resultado = 0;

            $a = array('a', 'A', '4','á','à');
            $b = array('b', 'B', '6');
            $c = array('c', 'C', 'k', 'K');
            $d = array('d', 'D');
            $e = array('e', 'E', '3','é','è');
            $f = array('f', 'F');
            $g = array('g', 'G');
            $h = array('h', 'H');
            $i = array('i', 'I', 'l','í','ì');
            $j = array('j', 'J');
            $k = array('k', 'K');
            $l = array('l', 'L');
            $m = array('m', 'M');
            $n = array('n', 'N');
            $ñ = array('ñ', 'Ñ', 'n', 'N');
            $o = array('o', 'O', '0','ó','ò');
            $p = array('p', 'P');
            $q = array('q', 'Q');
            $r = array('r', 'R');
            $s = array('s', 'S', 'z', 'Z');
            $t = array('t', 'T', '7');
            $u = array('u', 'U', 'v', 'V','ú','ù','ü');
            $v = array('u', 'U', 'v', 'V','ú','ù','ü');
            $w = array('w', 'W');
            $x = array('x', 'X');
            $y = array('y', 'Y');
            $z = array('s', 'S', 'z', 'Z');

            switch ($letraPalabraNoPermitida) {
                case 'a':
                    $resultado = self::buscarLetraPalabra($a, $letraDelTexto);
                    break;
                case 'b':
                    $resultado = self::buscarLetraPalabra($b, $letraDelTexto);
                    break;
                case 'c':
                    $resultado = self::buscarLetraPalabra($c, $letraDelTexto);
                    break;
                case 'd':
                    $resultado = self::buscarLetraPalabra($d, $letraDelTexto);
                    break;
                case 'e':
                    $resultado = self::buscarLetraPalabra($e, $letraDelTexto);
                    break;
                case 'f':
                    $resultado = self::buscarLetraPalabra($f, $letraDelTexto);
                    break;
                case 'g':
                    $resultado = self::buscarLetraPalabra($g, $letraDelTexto);
                    break;
                case 'h':
                    $resultado = self::buscarLetraPalabra($h, $letraDelTexto);
                    break;
                case 'i':
                    $resultado = self::buscarLetraPalabra($i, $letraDelTexto);
                    break;
                case 'j':
                    $resultado = self::buscarLetraPalabra($j, $letraDelTexto);
                    break;
                case 'k':
                    $resultado = self::buscarLetraPalabra($k, $letraDelTexto);
                    break;
                case 'l':
                    $resultado = self::buscarLetraPalabra($l, $letraDelTexto);
                    break;
                case 'm':
                    $resultado = self::buscarLetraPalabra($m, $letraDelTexto);
                    break;
                case 'n':
                    $resultado = self::buscarLetraPalabra($n, $letraDelTexto);
                    break;
                case 'ñ':
                    $resultado = self::buscarLetraPalabra($ñ, $letraDelTexto);
                    break;
                case 'o':
                    $resultado = self::buscarLetraPalabra($o, $letraDelTexto);
                    break;
                case 'p':
                    $resultado = self::buscarLetraPalabra($p, $letraDelTexto);
                    break;
                case 'q':
                    $resultado = self::buscarLetraPalabra($q, $letraDelTexto);
                    break;
                case 'r':
                    $resultado = self::buscarLetraPalabra($r, $letraDelTexto);
                    break;
                case 's':
                    $resultado = self::buscarLetraPalabra($s, $letraDelTexto);
                    break;
                case 't':
                    $resultado = self::buscarLetraPalabra($t, $letraDelTexto);
                    break;
                case 'u':
                    $resultado = self::buscarLetraPalabra($u, $letraDelTexto);
                    break;
                case 'v':
                    $resultado = self::buscarLetraPalabra($v, $letraDelTexto);
                    break;
                case 'w':
                    $resultado = self::buscarLetraPalabra($w, $letraDelTexto);
                    break;
                case 'x':
                    $resultado = self::buscarLetraPalabra($x, $letraDelTexto);
                    break;
                case 'y':
                    $resultado = self::buscarLetraPalabra($y, $letraDelTexto);
                    break;
                case 'z':
                    $resultado = self::buscarLetraPalabra($z, $letraDelTexto);
                    break;
            }
            echo "<script>console.log('cValidacion::directorioInteligente-> $resultado')</script>";
            return $resultado;
        }
        /**
         * compara una letra del texto con la lista de caracteres posibles que pueden coincidir
         * con la letra de la palabra
         * @param   lista   lista de caracteres que se asemejan a la letra de la palabra que se busca
         * @param   char    letra del texto a comparar 
         * @return  numero  0 = la letra de la palabra no coincide con la letra del texto
         *                  1 = la letra de la palabra coincide con la letra del texto
         */
        static function buscarLetraPalabra($diccionarioLetra, $letraDelTexto){
            $longitudDiccionario = count($diccionarioLetra);
            $posX = 0;
            $caracterEncontrado = 0;
            while (($posX != $longitudDiccionario) && ($caracterEncontrado != 1)) {
                if ($diccionarioLetra[$posX] == $letraDelTexto) {
                    $caracterEncontrado = 1;
                } else {
                    $caracterEncontrado = 0;
                }
                $posX++;
            }
            echo "<script>console.log('cValidacion::buscarLetraPalabra--> $caracterEncontrado')</script>";
            return $caracterEncontrado;
        }
    }//457
    //validarTexto("lohjr324",3);
    //busquedaGeneralPalabrasNoPermitidas("lorem pizder intup..p,ut0n");