<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Style -->
    <link rel="stylesheet" href="../style/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Consultar Empleado</title>

  </head>

  <?php 
    include "../script/view/VistaMenu.php";
    include "../script/view/VistaC_M_D_Empleado.php";
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
        <img class="header--img" src="../<?php echo $_SESSION['Session']['Foto'];?>" alt="" />

        <div class="header--ventanaLoguin">
          <a href="../../index.php">Logout</a>


        </div>

      </div>
    </header>

    <main class="main_busqueda">

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

      <section class="main--consultaempleado">
        <form class="consultaempleado--form" method="POST" enctype='multipart/form-data'
                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
          <table>
            <tr>
              <td colspan="2" class="td--tituloprincipal">Consultar Empleados</td>
            </tr>
            <tr>
              <td class="td--titulosecundario">Cedula: </td>
              <td><input class="input--texto" type="text" id="IDEmple" name="txtIDEmpleado" value=""></td>
            </tr>
            <tr>
              <td colspan="2"><input type="button" name="btn" id="consultar" value="Consultar" onclick="consulta()"
                  class="input-btn" /></td>
            </tr>


          </table>

          <div id="resultadoconsulta"></div>
        </form>


      </section>

    <section>
      <div id="RequerimientoSinAsignar"></div>
      <div id="Observaciones"></div>
      <div id="MSJ"></div>
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
        <span>© 2021 Copyright</span>
      </div>

    </div>
  </footer>
  
</body>
<script src="../script/view/javascript/Utilidades.js"></script>
<script src="../script/view/javascript/ConsultarEmpleado.js"></script>
</html>