<?php

function validacion(){
  
  if (empty($_POST["txtIDEmpleado"])) {
    return $control= "Por favor Ingresa la Cedula del Empleado";
  } else {
    if (empty($_POST["txtNombre"])) {
      return $control= "Por favor Ingresa el Nombre del Empleado";
    } else {
      if ($_FILES['Imagen']['size']===0) {
        return $control= "Por favor Ingresa el Archivo de Foto del Empleado";
      }else{
        if ($_FILES['HojaVida']['size']===0) {
          return $control= "Por favor Ingresa el Archivo de Hoja de Vida del Empleado";
        }else{
          if (empty($_POST["txtTelefono"])) {
            return $control= "Por favor Ingresa el Telefono del Empleado";
          }else{
            if (empty($_POST["txtEmail"])) {
              return $control= "Por favor Ingresa el Email del Empleado";
            }else{
              if (empty($_POST["txtDireccion"])) {
                return $control= "Por favor Ingresa el Direccion del Empleado";
              }else{
                if (empty($_POST["txtX"])) {
                  return $control= "Por favor Ingresa la Cordenada X del Empleado";
                }else{
                  if (empty($_POST["txtY"])) {
                    return $control= "Por favor Ingresa la Cordenada Y del Empleado";
                  }else{
                    if (empty($_POST["Area"])) {
                      return $control= "Por favor Seleccione la Area del Empleado";
                    }else{
                      if (empty($_POST["txtUsuario"])) {
                        return $control= "Por favor Ingresa el Usuario del Empleado";
                      }else{
                        if (empty($_POST["txtContraseña"])) {
                          return $control= "Por favor Ingresa la Contraseña del Empleado";
                        }else{
                          return $control="true";
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  return $control; 
  }
}

function guardar(){
  if (validacion()==="true") {

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
    $Pass=$_POST["txtContraseña"];

    try {

      $objEmpleado=new Empleado($Cedula, "", "", "", "", "", "", "", "", "","", "", "","");
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

          $FKCARGO =2;
          $FECHAINI=(new DateTime('now'))->format("Y-m-d h:i:s");

          $objEmpleado=new Empleado($Cedula, $Nombre, $RutaImg, $RutaHoja, $Telefono, $Email, $Direccion, $X, $Y, $Area, "", $FKCARGO,  $FECHAINI,"");
          $objControlEmpleado=new ControlEmpleado($objEmpleado);
          $resGuardarEmple=$objControlEmpleado->GuardarEmpleado();

          if ($resGuardarEmple) {

            $objUsuario=new Usuario($Usuario, $Pass, $Cedula);
            $objControlUsuario=new ControlUsuario($objUsuario);
            $resGuardarUsua=$objControlUsuario->GuardarUsuario();

             if ($resGuardarUsua) {

              $msj="Empleado Guardado Con Exito";
             // return $msj;
            } else {
                $msj="No se guardo Usuario y Contraseña Informar al administrador";
               // return $msj;
            } 
          } else {
            $msj="No se registro la Cedula: ".$Cedula;
            //return $msj;
          }     
        }
      }
     return $msj;
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }  
  }else {
   return validacion();
  } 
}

function CargarListarArea(){
  include_once "./Control/ControlConexion.php";
  include_once "./Control/ControlArea.php";
  include_once "./Modelo/Area.php";

  $objArea=new Area("","","");
  $objControlArea=new ControlArea($objArea);
  $resultado=$objControlArea->consultarTodasAreas();

  while($row = $resultado->fetch_assoc()) { 
  ?>
    <option value="<?php echo $row['IDAREA'] ?>"> <?php echo $row['NOMBRE'];?> </option>
  <?php 
  } 
}


?>