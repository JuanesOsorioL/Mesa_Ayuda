


<?php
     
/* 
  $Cedula="";
  $Nombre="";
  $Telefono="";
  $Email="";
  $Direccion="";
  $X="";
  $Y="";
  $Area="0";
  $Usuario="";
  $Pass="";
  $msj="";

if (isset($_POST['btn'])) {

   function validacion(){
    $input=["txtIDEmpleado","txtNombre","txtTelefono","txtEmail","txtDireccion","txtX","txtY","Area","txtUsuario","txtContraseña"];
    $control=true;
  
    if ($_FILES['Imagen']['size']===0) {
     $control=false;
    }else{
     if ($_FILES['HojaVida']['size']===0) {
        $control=false;
      }
      else{
          for ($i=0; $i <=9 ; $i++) { 
          if (empty($_POST[$input[$i]])) {
            $i=9;
             $control=false;
          }
        }  
      } 
    }
    return $control;
  } 


 ///////  function validacion(){
    $control=false;
    if (empty($_POST["txtIDEmpleado"])) {
     // print_r("Por favor Ingresa la Cedula del Empleado");
      $msj="Por favor Ingresa la Cedula del Empleado";
    } else {
      if (empty($_POST["txtNombre"])) {
        $msj="Por favor Ingresa el Nombre del Empleado";
      } else {
        if ($_FILES['Imagen']['size']===0) {
          $msj="Por favor Ingresa el Archivo de Foto del Empleado";
         }else{
        }
      }
    }
    return $control;
  } /////
 */


if (isset($_POST['Accion'])) {

  $bot=$_POST['Accion'];
  switch ($bot) {

    case 'Consultar':

        include_once "../Modelo/Empleado.php";
        include_once "../Control/ControlEmpleado.php";
        include_once "../Control/ControlConexion.php";
        include_once "../Control/ControlArea.php";
        include_once "../Modelo/Area.php";
          
        $Cedula=$_POST["txtIDEmpleado"];
        $objEmpleado=new Empleado($Cedula, "", "", "", "", "", "", "", "", "","","","","","");
        $objControlEmpleado=new ControlEmpleado($objEmpleado);
        $objEmpleado=$objControlEmpleado->consultar();


     
        if ( $objEmpleado!==null) {
 
            $Nombre=$objEmpleado->getNombre();
            $Foto=$objEmpleado->getFoto();
            $HojaVida=$objEmpleado->getHojaVida();
            $Telefono=$objEmpleado->getTelefono();
            $Email=$objEmpleado->getEmail();
            $Direccion=$objEmpleado->getDireccion();
            $X=$objEmpleado->getX();
            $Y=$objEmpleado->getY();
            $Area=$objEmpleado->getFKArea();

            $objArea=new Area("","","");
            $objControlArea=new ControlArea($objArea);
            $resultado=$objControlArea->consultarTodasAreas();

            $opciones = '<option value="0">Seleccione</option>;';

            while($row = $resultado->fetch_assoc()) { 
                if (strval($row['IDAREA'])===strval($Area)) {
                    $opciones .= strval('<option value = '.$row['IDAREA'].' selected > '.$row['NOMBRE'].'</option>;');
                } else {
                    $opciones .= strval('<option value = '.$row['IDAREA'].'> '.$row['NOMBRE'].'</option>;');
                }
            } 

            $contenido='
            
                <table>
                <tr>
                    <td  colspan="2" class="td--tituloprincipal" >Datos</td>
                </tr>
                <tr>
                    <td class="td--titulosecundario" >Cedula: </td>
                    <td  class="td--cedula"> <span>'.$Cedula.'</span></td>
                </tr>
                <tr>
                    <td class="td--titulosecundario">Nombre: </td>
                    <td><input class="input--texto" type="text" name="txtNombre" value='.$Nombre.'></td>
                </tr>
                <tr>
                    <td class="td--titulosecundario">Foto: </td>
                    <td><input class="input--texto" type="text" name="txtFoto" value='.$Foto.'></td>
                </tr>
                <tr>
                    <td class="td--titulosecundario">HojaVida: </td>
                    <td><input class="input--texto" type="text" name="txtHojaVida" value='.$HojaVida.'></td>
                </tr>
                <tr>
                    <td class="td--titulosecundario">Telefono: </td>
                    <td><input class="input--texto" type="text" name="txtTelefono" value='.$Telefono.'></td>
                </tr>
                <tr>
                    <td class="td--titulosecundario">Email: </td>
                    <td><input class="input--texto" type="text" name="txtEmail" value='.$Email.'></td>
                </tr>
                <tr>
                    <td class="td--titulosecundario">Direccion: </td>
                    <td><input class="input--texto" type="text" name="txtDireccion" value='.$Direccion.'></td>
                </tr>
                <tr>
                    <td class="td--titulosecundario" >X: </td>
                    <td><input class="input--texto" type="text" name="txtX" value='.$X.'></td>
                </tr>
                <tr>
                    <td class="td--titulosecundario" >Y: </td>
                    <td><input class="input--texto" type="text" name="txtY" value='.$Y.'></td>
                </tr>
                <tr>
                    <td class="td--titulosecundario" >Area: </td>
                <td>
                    <select id="Area" class="mirar input--texto">
                    '.$opciones.'
                    </select>
                </td>
                </tr>
                <tr>
                    <td  colspan="2"> <button class="input-btn" type="button" id="Modificar" onclick="nombre()">Modificar</button> </td>
                </tr>
                </table>';

            echo $contenido;

        } else {
            print '<h1 class="mensaje-error"> No existe </h1>';
        } 
    break; 


    case 'Modificar':
        echo "<h1> modificado </h1>";
    break;




/*     
    case 'Regresar':
      header("Location: ./index.html");
    break;

    case 'Guardar':
      if (validacion()) {
        include_once "./Modelo/Empleado.php";
        include_once "./Control/ControlEmpleado.php";
        include_once "./Modelo/Usuario.php";
        include_once "./Control/ControlUsuario.php";
        include_once "./Control/ControlConexion.php";

        $Cedula=$_POST["txtIDEmpleado"];
        $Nombre=$_POST["txtNombre"];
        $Telefono=$_POST["txtTelefono"];
        $Email=$_POST["txtEmail"];
        $Direccion=$_POST["txtDireccion"];
        $X=$_POST["txtX"];
        $Y=$_POST["txtY"];
        $Area=$_POST["Area"];
        $RutaImg="";
        $RutaHoja="";
        $Usuario=$_POST["txtUsuario"];
        $Contrasena=$_POST["txtContraseña"];

        try {

          $objEmpleado=new Empleado($Cedula, "", "", "", "", "", "", "", "", "","");
          $objControlEmpleado=new ControlEmpleado($objEmpleado);
          $resValidacionEmple=$objControlEmpleado->ValidarEmpleado();

          if ($resValidacionEmple) {
            $msj="Ya existe la cedula: ".$Cedula;
          }else{

            $objUsuario=new Usuario($Usuario, "", "");
            $objControlUsuario=new ControlUsuario($objUsuario);
            $resValidarUsu=$objControlUsuario->ValidarUsuario(); 

            if ($resValidarUsu) {
              $msj="Ya existe el Usuario";
            }else{

              if (isset ($_FILES['Imagen'])) {
                $RutaImg = "uploads/".strval($Cedula).$_FILES['Imagen']['name'];
                move_uploaded_file($_FILES['Imagen']['tmp_name'], $RutaImg); 
              }
      
              if (isset ($_FILES['HojaVida'])) {
                $RutaHoja = "uploads/".strval($Cedula).$_FILES['HojaVida']['name'];
                move_uploaded_file($_FILES['HojaVida']['tmp_name'], $RutaHoja); 
              } 

              $objEmpleado=new Empleado($Cedula, $Nombre, $RutaImg, $RutaHoja, $Telefono, $Email, $Direccion, $X, $Y, $Area,"");
              $objControlEmpleado=new ControlEmpleado($objEmpleado);
              $resGuardarEmple=$objControlEmpleado->GuardarEmpleado();

              if ($resGuardarEmple) {

                $objUsuario=new Usuario($Usuario, $Contrasena, $Cedula);
                $objControlUsuario=new ControlUsuario($objUsuario);
                $resGuardarUsua=$objControlUsuario->GuardarUsuario();

                if ($resGuardarUsua) {
                  $msj="Empleado Guardado Con Exito";
                } else {
                    $msj="No se guardo Usuario y Contraseña Informar al administrador";
                } 
              } else {
              $msj="No se registro la Cedula: ".$Cedula;
              }  
            }
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }  
      } else {
        $msj="Faltan datos por registrar";
      } 
    break;

 */




    default:
    break;
  }  
}
 
?>