/**
 * Funcion Principal
 * @param {Array} arrayInfo 
 * @param {Int} searchMode 0 = Modo de busquedas desactivado | 1 = Modo de busquedas Activado 
 */
    function localize(arrayInfo = -1, searchMode = 0)
    {
        if (navigator.geolocation)
        {
            window.positionsArray = arrayInfo;
            window.searchMode = searchMode;
            navigator.geolocation.getCurrentPosition(mapa);
        }
        else
        {
            alert("Tu navegador no soporta geolocalizacion.");
        }
        
    }

    function mapa(pos)
    {
    /************************ Aqui están las variables que te interesan***********************************/
        
        var latitud = pos.coords.latitude;
        var longitud = pos.coords.longitude;
        var precision = pos.coords.accuracy;
        
        window.latitud = latitud;
		window.longitud = longitud;

        var contenedor = document.getElementById("map")

        var centro = new google.maps.LatLng(latitud,longitud);

        var propiedades =
        {
            zoom: 15,
            center: centro,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            fullscreenControl: true,
            fullscreenControlOptions:{
                position: google.maps.ControlPosition.RIGHT_BOTTOM,
            }
        };

        var map = new google.maps.Map(contenedor, propiedades);

        var posActual = new google.maps.Marker({/*MARCADOR POSICION ACTUAL*/
            position : centro,
            draggable: false,
            map: map,
            title: "Tu posicion actual"
        });

        var posActIcon = {/* Crear un marcador para emplearlo en google maps */
            url: './png/menuIcons/Mapa.png',
            origin: new google.maps.Point(0,0),
            anchor: new google.maps.Point(20,40)
        };

        positionsArray = window.positionsArray;//tranferir la informacion de una variable global a una local
        searchMode = window.searchMode;

        if(positionsArray!=-1){//Si existe el array
            var coords = new Array(100);/*Maximo de resultados posibles */
            var titles = new Array(100);
            var idsLocation = new Array(100);
            var tiposUbicacion = new Array(100);
            for(i=0;i!=positionsArray.length;i++){
                var latPos = parseFloat(positionsArray[i][1]);//Latitud
                var lonPos = parseFloat(positionsArray[i][2]);//Longitud
                
                if(searchMode==1){
                    var idUbicacion = parseInt(positionsArray[i][0]);//Id del resultado de la busqueda
                    var tipoUbicacion = parseInt(positionsArray[i][4]);//evento o tienda
                    idsLocation[i] = idUbicacion;
                    tiposUbicacion[i] = tipoUbicacion;
                }
                
                //while(parseInt(positionsArray[i][2]).search('_')!=-1){//remover las "_" y reemplazarlas por espacios
                //    positionsArray[i][2] = positionsArray[i][2].replace('_',' ');
                //}
                coords[i] = { lat: latPos, lng: lonPos };//Coordenadas
                titles[i] = "hola"//positionsArray[i][2];//Nombre del tipo de evento - de la tienda
                
            }
            i=0;
            if(searchMode==0){//si no se esta realizando una busqueda
                const markers = coords.map((coord, i) => {
                    return new google.maps.Marker({
                        icon: posActIcon,
                        position: coord,
                        title: titles[i % titles.length],
                        map:map
                    });
                });
            }else{
                for(i=0;i!=positionsArray.length;i++){
                    marker = new google.maps.Marker({
                        id: idsLocation[i], //id del evento | tienda
                        typeLocation: tiposUbicacion[i],// lo que identifica si es un evento o una tienda
                        icon: posActIcon,
                        position: coords[i],
                        title: titles[i % titles.length],
                        map:map
                    });
                    //la cosa que escucha que marcador se cliquea.
                    /*google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            ventanas(i);
                            //TODO: meter aqui lo que sea que haga que la ventana aparezca
                        }
                    })(marker, i));*/
                }
            }
        }
    }
    // TODO: definir una funcion que mantenga abierta solo una ventana de informacion y cierre las demas
    /*function ventanas(i)
    {
        positionsArray = window.positionsArray;
        for(ventana=0;ventana!=positionsArray.length;ventana++){//para cada ventana hacer los siguiente
            document.getElementById(posicionsArray[i][2]+"_"+posicionsArray[i][3]).style.height = "0px";//cerrar la ventana
            if(i==ventana){
                document.getElementById(posicionsArray[i][2]+"_"+posicionsArray[i][3]).style.height = "0px";//cerrar la ventana
            }
        }
    }*/