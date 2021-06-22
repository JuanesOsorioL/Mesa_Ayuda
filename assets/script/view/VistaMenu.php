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
                    <li class="ul--li" ><a class="ul__li--a" id="GestionUsuario" href="./GestionUsuarios.php">Gestionar Usuarios</a></li>
                    <li class="ul--li" ><a class="ul__li--a" id="GestionArea" href="./GestionArea.php">Gestión de Áreas</a></li>
                    <li class="ul--li" ><a class="ul__li--a" id="GestionEmpleado" href="./ConsultarEmpleado.php">Empleados</a></li>
                    
                    <li class="ul--li" ><a class="ul__li--a" id="GestionCargos" href="./GestionCargos.php">Cargos</a></li>

                    <li class="ul--li" ><a class="ul__li--a" id="Alertas" href="./Alertas.php">Alertas</a></li>
                </ul>
            </nav>';
            break;
        
            default:

                include "../script/model/Area.php";
                include "../script/controller/ControlArea.php";
                include "../script/controller/ControlConexion.php";
                

                $cedula=$_SESSION['Session']['Cedula'];
            
                $objArea=new Area("","",$cedula);
                $objControlArea=new ControlArea($objArea);
                $respuesta=$objControlArea-> ConsultarCedulaEnArea();
                
                if ($respuesta->num_rows!==0) {
                    $_SESSION['Areas'] = $respuesta->fetch_all(MYSQLI_ASSOC);
                    
                    $menu='
                    <nav class="section--subnav">
                      <ul class="subnav--ul" id="submenu">
                        <li class="ul--li" >
                          <a class="ul__li--a" id="Consultas" href="./Consultas.php">Consultas
                          </a>
                        </li>

                        <li class="ul--li" >
                          <a class="ul__li--a" id="Informe" href="./Informes.php">Informes
                          </a>
                        </li>
                        <li class="ul--li">
                          <a class="ul__li--a" id="MisRequerimientos"  href="./MisRequerimientos.php">Mis Requerimientos
                          </a>
                        </li>
                        <li class="ul--li">
                          <a class="ul__li--a" id="Requerimiento" href="./Requerimiento.php">Requerimiento
                          </a>
                        </li>
                          <li class="ul--li">
                          <a class="ul__li--a" id="Asignarcargo" href="./AsignarCargo.php">Asignar Cargo
                          </a>
                        </li>
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