<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requerimiento</title>
</head>
<?php
include "./Vista/VistaRequerimiento.php";
include "./Vista/VistaRegistroEmpleado.php";
$msj="";                                  
?>

<script>
     function Menu(){
            window.location.href="./Menu.php";
            }
</script>
<body>
    <header>

    </header>
    <main>
        <section>
            <!-- action="./Vista/VistaRequerimiento.php" -->
            <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <table>
                    <tr>
                        <td>Radicar Requerimiento</td>
                    </tr>
                    <tr>
                        <td>Empleado</td>
                        <td><label for="" >
                        <?php  
                           
                            $Nombre=$_SESSION['Session']['Nombre'];
                            echo $Nombre;
                        ?>
                        </label></td>
                    </tr>
                    <tr>
                        <td>Area</td>
                        <td>
                            <select id="" name="selectArea">
                                <?php CargarListarArea();?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Asunto Requerimiento</td>
                        <td>
                            <input type="text" name="titulo" id="" >
                        </td>
                    </tr>
                    <tr>
                        <td>REQUERIMIENTO</td>
                    </tr>
                    <tr>
                        <td><textarea name="message" rows="10" cols="30"></textarea></td>
                    </tr>
                </table>

                <table>
                <tr>
                    <td> <input type="submit" name="btn" value="Radicar"></td>
                    <td> <input type="button"  value="Menu" onclick="Menu();"></td>
                </tr>
                </table>
            </form>
        </section>

        <section>
        <?php echo $msj ;?>
        </section>
    </main>

    <footer>

    </footer>

</body>

</html>