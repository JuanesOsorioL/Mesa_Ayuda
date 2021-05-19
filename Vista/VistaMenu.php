<?php
    session_start();
    $menu="";
    
    $_SESSION['Select']="" ;  

    if (isset($_SESSION['Session'])) {
        switch ($_SESSION['Session']['Cargo']) {
            case '1':
                $menu='
                <nav class="section--subnav">
                <ul class="subnav--ul">
                    <li><a href="">Administrar usuarios</a></li>
                    <li><a href="./GestionArea.php">Gestión de áreas</a></li>
                    <li><a href="./ConsultarEmpleado.php">Empleados</a></li>
                    <li><a href="">Cargos</a></li>
                    <li><a href="./Consultas.php">Consultas</a></li>
                    <li><a href="">Informes</a></li>
                </ul>
            </nav> 
                
                ';

           /*  $menu=' 
                <table>
                    <tr>
                        <td><input type="button" value="Administrar usuarios"></td>
                        <td><input type="button" value="Gestión de áreas" onclick="GestionArea();"></td>
                        <td><input type="button" value="Empleados" onclick="consultarEmpleado();"></td> 
                        <td><input type="button" value="Cargos"></td>
                        <td><input type="button" value="Consultas" onclick="Consulta();"></td>
                        <td><input type="button" value="Informes"></td>
                        <td><input type="button" value="Cerrar seccion" onclick="Cerrarseccion();"></td>
                        <td><img src="./'.$_SESSION['Session']['Foto'].'" alt="" width="100px" height="100px"></td>
                    </tr>
                </table>'; */
            
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
                    <ul class="subnav--ul">
                        <li><a href="./Consultas.php">Consultas</a></li>
                        <li><a href="">Informes</a></li>
                        <li><a href="./MisRequerimientos.php">Mis Requerimientos</a></li>
                        <li><a href="./Requerimiento.php">Requerimiento</a></li>
                
                    </ul>
                </nav>';



/*                    $menu=' 
                    <table>
                        <tr>
                            <td><input type="button" value="Consultas" onclick="Consulta();"></td>
                            <td><input type="button" value="Informes"></td>
                            <td><input type="button" value="Mis Requerimientos" onclick="MisRequerimientos();"></td>
                            <td><input type="button" value="Requerimiento" onclick="Requerimiento();"></td>
                            <td><input type="button" value="Cerrar seccion" onclick="Cerrarseccion();"></td>
                            <td><img src="./'.$_SESSION['Session']['Foto'].'" alt="" width="100px" height="100px"></td>
                        </tr>
                    </table>';  */
                } else {

                    $menu='
                    <nav class="section--subnav">
    <ul class="subnav--ul">
        <li><a href="./MisRequerimientos.php">Mis Requerimientos</a></li>
        <li><a href="./Requerimiento.php">Requerimiento</a></li>

    </ul>
</nav>
                    ';


                   /*  $menu='
                        <table>
                            <tr>
                                <td><input type="button" value="Requerimiento" onclick="Requerimiento();"></td>
                                <td><input type="button" value="Mis Requerimientos" onclick="MisRequerimientos();"></td>
                                <td><input type="button" value="Cerrar seccion" onclick="Cerrarseccion();"></td>
                                <td><img src="./'.$_SESSION['Session']['Foto'].'" alt="" width="100px" height="100px"></td>
                            </tr>
                        </table>'; */
                }
            break;
        }
    } else {
       
    }   

?>