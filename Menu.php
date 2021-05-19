<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="./assets/style/style.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
  <!--       <script>
             function consultarEmpleado(){
            window.location.href="./ConsultarEmpleado.php";
            }
            function Cerrarseccion(){
            window.location.href="./index.php";
            }
            function Requerimiento(){
            window.location.href="./Requerimiento.php";
            }

            function GestionArea(){
            window.location.href="./GestionArea.php";
            }
            function Consulta(){
            window.location.href="./Consultas.php";
            }
            function MisRequerimientos(){
            window.location.href="./MisRequerimientos.php";
            }
        </script> -->
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
            <img class="header--img" src="./img/loguin.jpg" alt="" />

            <div class="header--ventanaLoguin">
                <a href="./index.php">Cerrar Seccion</a>
               

            </div>

        </div>
    </header>
        <main>
            <section class="main--submenu">
            <?php 
            include "./Vista/VistaMenu.php";
            echo $menu; ?>
            </section>
        </main>

        <footer>
        </footer>

    </body>
</html>