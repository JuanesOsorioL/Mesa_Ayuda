<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style -->
    <!-- <link rel="stylesheet" href="./assets/style/style.css"> -->
    <link rel="stylesheet" href="./style/style.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Gestion Cargos</title>

  </head>

  <?php 
   include "./Vista/VistaMenu.php";
   include "./Vista/VistaGestionCargos.php";
  ?>


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
            <li class="nav__ul--li"><a href="#"><span class="icon-earth"></span>Estructura Organizacional</a>
            </li>
            <li class="nav__ul--li"><a href="#"><span class="icon-mail"></span>Contactos</a></li>
          </ul>
        </nav>

      </div>

      <div class="header--loguin">
        <img class="header--img" src="<?php echo $_SESSION['Session']['Foto']?>" alt="" />
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
              <?php echo $_SESSION['Session']['Nombre']?>
            </span>
            <?php echo $menu?>
          </div>
          <div class="contenedor-margin"></div>
        </div>

      </section>


    <section class="main__sectionCargo"></section>

    <section class="main_section-VentanaNew"></section>

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
  <script src="./assets/script/utilidades.js"> </script>

<script>
  let control = true;
  let Action;

  $(document).ready(main);

  function main(){
    Action = "LoadPage";
    let ruta = "Action=" + Action;
    $.ajax({
      url: './Vista/VistaGestionCargos.php',
      type: 'POST',
      data: ruta,
    }).done(function (respu) {
      $('.main__sectionCargo').html(respu);
    }).fail(function () {
      console.log("error");
    }).always(function () {
      console.log("complete");
    })
  };

  function Activar(params) {
    document.querySelector(".resultado").textContent="";
    let template=`
    <div class="section-Ventananew">
      <div class="section_Ventananew-contenedor">
        <table>
          <tr>
            <td colspan="2">
              Nueva Area
            </td>
          </tr>
          <tr>
            <td>Nombre:</td>
            <td><input type="text" name="" id=""></td>
          </tr>
          <tr>
            <td colspan="2">
              <span onclick="guardarVentana(event)"> Guardar<i class="fas fa-save" ></i></span>
              <span onclick="Cerrar()"> Cerrar<i class="fas fa-save" ></i></span>
            </td>
          </tr>
            <tr>
            <td colspan="2" class="ventana-Respuesta">
              
            </td>
          </tr>
        </table>
      </div>
    </div>`;
    $('.main_section-VentanaNew').html(template);
  }

   function guardarVentana(e) {
    let value=e.target.parentNode.parentNode.previousElementSibling.children[1].children[0].value 

    Action = "NewArea";
    var ruta = "Action=" + Action+"&Nombre="+value;
    $.ajax({
      url: './Vista/VistaGestionCargos.php',
      type: 'POST',
      data: ruta,
    }).done(function (e) {  
    if (parseInt(e) === 1) {
      $('.ventana-Respuesta').html(" <span >Nombre del Cargo Ya Existe</span>"); 
    } else {
      main();
       $('.resultado').html("");
      $('.main_section-VentanaNew').html(""); 
    }
    }).fail(function () {
      console.log("error");
    }).always(function () {
      console.log("complete");
    }) 
  }

  function Cerrar() {
    main();
    $('.main_section-VentanaNew').html("");
  }

  function editar(e) {
    if (control) {
     let Name = e.target.parentNode.parentNode.previousElementSibling.children[0];
      Name.removeAttribute("disabled");
      Name.setAttribute("enabled", " ");
      e.target.style.display = "none";
      e.target.nextElementSibling.style.display = "initial";
      control = false;
      $('.resultado').html("");
    } else {
      document.querySelector(".resultado").textContent="Primero Guardar Cambios";
    }
  }

  function modificar(e) {
    if (!control) {
      let Name = e.target.parentNode.parentNode.previousElementSibling.children[0];
      Name.removeAttribute("enabled");
      Name.setAttribute("disabled", " ");
      e.target.style.display = "none";
      e.target.previousElementSibling.style.display = "initial";
      document.querySelector(".resultado").textContent="";
      control = true;
      let valor=Name.value;
      let id=e.target.parentNode.parentNode.previousElementSibling.previousElementSibling.children[0].textContent;
      guardarModificacion(valor,id);
    } else {
      document.querySelector(".resultado").textContent="Primero Guardar Cambios";
    }
  }

  function guardarModificacion(valor,id) {
    Action = "Update";
    var ruta = "Action=" + Action+"&Nombre="+valor+"&id="+id;
    $.ajax({
      url: './Vista/VistaGestionCargos.php',
      type: 'POST',
      data: ruta,
    }).done(function (e) {  
    if (parseInt(e) === 1) {
      main();
      $('.resultado').html("Se actualizo Correctamente");
    }  else {
      $('.resultado').html("Se actualizo Correctamente");
    }  
    }).fail(function () {
      console.log("error");
    }).always(function () {
      console.log("complete");
    }) 
  }

  function eliminar(e) {
    if (control) {
      let id = e.target.parentNode.parentNode.previousElementSibling.previousElementSibling.children[0].textContent;

      let fecha = new Date();
      let FechaActual=fecha.getFullYear()+ "-" +(fecha.getMonth() +1)+ "-" + fecha.getDate();
      let FechaInicial='0000-00-00';

      let Nodo=e.target.parentNode;
      let Estado='Inactivo';
       
    /*  let a=1;
      let b='0000-00-00';
      let c='2222-10-10';
      EliminarCargo(a,b,c,Estado,Nodo);  */
     EliminarCargo(id,FechaInicial,FechaActual,Estado,Nodo);

    } else {
      document.querySelector(".resultado").textContent="Primero Guardar Cambios";
    }
  }

  function EliminarCargo(id,FechaInicial,FechaActual,Estado,Nodo) {

    Action="Delete";
    var ruta="Action="+Action+"&id="+id+"&FechaActual="+FechaActual+"&FechaInicial="+FechaInicial+"&Estado="+Estado;

    $.ajax({
      url: './Vista/VistaGestionCargos.php',
      type: 'POST',
      data: ruta,
    }).done(function (e) { 
      if (parseInt(e)===-1) {
        $('.resultado').html("No se Cambio el estado Intente de Nuevo");
      } else {
        if (parseInt(e) !== 0) {
          let padre = Nodo.parentNode
          while (padre.firstChild){
            padre.removeChild(padre.firstChild);
          }; 
          padre.innerHTML='<div class="contenedor-iconlock"><i class="fas fa-user-lock" onclick="unlock(event)"></i></div>';
          $('.resultado').html("Se Cambio Estado Correctamente");
        }  else {
          $('.resultado').html("Se Cambio Estado de algunos empleados");
        }
      }
    }).fail(function () {
      console.log("error");
    }).always(function () {
      console.log("complete");
    })
  }

  function bloqueado(e) {
     if (control) {
    document.querySelector(".resultado").textContent="No es Posible Editar o Modificar este Cargo";
    } else {
      document.querySelector(".resultado").textContent="Primero Guardar Cambios";
    }
  }

  function unlock(e) {
      if (control) {
      let Nodo = e.target.parentNode;
      let id = e.target.parentNode.parentNode.parentNode.children[0].textContent;
      let Estado='Activo';
      Unlocked(id,Estado, Nodo); 
    } else {
      document.querySelector(".resultado").textContent = "Primero Guardar Cambios";
    }
  }

  function Unlocked(id,Estado, Nodo) {
    Action = "Unlocked";
    var ruta = "Action="+Action+"&id="+id+"&Estado="+Estado;
    $.ajax({
      url: './Vista/VistaGestionCargos.php',
      type: 'POST',
      data: ruta,
    }).done(function (respu) {
      if (parseInt(respu) === 1) {
        let padre = Nodo.parentNode
        while (padre.firstChild) {
          padre.removeChild(padre.firstChild);
        };
        padre.innerHTML = `
        <div class="contenedor-icon">
          <i class="fas fa-pen" onclick = "editar(event)" ></i>
          <i class="fas fa-save" onclick="modificar(event)"></i>
        </div>
        <div class="contenedor-icon">
          <i class="fas fa-trash-alt" onclick="eliminar(event)"></i>
        </div>`;

        $('.resultado').html("Se habilito correctamente");
      } else {
        $('.resultado').html("No Se habilito");
      }
    }).fail(function () {
      console.log("error");
    }).always(function () {
      console.log("complete");
    })
  }

</script>
</html>