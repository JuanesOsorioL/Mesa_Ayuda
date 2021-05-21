<?php
    session_start();
    $menu="";
    
    $_SESSION['Select']="" ;  

    if (isset($_SESSION['Session'])) {
        switch ($_SESSION['Session']['Cargo']) {
            case '1':
                $menu='
                <nav class="section--subnav">
                <ul class="subnav--ul" id="submenu">
                    <li class="ul--li" ><a class="ul__li--a"  href="">Gestionar Usuarios</a></li>
                    <li class="ul--li" ><a class="ul__li--a" id="GestionArea" href="./GestionArea.php">Gestión de Áreas</a></li>
                    <li class="ul--li" ><a class="ul__li--a" id="GestionEmpleado" href="./ConsultarEmpleado.php">Empleados</a></li>
                    <li class="ul--li" ><a class="ul__li--a" href="">Cargos</a></li>
                    <li class="ul--li" ><a class="ul__li--a" href="./Consultas.php">Consultas</a></li>
                    <li class="ul--li" ><a class="ul__li--a" href="">Informes</a></li>
                </ul>
            </nav>';
            break;
        
            default:

                include "./Modelo/Area.php";
                include "./Control/ControlArea.php";
                include "./Control/ControlConexion.php";
                

                $cedula=$_SESSION['Session']['Cedula'];
            
                $objArea=new Area("","",$cedula);
                $objControlArea=new ControlArea($objArea);
                $respuesta=$objControlArea-> ConsultarCedulaEnArea();
                
                if ($respuesta->num_rows!==0) {
                    $_SESSION['Areas'] = $respuesta->fetch_all(MYSQLI_ASSOC);
                    //print_r($Array); 
                    
                    $menu='<nav class="section--subnav">
                    <ul class="subnav--ul" id="submenu">
                        <li class="ul--li" ><a class="ul__li--a" href="./Consultas.php">Consultas</a></li>
                        <li class="ul--li" ><a class="ul__li--a" href="">Informes</a></li>
                        <li class="ul--li" ><a class="ul__li--a" href="./MisRequerimientos.php">Mis Requerimientos</a></li>
                        <li class="ul--li" ><a class="ul__li--a" href="./Requerimiento.php">Requerimiento</a></li>
                
                    </ul>
                </nav>';

                } else {

                    $menu='
                    <nav class="section--subnav">
                        <ul class="subnav--ul" id="submenu">
                            <li class="ul--li" ><a class="ul__li--a" href="./MisRequerimientos.php">Mis Requerimientos</a></li>
                            <li class="ul--li" ><a class="ul__li--a" href="./Requerimiento.php">Requerimiento</a></li>

                        </ul>
                    </nav>
                    ';

                }
            break;
        }
    } else {
       
    }   

?>