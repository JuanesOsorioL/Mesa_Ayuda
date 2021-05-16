<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./src//assets//style/Style.css">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Pagina de Inicio</title>
</head>

<body>
    <header>
        <div class="header--logo">
            <a href="#" class="bt-menu"><img class="header__a--img" src="./img/Logo.png" alt="logo"></a>
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
                <a href="">Registrar</a>
                <a href="">Loguin</a>
            </div>

        </div>
    </header>



    <main>

        <section>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">

                <table>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Usuario: </td>
                        <td class="col-sm-10"><input type="text" name="txtUsuario" value=""></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Password: </td>
                        <td class="col-sm-10"><input type="text" name="txtPassword" value=""></td>
                    </tr>
                </table>

                <table class="form-group row">
                    <tr> <input type="submit" name="btn" value="Ingresar"></tr>
                    <tr><input type="submit" name="btn" value="Registrar"></tr>
                    </tr>
                </table>
            </form>
        </section>

        <section>
            <?php
                 if (isset($_POST['btn'])) {

                    include_once "./Vista/VistaIngresar.php";
                    $bot=$_POST["btn"];
                    $usu=$_POST["txtUsuario"];
                    $con=$_POST["txtPassword"];

                    switch ($bot) {
                        case 'Ingresar':
                            
/*                             if (ValidarUsuario($usu,$con)) {
                                header("Location: ./Requerimiento.php");
                            } else {
                              echo "<label>clave o usuario incorrecto</label>";
                            } */

                            ValidarUsuario($usu,$con);
                            
                        break;

                        case 'Registrar':
                                header("Location: ./RegistrarEmpleado.php");
                        break;
                        
                        default:
                            # code...
                            break;
                    }
                 }
            ?>
        </section>





    </main>
    <footer>

    </footer>
    <script>

        $(document).ready(main);

        var contador = 1;

        function main() {
            $('.menu_bar').click(function () {
                //$('nav').toggle(); 

                if (contador == 1) {
                    $('nav').animate({
                        left: '0'
                    });
                    contador = 0;
                } else {
                    contador = 1;
                    $('nav').animate({
                        left: '-100%'
                    });
                }

            });

        };
    </script>
</body>

</html>