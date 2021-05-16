<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
        <script>
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
        </script>
    <body>
        <header>
        </header>

        <main>
            <section>
            <?php 
            include "./Vista/VistaMenu.php";
            echo $menu; ?>
            </section>
        </main>

        <footer>
        </footer>

    </body>
</html>