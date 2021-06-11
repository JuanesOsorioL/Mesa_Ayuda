<?php

if (isset($_POST['Accion'])) {

  $bot=$_POST['Accion'];

  switch ($bot) {

    case 'Consultar':
      include "../model/Empleado.php";
      include "../controller/ControlEmpleado.php";
      include "../controller/ControlConexion.php";
      include "../model/Area.php";
      include "../controller/ControlArea.php";

      $Cedula=$_POST["txtIDEmpleado"];
      $objEmpleado=new Empleado($Cedula, "", "", "", "", "", "", "", "", "","","","","","");
      $objControlEmpleado=new ControlEmpleado($objEmpleado);
      $objEmpleado=$objControlEmpleado->EmployeeForCC();

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
        $resultado=$objControlArea->AllArea();
        $opciones = '<option value="0">Seleccione</option>;';

        while($row = $resultado->fetch_assoc()) { 
          if (strval($row['IDAREA'])===strval($Area)) {
            $opciones .= strval('<option value="'.$row['IDAREA'].'" selected > '.$row['NOMBRE'].'</option>;');
          } else {
            $opciones .= strval('<option value="'.$row['IDAREA'].'"> '.$row['NOMBRE'].'</option>;');
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
            <td><input class="input--texto" type="text" name="txtNombre" value="'.$Nombre.'"></td>
          </tr>

          <tr>
            <td class="td--titulosecundario">Foto: </td>
            <td></td>
          </tr>

          <tr>
            <td> 
              <input type="button" class="btn-cambiar-foto" name="btn" value="Cambiar" onclick="subirFoto()" />
            </td>

            <td>
              <img class="header--img" id="Foto" src="../'.$Foto.'" alt="'.$Nombre.'" />

              <input name="CFoto" class="form--input-foto" type="file" onChange="file_foto(event)">

              <input class="form--input-foto" type="text" name="urlFoto" value="'.$Foto.'"/>
            </td>
          </tr>

          <tr>
            <td class="td--titulosecundario">HojaVida:</td>
            <td></td>
          </tr>

          <tr>

            <td> 
              <input type="button" class="btn-cambiar-hoja" name="btn" value="Cambiar" onclick="subirCV()" />
            </td> 

            <td> 
              <input name="CV" class="form--input-cv" type="file" onChange="file_hoja(event)">

               <input class="form--input-cv" type="text" name="urlCV" value="'.$HojaVida.'"/>

               <iframe class="iframe-hoja" id="Hoja_vida" src="../'.$HojaVida.'" width="85px" height="110px"></iframe>
            </td>

          </tr>

          <tr>
            <td class="td--titulosecundario">Telefono: </td>
            <td><input class="input--texto" type="text" name="txtTelefono" value="'.$Telefono.'"></td>
          </tr>

          <tr>
            <td class="td--titulosecundario">Email: </td>
            <td><input class="input--texto" type="text" name="txtEmail" value="'.$Email.'"></td>
          </tr>

          <tr>
            <td class="td--titulosecundario">Direccion: </td>
            <td><input class="input--texto" type="text" name="txtDireccion" value="'.$Direccion.'"></td>
          </tr>

          <tr>
            <td class="td--titulosecundario" >X: </td>
            <td><input class="input--texto" type="text" name="txtX" value="'.$X.'"></td>
          </tr>

          <tr>
            <td class="td--titulosecundario" >Y: </td>
            <td><input class="input--texto" type="text" name="txtY" value="'.$Y.'"></td>
          </tr>

          <tr>
            <td class="td--titulosecundario" >Area: </td>
            <td>
              <select id="Area"  class="mirar input--texto" name="selectArea" disabled>
              '.$opciones.'
              </select>
            </td>
          </tr>

          <tr>
            <td  colspan="2">
              <input type="submit" class="input-btn" value="Modificar" name="Accion" id="Modificar">
            </td>
          </tr>
         
        </table>';
        echo $contenido;

      } else {
        print '<h1 class="mensaje-error"> No existe ò Esta Inhabilitado </h1>';
      } 
    break; 


    case 'Modificar':
    
      if (isset ($_FILES['CFoto'])) {
        move_uploaded_file($_FILES['CFoto']['tmp_name'],"../".$_POST['urlFoto']); 
      }

      if (isset ($_FILES['CV'])) {
        move_uploaded_file($_FILES['CV']['tmp_name'],"../".$_POST['urlCV']); 
      }

      $Cedula=$_POST['txtIDEmpleado'];
      $Nombre=$_POST['txtNombre'];
      $UrlFoto=$_POST['urlFoto'];
      $HojaVida=$_POST['urlCV'];
      $Telefono=$_POST['txtTelefono'];
      $Email=$_POST['txtEmail'];
      $Direccion=$_POST['txtDireccion'];
      $X=$_POST['txtX'];
      $Y=$_POST['txtY'];

      include "../script/model/Empleado.php";
      include "../script/controller/ControlEmpleado.php";
      include "../script/controller/ControlConexion.php";
      
      $objEmpleados=new Empleado($Cedula, $Nombre, $UrlFoto, $HojaVida, $Telefono, $Email, $Direccion, $X, $Y,"","","","","");
      $objControlEmpleado=new ControlEmpleado($objEmpleados);
      $Resultado=$objControlEmpleado->UpdateEmployeeForCC();

    break;

    default:
    break;
  }  
}
 
?>