<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Style -->
    <!-- <link rel="stylesheet" href="./assets/style/style.css"> -->
    <link rel="stylesheet" href="./style/style.css">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    

    <title>Loguin</title>
</head>
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

        <section class="main--section">

            <form class="main__section--form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>"
                method="POST">

                <table class="form--table">
                    <tr class="form__table--tr">
                        <td class="col-sm-2 col-form-label">Usuario: </td>
                        <td class="col-sm-10"><input type="text" class="form-user" name="txtUsuario" value="" /></td>
                    </tr>
                    <tr class="form__table--tr">
                        <td class="col-sm-2 col-form-label">Password: </td>
                        <td class="col-sm-10"><input type="password" class="form-pass" name="txtPassword"
                                autocomplete="on" /></td>
                    </tr>
                    <tr class="form__table--btn">
                    <td></td>
                        <td colspan="2"> <input type="submit" class="btn-ingresar" name="btn" value="Ingresar" />
                        <input type="submit" class="btn-cancelar" name="btn" value="Cancelar" /></td>

                    </tr>
                </table>
                <div>
                <?php
                
                 if (isset($_POST['btn'])) {

                    include_once "./Vista/VistaIngresar.php";
                    $bot=$_POST["btn"];
                    $usu=$_POST["txtUsuario"];
                    $con=$_POST["txtPassword"];

                    switch ($bot) {
                        case 'Ingresar':
                            ValidarUsuario($usu,$con);   
                        break;

                       case 'Cancelar':
                        header("Location: ./index.php");
                        break; 
                        
                        default:
                            # code...
                            break;
                    }
                 }
            ?>

                </div>
            </form>
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

</html>