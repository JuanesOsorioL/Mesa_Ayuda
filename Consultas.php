<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    


    <title>Requerimiento</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<?php

include "./Vista/VistaConsulta.php";                                 
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
            <form >
                <table>
                    <tr>
                        <td>Consultar Requerimientos</td>
                        <td><?php
                        $selectArea="";
                        if (isset($_SESSION['Areas'])) {

                            $option="";
                            foreach ($_SESSION['Areas'] as $key => $value) {
                                $option=$option.'<option value="'.$value['IDAREA'].'">'.$value['NOMBRE'].'</option>';
                            }
                            echo $selectArea='<select name="SelectArea" id="SelectArea">'.$option.'</select>';
                        }
                        
                        ?></td>
                        <td> <button type="button" id="buscar">Buscar</button></td>
                        
                    </tr>
                </table>
                <div id="RequerimientoSinAsignar"></div>
                <div id="Observaciones"></div>
                <div id="MSJ"></div>
                <table>
                    <td> <input type="button"  value="Menu" onclick="Menu();"></td> 
                </table>
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




<script>

    ////////////////
    var btn="";
        $('#buscar').click(function () {

            if (document.getElementById("Observaciones")!==null) {
            document.getElementById("Observaciones").innerHTML="";
            }
            if (document.getElementById("MSJ")!==null) {
            document.getElementById("MSJ").innerHTML="";
            }

            btn="Buscar";
            var selectarea=document.getElementById("SelectArea").value;
            var ruta="Accion="+btn+"&SelectArea="+selectarea;
          
            $.ajax({
                url:'./Vista/VistaConsulta.php',
                type:'POST',
                data: ruta,
            }).done(function(res) {
    
               $('#RequerimientoSinAsignar').html(res);
                /////segundo
                
              //  document.getElementById("SelectReque")


               if (document.getElementById("SelectReque")!==null) {



                    $('#Seleccionar').click(function () {

                        if (document.getElementById("MSJ")!==null) {
                            document.getElementById("MSJ").innerHTML="";
                        }

                        btn="Seleccionar";
                        var selectarea=document.getElementById("SelectArea").value;
                        var selectreque=document.getElementById("SelectReque").value;
                        var ruta="Accion="+btn+"&SelectArea="+selectarea+"&SelectReque="+selectreque;

                        $.ajax({
                            url:'./Vista/VistaConsulta.php',
                            type:'POST',
                            data: ruta,
                        }).done(function(respu) {
                            $('#Observaciones').html(respu);
                            
                            ////tercero
                            if (document.getElementById("message")!==null) {

                            //////evento del radio
                            document.getElementById("cancelar").addEventListener("click",()=>{
                                document.getElementById("SelectEmpleado").disabled = true;
                                document.getElementById("SelectEmpleado").selectedIndex="0";
                            });

                            document.getElementById("asignar").addEventListener("click",()=>{
                                document.getElementById("SelectEmpleado").disabled = false;
                            })

                            /////
                             
                                $('#Guardar').click(function () {
                                    

                                    btn="Guardar";
                                    var control=false;
                                    var message= $('#message').val();
                                    var SelectEmpleado=document.getElementById("SelectEmpleado").value;
                                    var SelectReque=document.getElementById("SelectReque").value;

                                    if (message=="") {
                                        
                                        $('#MSJ').html("<h4> porfavor ingrese un comentario</h4>");
                                    } else {

                                        if (document.getElementById("asignar").checked) {

                                            if (SelectEmpleado==="0") {
                                                $('#MSJ').html("<h4> porfavor seleccione a quien asignar</h4>");
                                            }else{
                                                control=true;
                                            }
                                        } else {
                                            control=true;
                                        }
                                    }


                                        if (control) {
                                            var ruta="Accion="+btn+"&SelectReque="+SelectReque+"&SelectEmpleado="+SelectEmpleado+"&message="+message;
                                   
                                            $.ajax({
                                                url:'./Vista/VistaConsulta.php',
                                                type:'POST',
                                                data: ruta,
                                            }).done(function(respu) {
                                                $('#MSJ').html(respu);
                                                
                                            })
                                            .fail(function() {
                                                console.log("error");
                                            })
                                            .always(function() {
                                                console.log("complete");
                                            })
                                        }
                                })
                            }
                        })
                        ////tercero
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            console.log("complete");
                        })
                    })
                }  
                /////segundo */
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            })
        })
        ////////////
     
</script>
</body>

</html>