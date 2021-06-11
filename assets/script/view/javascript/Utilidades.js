function subirFoto() {
  document.querySelector(".form--input-foto").click();
}

function subirCV() {
  document.querySelector(".form--input-cv").click();
}

function submenu() {
  document.querySelector(".section--subnav").classList.toggle("ampliar");

  let estilo = document.getElementById("submenu").style.visibility;

  if (estilo === "" || estilo === "hidden") {
    document.getElementById("submenu").style.visibility = "initial";
  } else {
    document.getElementById("submenu").style.visibility = "hidden";
  }
}

if (window.location.pathname === "/Mesa_Ayuda/assets/html/Alertas.php") {
  document.getElementById("Alertas").textContent = "Menu";
  document.getElementById("Alertas").attributes[2].value = "./Menu.php";
  document.getElementById("Alertas").style.color = "#000000";
}

if (window.location.pathname === "/Mesa_Ayuda/assets/html/GestionArea.php") {
  document.getElementById("GestionArea").textContent = "Menu";
  document.getElementById("GestionArea").attributes[2].value = "./Menu.php";
  document.getElementById("GestionArea").style.color = "#000000";
}

if (
  window.location.pathname === "/Mesa_Ayuda/assets/html/ConsultarEmpleado.php"
) {
  document.getElementById("GestionEmpleado").textContent = "Menu";
  document.getElementById("GestionEmpleado").attributes[2].value = "./Menu.php";
  document.getElementById("GestionEmpleado").style.color = "#000000";
}

if (
  window.location.pathname === "/Mesa_Ayuda/assets/html/GestionUsuarios.php"
) {
  document.getElementById("GestionUsuario").textContent = "Menu";
  document.getElementById("GestionUsuario").attributes[2].value = "./Menu.php";
  document.getElementById("GestionUsuario").style.color = "#000000";
}

if (window.location.pathname === "/Mesa_Ayuda/assets/html/GestionCargos.php") {
  document.getElementById("GestionCargos").textContent = "Menu";
  document.getElementById("GestionCargos").attributes[2].value = "./Menu.php";
  document.getElementById("GestionCargos").style.color = "#000000";
}
