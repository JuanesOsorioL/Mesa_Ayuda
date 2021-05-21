<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

       
    <title>Consultar Empleado</title>
</head>

<?php 
    include "./Vista/VistaMenu.php";
    include "./Vista/VistaC_M_D_Empleado.php";
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
            <img class="header--img" src="<?php echo $_SESSION['Session']['Foto'];?>" alt="" />

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
                        <?php echo $_SESSION['Session']['Nombre'];?>
                    </span>
                    <?php echo $menu; ?>
                </div>
                <div class="contenedor-margin"></div>
            </div>
        </section>



        <section class="main--consultaempleado">
            <form class="consultaempleado--form" method="POST">
                <table>
                    <tr>
                        <td colspan="2" class="td--tituloprincipal">Consultar Empleados</td>
                    </tr>
                    <tr>
                        <td class="td--titulosecundario">Cedula: </td>
                        <td><input  class="input--texto" type="text" id="IDEmple" name="txtIDEmpleado" value=""></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="button" name="btn" id="consultar" value="Consultar" onclick="consulta()" class="input-btn" /></td>
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


    </footer>

    <script>
        var btn = "";

        function nombre() {
            console.log("entro");
        }


//////////////////////

function consulta() {

            btn = "Consultar";
            var cedula=document.getElementById("IDEmple").value;
          
            var ruta = "Accion=" +btn+"&txtIDEmpleado="+cedula;
            $.ajax({
                url: './Vista/VistaC_M_D_Empleado.php',
                type: 'POST',
                data: ruta
            }).done(function (res) {
                $('#resultadoconsulta').html(res);
            })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                }) 
        }









////////////////////////

        $('#Modificar').click(function () {
            /* 
                        if (document.getElementById("Observaciones")!==null) {
                        document.getElementById("Observaciones").innerHTML="";
                        }
                        if (document.getElementById("MSJ")!==null) {
                        document.getElementById("MSJ").innerHTML="";
                        } */

            btn = "Modificar";
            //var selectarea=document.getElementById("SelectArea").value;
            // var ruta="Accion="+btn+"&SelectArea="+selectarea;
            var ruta = "Accion=" + btn;
            $.ajax({
                url: './Vista/VistaC_M_D_Empleado.php',
                type: 'POST',
                data: ruta,
            }).done(function (res) {
                $('#RequerimientoSinAsignar').html(res);
            })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                })
        })

    </script>
</body>
<script src="./assets/script/utilidades.js"></script>
</html>