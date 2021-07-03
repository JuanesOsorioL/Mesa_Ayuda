<?php
  session_start();

  $menu="";

if (isset($_POST['Action'])) {

  if ($_POST['Action']==="Borrar"){
    session_destroy();
  }


  if (isset($_POST['Inicio'])){
    if (isset($_SESSION['Session'])) {
    $image='
      <img class="header--img" src="./assets/'.$_SESSION['Session']['Foto'].'" alt="'.$_SESSION['Session']['Nombre'].'" />
        <div class="header--ventanaLoguin">
          <label " onclick="Logoutinicio()">Logout</label>
        </div>';
      
    }else{
      $image='
        <img class="header--img" src="./assets/img/loguin.jpg" alt="default" />
          <div class="header--ventanaLoguin">
            <a href="./assets/html/RegistrarEmpleado.php">Registrar</a>
            <a href="./assets/html/loguin.php">Loguin</a>
          </div>';
    }
  }else{
    if (isset($_SESSION['Session'])) {
      $image='
      <img class="header--img" src="../'.$_SESSION['Session']['Foto'].'" alt="'.$_SESSION['Session']['Nombre'].'" />
        <div class="header--ventanaLoguin">
          <label " onclick="Logout()">Logout</label>
        </div>';
    }else{
      $image='
        <img class="header--img" src="../img/loguin.jpg" alt="default" />
          <div class="header--ventanaLoguin">
            <a href="../html/RegistrarEmpleado.php">Registrar</a>
            <a href="../html/loguin.php">Loguin</a>
          </div>';
    }
  }
echo $image;



}

  if (isset($_SESSION['Session'])) {

    switch ($_SESSION['Session']['Cargo']) {

        case '1':
          $opt='
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

/*           include "../script/model/Area.php";
          include "../script/controller/ControlArea.php";
          include "../script/controller/ControlConexion.php";
          $cedula=$_SESSION['Session']['Cedula'];
          $objArea=new Area("","",$cedula);
          $objControlArea=new ControlArea($objArea);
          $respuesta=$objControlArea-> ConsultarCedulaEnArea(); */
          

         // print_r($respuesta->fetch_all(MYSQLI_ASSOC));
         //print_r($_SESSION['Areas']);



          // if ($respuesta->num_rows!==0) {
         //   $_SESSION['Areas'] = $respuesta->fetch_all(MYSQLI_ASSOC);
          if ($_SESSION['Areas']){ 
            $opt='
              <nav class="section--subnav">
                <ul class="subnav--ul" id="submenu">
                  <li class="ul--li" >
                    <a class="ul__li--a" id="Consultas" href="./Consultas.php">Consultas</a>
                  </li>

                  <li class="ul--li" >
                    <a class="ul__li--a" id="Informe" href="./Informes.php">Informes</a>
                  </li>

                  <li class="ul--li">
                    <a class="ul__li--a" id="MisRequerimientos"  href="./MisRequerimientos.php">Mis Requerimientos</a>
                  </li>
                  <li class="ul--li">
                    <a class="ul__li--a" id="Requerimiento" href="./Requerimiento.php">Requerimiento</a>
                  </li>
                  <li class="ul--li">
                    <a class="ul__li--a" id="Asignarcargo" href="./AsignarCargo.php">Asignar Cargo</a>
                  </li>
                </ul>
              </nav>';

          } else {
            $opt='
              <nav class="section--subnav">
                <ul class="subnav--ul" id="submenu">
                  <li class="ul--li" ><a class="ul__li--a" href="./MisRequerimientos.php">Mis Requerimientos</a></li>
                  <li class="ul--li" ><a class="ul__li--a" href="./Requerimiento.php">Requerimiento</a></li>
                </ul>
              </nav>';
          } 
        break;
      }

      $menu='
      <div class="contenedor">
        <div class="contenedor-icono">
          <i class="fas fa-ellipsis-v" onclick="submenu()"></i>
        </div>
        <div class="contenedor-submenu">
          <span class="nombre_usuario">
              '.$_SESSION['Session']['Nombre'].'
          </span>
        '.$opt.'
        </div>
        <div class="contenedor-margin"></div>
      </div>';
}else{
  $menu='';
}

?>