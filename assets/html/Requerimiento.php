<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Requerimiento</title>
  </head>
  <?php
  include "../script/view/VistaMenu.php";
  include "../script/view/VistaRegistroEmpleado.php";
  ?>


  <body>

  <header>
    <div class="header--logo">
      <a href="../../index.php" class="bt-menu"><img class="header__a--img" src="../img/Logo.png" alt="logo"></a>
    </div>

    <div class="header--menu">
      <span>Menu</span>
           <nav class="header--nav">
        <ul class="nav--ul">
          <li class="nav__ul--li"><a href="./QuienesSomos.php"><span class="icon-house"></span>Quienes Somos</a></li>
          <li class="nav__ul--li"><a href="./Servicios.php"><span class="icon-suitcase"></span>Servicios</a></li>
          <li class="nav__ul--li"><a href="./Productos.php"><span class="icon-rocket"></span>Productos</a></li>
          <li class="nav__ul--li"><a href="./EstructuraOrganizacional.php"><span class="icon-earth"></span>Estructura Organizacional</a>
          </li>
          <li class="nav__ul--li"><a href="./Contactos.php"><span class="icon-mail"></span>Contactos</a></li>
        </ul>
      </nav>
    </div>

    <div class="header--loguin">
    </div>

  </header>

  <main>

      <section class="main--submenu">
        <?php echo $menu?>
      </section>

  <section class="main--requerimiento">
      <table>
        <tr>
          <td>Radicar Requerimiento</td>
        </tr>
        <tr>
          <td>Empleado: 
            <label>
            <?php  
              $Nombre=$_SESSION['Session']['Nombre'];
              echo $Nombre;
            ?>
            </label>
          </td>
        </tr>
        <tr>
          <td>Area: 
            <select id="selectArea">
            <?php CargarListarArea();?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Asunto :
            <input type="text" id="titulo">
          </td>
        </tr>
        <tr>
          <td>REQUERIMIENTO</td>
        </tr>
        <tr>
          <td>
            <textarea id="message" rows="10" cols="30"></textarea>
          </td>
        </tr>
        <tr>
          <td> 
            <input type="button" value="Radicar"  onclick="Guardar();" id="radicar">
            <input type="button" value="Menu"  onclick="Menu();">
          </td>
        </tr>
    </table>
  </section>

  <section class="main--respuestarequerimiento"></section>

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
  <script src="../script/view/javascript/Utilidades.js"> </script>
  <script src="../script/view/javascript/Requerimientos.js"></script>
<script src="../script/view/javascript/menu.js"></script>
</html>