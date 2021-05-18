<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/assets/style/style.css">
    <title>Document</title>
</head>
<body>
    <script>

        function loguin(e) {
            document.querySelector(".main--section").style.visibility = "initial"
        }

    </script>
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

                        <td> <input type="submit" class="btn-ingresar" name="btn" value="Ingresar" /></td>
                        <td> <input type="submit" class="btn-cancelar" name="btn" value="Cancelar" /></td>

                    </tr>

                    <tr>
                        <td>
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
                        </td>
                    </tr>
                </table>
            </form>
        </section>


    </main>



</body>

</html>