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
   
    include_once "../script/model/Empleado.php";
    include_once "../script/controller/ControlEmpleado.php";
    include_once "../script/model/Usuario.php";
    include_once "../script/controller/ControlUsuario.php";
    include_once "../script/controller/ControlConexion.php";

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

       $objEmpleado=new Empleado($Cedula, "", "", "", "", "", "", "", "", "","", "", "","","");
      $objControlEmpleado=new ControlEmpleado($objEmpleado);
      $resValidacionEmple=$objControlEmpleado->ValidarEmpleado();


       if ($resValidacionEmple->num_rows===1) {
        $msj="Ya existe la cedula: ".$Cedula;
      }else{

        $objUsuario=new Usuario($Usuario, "", "");
        $objControlUsuario=new ControlUsuario($objUsuario);
        $resValidarUsu=$objControlUsuario->ValidarUsuario(); 

        if ($resValidarUsu->num_rows===1) {
          $msj="Ya existe el Usuario";
        }else{
          if (isset ($_FILES['Imagen'])) {
           // $RutaImgss = "uploads/".strval($Cedula).$_FILES['Imagen']['name'];
            $RutaImg = "uploads/".strval($Cedula).".jpg";
            $RutaImgtemp="../".$RutaImg;
            move_uploaded_file($_FILES['Imagen']['tmp_name'],$RutaImgtemp); 
          }
          if (isset ($_FILES['HojaVida'])) {
           //$RutaHoja = "uploads/".strval($Cedula).$_FILES['HojaVida']['name'];
            $RutaHoja = "uploads/".strval($Cedula).".pdf";
            $RutaHojatemp="../".$RutaHoja;
            move_uploaded_file($_FILES['HojaVida']['tmp_name'], $RutaHojatemp); 
          } 

          $FKCARGO =2;
          $FECHAFIN='0000-00-00';
          $FECHAINI=(new DateTime('now'))->format("Y-m-d");
          $objEmpleado=new Empleado($Cedula, $Nombre, $RutaImg, $RutaHoja, $Telefono, $Email, $Direccion, $X, $Y, $Area, "", $FKCARGO,  $FECHAINI,$FECHAFIN);

          $objControlEmpleado=new ControlEmpleado($objEmpleado);
          $resGuardarEmple=$objControlEmpleado->GuardarEmpleado();

          if ($resGuardarEmple==1) {

            $objUsuario=new Usuario($Usuario, $Pass, $Cedula);
            $objControlUsuario=new ControlUsuario($objUsuario);
            $resGuardarUsua=$objControlUsuario->GuardarUsuario();
            $msj= $resGuardarUsua;
            if ($resGuardarUsua==1) {
              $msj="Empleado Guardado Con Exito";
            } else {
              $msj="No se guardo Usuario y Contraseña Informar al administrador";
            }  
          } else {
            $msj="No se registro la Cedula: ".$Cedula;
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
  include_once "../script/controller/ControlConexion.php";
  include_once "../script/controller/ControlArea.php";
  include_once "../script/model/Area.php";

  $objArea=new Area("","","");
  $objControlArea=new ControlArea($objArea);
  $resultado=$objControlArea->AllArea();
  while($row = $resultado->fetch_assoc()) { 
  ?>
    <option value="<?php echo $row['IDAREA'] ?>"> <?php echo $row['NOMBRE'];?> </option>
  <?php 
  } 
}


?>