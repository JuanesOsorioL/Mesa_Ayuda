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

if (window.location.pathname === "/Mesa_Ayuda/GestionArea.php") {
  document.getElementById("GestionArea").textContent = "Menu";
  document.getElementById("GestionArea").attributes[2].value = "./Menu.php";
  document.getElementById("GestionArea").style.color = "#000000";
}
