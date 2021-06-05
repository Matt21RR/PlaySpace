<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./css/bootstrap.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Document</title>
</head>
<body>

<div class="navbar navbar-fixed-top" style="position:fixed; top:0; width: 100%; z-index:2;">
    <div class="navbar-inner">
        <ul class="nav">
            <span onclick="openNav()"><img src="./svg/menu.svg" class="menuico" style="padding-left:10px; margin-bottom:4px;"></span>
            <div class="mainTitle">PlaySpace</div>
        </ul>
    </div>
</div>




<!-- Use any element to open the sidenav -->


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn overflow-hidden"onclick="closeNav()"><img src="./svg/menu.svg" class="menuico">Menu</a>
  <div class="userInformation">
    <div class="row">
      <div class="col-4" >
        <img id="userPhoto" class="userPhoto" src="./png/foto_perfil/11.svg"><!--ID DE FOTO DE PERFIL AQUI-->
      </div>
      <div class="col-8" style="margin-left:30%;">
          <div class="sectionText" style="padding-top:10px;">
            Matt21RR<!--NICKNAME AQUI-->
          </div>
        <div class="sectionText">
          ID - 267391<!--ID AQUI-->
        </div>
        
      </div>
    </div>
    
      
  </div>
  <hr width="90%" size=4 noshade="noshade">
  <a class= "overflow-hidden" href="#"><img src="./png/menuIcons/Perfil.svg" class="menuico"><div class="sectionText">Perfíl</div></a>
  <a class= "overflow-hidden" href="#"><img src="./png/menuIcons/Amigos.svg" class="menuico"><div class="sectionText">Amigos</div></a>
  <a class= "overflow-hidden" href="#"><img src="./png/menuIcons/Evento.svg" class="menuico"><div class="sectionText">Eventos</div></a>
  <a class= "overflow-hidden" href="#"><img src="./png/menuIcons/Mapa.svg" class="menuico"><div class="sectionText">Mapa y Búsqueda</div></a>
  <hr width="90%" size=4 noshade="noshade">
  <a class= "overflow-hidden" href="#"><img src="./png/menuIcons/Evento.svg" class="menuico"><div class="sectionText">Eventos Creados</div></a>
  <a class= "overflow-hidden" href="#"><img src="./png/menuIcons/Tienda.svg" class="menuico"><div class="sectionText">Tiendas Creadas</div></a>
</div>

<?php include("pInicioSesion.php"); ?>

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
<div id="main">
</div>


<script>
/* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "270px";
  document.getElementById("userPhoto").style.width = "70px";
  document.getElementById("userPhoto").style.height = "70px";
  document.getElementById("userPhoto").style.border = "2px solid white";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("userPhoto").style.width = "0";
  document.getElementById("userPhoto").style.height = "0";
  document.getElementById("userPhoto").style.border = "unset";
}
</script>
</body>
</html>