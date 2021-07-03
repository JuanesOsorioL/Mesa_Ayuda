<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <!-- Style -->
  <link rel="stylesheet" href="./assets/style/style.css">

  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <title>Pagina de Inicio</title>
<?php   include "./assets/script/view/VistaMenu.php"; ?>

</head>

<body>

  <header>
    <div class="header--logo">
      <a href="./index.php" class="bt-menu"><img class="header__a--img" src="./assets/img/Logo.png" alt="logo"></a>
    </div>

    <div class="header--menu">
      <span>Menu</span>
    <nav class="header--nav">
      <ul class="nav--ul">
          <li class="nav__ul--li"><a href="./assets/html/QuienesSomos.php"><span class="icon-house"></span>Quienes Somos</a></li>
          <li class="nav__ul--li"><a href="./assets/html/Servicios.php"><span class="icon-suitcase"></span>Servicios</a></li>
          <li class="nav__ul--li"><a href="./assets/html/Productos.php"><span class="icon-rocket"></span>Productos</a></li>
          <li class="nav__ul--li"><a href="./assets/html/EstructuraOrganizacional.php"><span class="icon-earth"></span>Estructura Organizacional</a>
          </li>
          <li class="nav__ul--li"><a href="./assets/html/Contactos.php"><span class="icon-mail"></span>Contactos</a></li>
      </ul>
    </nav>
    </div>

    <div class="header--loguin">
    </div>

  </header>

  <main>
        <section class="main--submenu">
          <?php echo $menu;?>
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
<script src="./assets/script/view/javascript/Menu.js"></script>
</html>