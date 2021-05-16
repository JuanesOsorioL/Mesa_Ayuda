<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegistrarEmpleado</title>
</head>
<body>

    <header>

    </header>
    <main>
        <section>
            <form  method="POST" >
                <table>
                    <tr>
                        <td>Consultar Empleados</td>
                    </tr>
                    <tr>
                        <td>Cedula: </td>
                        <td><input type="text" id="IDEmple" name="txtIDEmpleado" value=""></td>

                    </tr>
                </table>

                <table>
                    <tr>
                        <td><input type="submit" name="btn"  value="Consultar" /></td>
                    </tr>
                </table>
            </form>
         
        </section>

        <section>
            <?php include "./Vista/VistaC_M_D_Empleado.php";?>

                <div id="RequerimientoSinAsignar"></div>
                <div id="Observaciones"></div>
                <div id="MSJ"></div> 
        </section>
    </main>
    <footer>
       

    </footer>
   <script>
    var btn="";

    function nombre() {
    console.log("entro");
}


       $('#Modificar').click(function () {
/* 
            if (document.getElementById("Observaciones")!==null) {
            document.getElementById("Observaciones").innerHTML="";
            }
            if (document.getElementById("MSJ")!==null) {
            document.getElementById("MSJ").innerHTML="";
            } */

            btn="Modificar";
            //var selectarea=document.getElementById("SelectArea").value;
           // var ruta="Accion="+btn+"&SelectArea="+selectarea;
           var ruta="Accion="+btn;
            $.ajax({
                url:'./Vista/VistaC_M_D_Empleado.php',
                type:'POST',
                data: ruta,
            }).done(function(res) {
                $('#RequerimientoSinAsignar').html(res);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            })
        }) 

   </script>
</body>

</html>