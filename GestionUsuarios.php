<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

   <!-- Style -->
    <!-- <link rel="stylesheet" href="./assets/style/style.css"> -->
    <link rel="stylesheet" href="./style/style.css">

    <title>Gestionar Usuarios</title>

  </head>

  <?php  include "./Vista/VistaMenu.php"; ?>

  <body>

    <header>

      <div class="header--logo">
        <a href="./index.php" class="bt-menu"><img class="header__a--img" src="./img/Logo.png" alt="logo"></a>
      </div>

      <div class="header--menu">
        <span>Menu</span>
        <nav class="header--nav">
          <ul class="nav--ul">
            <li class="nav__ul--li"><a href="#"><span class="icon-house"></span>Quienes Somos</a></li>
            <li class="nav__ul--li"><a href="#"><span class="icon-suitcase"></span>Servicios</a></li>
            <li class="nav__ul--li"><a href="#"><span class="icon-rocket"></span>Productos</a></li>
            <li class="nav__ul--li"><a href="#"><span class="icon-earth"></span>Estructura Organizacional</a></li>
            <li class="nav__ul--li"><a href="#"><span class="icon-mail"></span>Contactos</a></li>
          </ul>
        </nav>
      </div>

      <div class="header--loguin">
        <img class="header--img" src="<?php echo $_SESSION['Session']['Foto'];?>" alt="" />
        <div class="header--ventanaLoguin">
          <a href="./index.php">Logout</a>
        </div>
      </div>

    </header>

    <main>

      <section class="main--submenu">

        <div class="contenedor">
          <div class="contenedor-icono">
            <i class="fas fa-ellipsis-v" onclick="submenu()"></i>
          </div>
          <div class="contenedor-submenu">
            <span class="nombre_usuario">
              <?php echo $_SESSION['Session']['Nombre'];?>
            </span>
            <?php echo $menu; ?>
          </div>
          <div class="contenedor-margin"></div>
        </div>

      </section>

      <section class="section--Usuarios"></section>

      <section class="main__section-Mensaje">
        <h1 class="resultado"> </h1>
      </section>

    </main>


    <footer>

      <div class="footer-contenedor">
        <div class="redessociales">
          <div class="circulo">
            <i class="fab fa-twitter-square"></i>
          </div>

          <div class="circulo">
            <i class="fab fa-linkedin"></i>
          </div>

          <div class="circulo">
            <i class="fab fa-telegram"></i>
          </div>

          <div class="circulo">
            <i class="fab fa-facebook-square"></i>
          </div>

        </div>

        <div class="texto">
          <span>Mesa De Ayuda - Colombia</span>
          <span>© 2020 Copyright</span>
        </div>

      </div>

    </footer>

  </body>

  <!-- javascript -->
  <script src="./assets/script/utilidades.js"> </script>

  <script>

  let control = true;

  $(document).ready(main);

  function main(){
    Action = "LoadPage";
    var ruta = "Action=" + Action;
    $.ajax({
      url: './Vista/VistaGestionUsuario.php',
      type: 'POST',
      data: ruta,
    }).done(function (respu) {
      $('.section--Usuarios').html(respu);
    }).fail(function () {
      console.log("error");
    }).always(function () {
      console.log("complete");
    })
  };

  function Update(user, pass, Cedula){
    Action = "Update";
    var ruta = "Action=" + Action + "&user=" + user + "&pass=" + pass + "&Cedula=" + Cedula;
    $.ajax({
      url: './Vista/VistaGestionUsuario.php',
      type: 'POST',
      data: ruta,
    }).done(function (respu) {
    
      if (parseInt(respu) === 1) {
        $('.resultado').html("Se actualizo correctamente");
      } else {
        $('.resultado').html("No Se actualizo correctamente");
      }
    }).fail(function () {
      console.log("error");
    }).always(function () {
      console.log("complete");
    })
  };



  function lock(e){
    if (control) {
      let Nodo = e.target.parentNode;
      let Cedula = e.target.parentNode.parentNode.parentNode.children[0].textContent;
      Locked(Cedula, Nodo);
    } else {
      document.querySelector(".resultado").textContent="Primero Guardar Cambios";
    }
  }

  function Locked(Cedula, Nodo){
    Action = "Locked";
    var ruta = "Action=" + Action + "&Cedula=" + Cedula;
    $.ajax({
      url: './Vista/VistaGestionUsuario.php',
      type: 'POST',
      data: ruta,
    }).done(function (respu) {
      if (parseInt(respu) === 1) {
        let padre = Nodo.parentNode
        while (padre.firstChild){
          padre.removeChild(padre.firstChild);
        }; 
        padre.innerHTML='<div class="contenedor-iconlock"><i class="fas fa-user-lock" onclick="unlock(event)"></i></div>';
        $('.resultado').html("Se Inhabilito correctamente");
      } else {
        $('.resultado').html("No Se Inhabilito");
      }
    }).fail(function () {
      console.log("error");
    }).always(function () {
      console.log("complete");
    }) 
  };

  function unlock(e) {
      if (control) {
      let Nodo = e.target.parentNode;
      let Cedula = e.target.parentNode.parentNode.parentNode.children[0].textContent;
      Unlocked(Cedula, Nodo);
    } else {
      document.querySelector(".resultado").textContent = "Primero Guardar Cambios";
    }
  }

  function Unlocked(Cedula, Nodo) {
    Action = "Unlocked";
    var ruta = "Action=" + Action + "&Cedula=" + Cedula;
    $.ajax({
      url: './Vista/VistaGestionUsuario.php',
      type: 'POST',
      data: ruta,
    }).done(function (respu) {
      if (parseInt(respu) === 1) {
        let padre = Nodo.parentNode
        while (padre.firstChild) {
          padre.removeChild(padre.firstChild);
        };
        padre.innerHTML = '<div class="contenedor-icon"><i class="fas fa-pen" onclick = "editar(event)" ></i><i class="fas fa-save" onclick="guardar(event)"></i></div ><div class="contenedor-icon"><i class="fas fa-trash-alt" onclick="lock(event)"></i></div>';

        $('.resultado').html("Se habilito correctamente");
      } else {
        $('.resultado').html("No Se habilito");
      }
    }).fail(function () {
      console.log("error");
    }).always(function () {
      console.log("complete");
    })
  };

  function editar(e) {
    if (control) {
      let user = e.target.parentNode.parentNode.parentNode.children[2].children[0];
      let pass = e.target.parentNode.parentNode.parentNode.children[3].children[0];
      user.removeAttribute("disabled");
      user.setAttribute("enabled", " ");
      pass.removeAttribute("disabled");
      pass.setAttribute("enabled", " ");
      e.target.style.display = "none";
      e.target.nextElementSibling.style.display = "initial";
      control = false;
    } else {
      document.querySelector(".resultado").textContent="Primero Guardar Cambios";
    }
  }

  function guardar(e) {
    if (!control) {
      let user = e.target.parentNode.parentNode.parentNode.children[2].children[0];
      let pass = e.target.parentNode.parentNode.parentNode.children[3].children[0];
      let Cedula = e.target.parentNode.parentNode.parentNode.children[0].textContent;
      user.removeAttribute("enabled");
      user.setAttribute("disabled", " ");
      pass.removeAttribute("enabled");
      pass.setAttribute("disabled", " ");
      e.target.style.display = "none";
      e.target.previousElementSibling.style.display = "initial";
      control = true;
       document.querySelector(".resultado").textContent="";////////////////
      Update(user.value, pass.value, Cedula);
    } else {
      document.querySelector(".resultado").textContent="Primero Guardar Cambios";
    }
  }

  </script>
    
</html>