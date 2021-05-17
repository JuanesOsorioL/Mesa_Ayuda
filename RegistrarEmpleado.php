<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./src/assets/style/style.css">
    <link rel="stylesheet" href="./src/assets/style/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>RegistrarEmpleado</title>
</head>

<body>

    <?php 
$Cedula="";
$Nombre="";
$Telefono="";
$Email="";
$Direccion="";
$X="";
$Y="";
$Area="0";
$Usuario="";
$Pass="";
$msj="";

include "./Vista/VistaRegistroEmpleado.php";

if (isset($_POST['btn'])) {

    $bot=$_POST['btn'];
    switch ($bot) {

        case "Regresar":
            header("Location: ./index.php");
        break;

        case 'Guardar':
            $Cedula=$_POST["txtIDEmpleado"];
            $Nombre=$_POST["txtNombre"];
            $Telefono=$_POST["txtTelefono"];
            $Email=$_POST["txtEmail"];
            $Direccion=$_POST["txtDireccion"];
            $X=$_POST["txtX"];
            $Y=$_POST["txtY"];
            $Area=$_POST["Area"];
            $Usuario=$_POST["txtUsuario"];
            $Pass=$_POST["txtContraseña"];

            
            $msj= guardar();
            if ( $msj==="Empleado Guardado Con Exito") {
                $Cedula="";
                $Nombre="";
                $Telefono="";
                $Email="";
                $Direccion="";
                $X="";
                $Y="";
                $Area="0";
                $Usuario="";
                $Pass="";
            }

        break;
    }
}
?>
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
        </div>
    </header>

    <main>
        <section>
            <form method="POST" enctype='multipart/form-data'
                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">

                <table>
                    <tr class="form-group row">
                        <td>Registro de Empleados</td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Cedula: </td>
                        <td><input type="text" id="IDEmple" name="txtIDEmpleado" value="<?php echo $Cedula;?>"></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Nombre: </td>
                        <td><input type="text" name="txtNombre" value="<?php echo $Nombre;?>"></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Foto: </td>
                        <td><input name='Imagen' type='file'></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">HojaVida: </td>
                        <td><input name='HojaVida' type='file'></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Telefono: </td>
                        <td><input type="text" name="txtTelefono" value="<?php echo $Telefono;?>"></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Email: </td>
                        <td><input type="text" name="txtEmail" value="<?php echo $Email;?>"></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Direccion: </td>
                        <td><input type="text" name="txtDireccion" value="<?php echo $Direccion;?>"></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">X: </td>
                        <td><input type="text" name="txtX" value="<?php echo $X;?>"></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Y: </td>
                        <td><input type="text" name="txtY" value="<?php echo $Y;?>"></td>
                    </tr>

                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Area: </td>
                        <td>
                            <select id="Area" name="Area" class="mirar">
                                <option value="0">Seleccione</option>
                                <?php CargarListarArea(); ?>
                            </select>
                        </td>
                    </tr>

                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Usuario: </td>
                        <td><input type="text" name="txtUsuario" value="<?php echo $Usuario;?>"></td>
                    </tr>
                    <tr class="form-group row">
                        <td class="col-sm-2 col-form-label">Contraseña: </td>
                        <td><input type="text" name="txtContraseña" value="<?php echo $Pass;?>"></td>
                    </tr>
                </table>
                <table>
                    <tr class="form-group row">
                        <td><input type="submit" name="btn" value="Guardar" /></td>
                        <td><input type="submit" name="btn" value="Regresar" /></td>
                    </tr>
                </table>
            </form>
        </section>

        <section>
            <?php echo $msj;?>
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