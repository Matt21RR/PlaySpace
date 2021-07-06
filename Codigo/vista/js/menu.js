/* Set the width of the side navigation to 250px */
function openNav() {
  if (window.innerWidth <= 350){
    document.getElementById("mySidenav").style.width = "230px";
  }else{
    document.getElementById("mySidenav").style.width = "270px";
  }
  document.getElementById("userPhoto").style.width = "70px";
  document.getElementById("userPhoto").style.height = "70px";
  document.getElementById("userPhoto").style.border = "2px solid white";
}

window.addEventListener("resize",
  //si el tamaño de la ventana es <= 350px y la foto tiene un tamaño != de 0(lo cual significa que el menu esta abierto)
  function(){if((window.innerWidth<=350) && (document.getElementById("userPhoto").style.width != "0px")){ 
    document.getElementById("mySidenav").style.width = "230px";
  }else if((window.innerWidth>350) && (document.getElementById("userPhoto").style.width != "0px")){
    document.getElementById("mySidenav").style.width = "270px";
  }else if(document.getElementById("userPhoto").style.width == "0px"){//mantener cerrado el menu
    document.getElementById("mySidenav").style.width = "0px";
    
  }
});

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0px";
  document.getElementById("userPhoto").style.width = "0px";
  document.getElementById("userPhoto").style.height = "0px";
  document.getElementById("userPhoto").style.border = "unset";
}