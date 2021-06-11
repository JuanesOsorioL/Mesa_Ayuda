<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <header>
    </header>

    <main>
        <section>
            </table>
            <div id="RequerimientoSinAsignar"></div>
            <div id="Observaciones"></div>
            <div id="MSJ"></div>
                <tr>
                    <td> <input type="button"  value="Menu" onclick="Menu();"></td> 
                </tr>
            <table>
        </section>
    </main>

    <footer>
    </footer>

    <script>
          function Menu(){
        window.location.href="./Menu.php";
    }
        var btn = "";
        $(document).ready(main);

        function main() {
            btn = "Cargar";
            var ruta = "Accion=" + btn;
            $.ajax({
                url: './Vista/VistaMisRequerimientos.php',
                type: 'POST',
                data: ruta,
            }).done(function (respu) {
                $('#RequerimientoSinAsignar').html(respu);
                seleccionar();
            }).fail(function () {
                console.log("error");
            })
                .always(function () {
                    console.log("complete");
                })
        };

        function seleccionar() {

            if (document.getElementById("SelectReque") !== null) {

                $('#Seleccionar').click(function () {

                    if (document.getElementById("MSJ") !== null) {
                        document.getElementById("MSJ").innerHTML = "";
                    }

                    btn = "Seleccionar";
                    var selectreque = document.getElementById("SelectReque").value;
                    var ruta = "Accion=" + btn + "&SelectReque=" + selectreque;

                    $.ajax({
                        url: './Vista/VistaMisRequerimientos.php',
                        type: 'POST',
                        data: ruta,
                    }).done(function (respu) {
                        $('#Observaciones').html(respu);
                        guardar();
                    }).fail(function () {
                        console.log("error");
                    })
                        .always(function () {
                            console.log("complete");
                        })
                })
            }
        }

        function guardar() {

            if (document.getElementById("message") !== null) {

                $('#Guardar').click(function () {

                    controlradio = "";
                    btn = "Guardar";
                    var message = $('#message').val();
                    var SelectReque = document.getElementById("SelectReque").value;

                    if (message == "") {
                        $('#MSJ').html("<h4> porfavor ingrese un comentario</h4>");
                    } else {

                        if (document.getElementsByName("option")[0].checked == true) {
                            controlradio = "true";
                        } else {
                            controlradio = "false";
                        }

                        var ruta = "Accion=" + btn + "&SelectReque=" + SelectReque + "&message=" + message + "&Stotal=" + controlradio;

                        $.ajax({
                            url: './Vista/VistaMisRequerimientos.php',
                            type: 'POST',
                            data: ruta,
                        }).done(function (respu) {
                            $('#MSJ').html(respu);
                        }).fail(function () {
                            console.log("error");
                        }).always(function () {
                            console.log("complete");
                        })
                    }
                })
            }
        }

    </script>
</body>

</html>