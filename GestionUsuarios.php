<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 -->
    <link rel="stylesheet" href="./assets/style/Style.css">
    

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Gestionar Usuarios</title>
</head>
<?php   include "./Vista/VistaMenu.php"; ?>
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
                <a href="./RegistrarEmpleado.php">Registrar</a>
                <a href="./loguin.php">Loguin</a>

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

<section>
    holaaaa
</section>


    </main>



    <script src="./assets/script/utilidades.js"> </script>
</body>

</html>