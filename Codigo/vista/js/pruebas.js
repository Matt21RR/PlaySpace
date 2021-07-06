// ---------- OPCIONES DEPORTIVAS (CREACIÓN TIENDA) --------------------
function enable_disabled_ValueSport(option_Sport){
    console.log(option_Sport);
    var option_Sport = document.getElementById(option_Sport);
    console.log(option_Sport);
    option_Sport.style.disabled = (option_Sport.style.disabled == true) ? false : true;
}