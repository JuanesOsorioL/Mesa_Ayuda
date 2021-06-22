let control = true;

$(document).ready(main);

function main() {
  Action = "LoadPage";
  var ruta = "Action=" + Action;
  $.ajax({
    url: "../script/view/VistaGestionUsuario.php",
    type: "POST",
    data: ruta,
  })
    .done(function (respu) {
      $(".section--Usuarios").html(respu);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
}

function Update(user, pass, Cedula) {
  Action = "Update";
  var ruta =
    "Action=" +
    Action +
    "&user=" +
    user +
    "&pass=" +
    pass +
    "&Cedula=" +
    Cedula;
  $.ajax({
    url: "../script/view/VistaGestionUsuario.php",
    type: "POST",
    data: ruta,
  })
    .done(function (respu) {
      if (parseInt(respu) === 1) {
        $(".resultado").html("Se actualizo correctamente");
      } else {
        $(".resultado").html("No Se actualizo correctamente");
      }
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
}

function lock(e) {
  if (control) {
    let Nodo = e.target.parentNode;
    let Cedula =
      e.target.parentNode.parentNode.parentNode.children[0].textContent;
    Locked(Cedula, Nodo);
  } else {
    document.querySelector(".resultado").textContent =
      "Primero Guardar Cambios";
  }
}

function Locked(Cedula, Nodo) {
  Action = "Locked";
  var ruta = "Action=" + Action + "&Cedula=" + Cedula;
  $.ajax({
    url: "../script/view/VistaGestionUsuario.php",
    type: "POST",
    data: ruta,
  })
    .done(function (respu) {
      if (parseInt(respu) === 1) {
        let padre = Nodo.parentNode;
        while (padre.firstChild) {
          padre.removeChild(padre.firstChild);
        }
        padre.innerHTML =
          '<div class="contenedor-iconlock"><i class="fas fa-user-lock" onclick="unlock(event)"></i></div>';
        $(".resultado").html("Se Inhabilito correctamente");
      } else {
        $(".resultado").html("No Se Inhabilito");
      }
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
}

function unlock(e) {
  if (control) {
    let Nodo = e.target.parentNode;
    let Cedula =
      e.target.parentNode.parentNode.parentNode.children[0].textContent;
    Unlocked(Cedula, Nodo);
  } else {
    document.querySelector(".resultado").textContent =
      "Primero Guardar Cambios";
  }
}

function Unlocked(Cedula, Nodo) {
  Action = "Unlocked";
  var ruta = "Action=" + Action + "&Cedula=" + Cedula;
  $.ajax({
    url: "../script/view/VistaGestionUsuario.php",
    type: "POST",
    data: ruta,
  })
    .done(function (respu) {
      if (parseInt(respu) === 1) {
        let padre = Nodo.parentNode;
        while (padre.firstChild) {
          padre.removeChild(padre.firstChild);
        }
        padre.innerHTML =
          '<div class="contenedor-icon"><i class="fas fa-pen" onclick = "editar(event)" ></i><i class="fas fa-save" onclick="guardar(event)"></i></div ><div class="contenedor-icon"><i class="fas fa-trash-alt" onclick="lock(event)"></i></div>';

        $(".resultado").html("Se habilito correctamente");
      } else {
        $(".resultado").html("No Se habilito");
      }
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
}

function editar(e) {
  if (control) {
    let user =
      e.target.parentNode.parentNode.parentNode.children[2].children[0];
    let pass =
      e.target.parentNode.parentNode.parentNode.children[3].children[0];
    user.removeAttribute("disabled");
    user.setAttribute("enabled", " ");
    pass.removeAttribute("disabled");
    pass.setAttribute("enabled", " ");
    e.target.style.display = "none";
    e.target.nextElementSibling.style.display = "initial";
    control = false;
  } else {
    document.querySelector(".resultado").textContent =
      "Primero Guardar Cambios";
  }
}

function guardar(e) {
  if (!control) {
    let user =
      e.target.parentNode.parentNode.parentNode.children[2].children[0];
    let pass =
      e.target.parentNode.parentNode.parentNode.children[3].children[0];
    let Cedula =
      e.target.parentNode.parentNode.parentNode.children[0].textContent;
    user.removeAttribute("enabled");
    user.setAttribute("disabled", " ");
    pass.removeAttribute("enabled");
    pass.setAttribute("disabled", " ");
    e.target.style.display = "none";
    e.target.previousElementSibling.style.display = "initial";
    control = true;
    document.querySelector(".resultado").textContent = "";
    Update(user.value, pass.value, Cedula);
  } else {
    document.querySelector(".resultado").textContent =
      "Primero Guardar Cambios";
  }
}
