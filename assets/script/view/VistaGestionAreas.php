<?php

  include_once "../script/model/Area.php";
  include_once "../script/controller/ControlArea.php";
  include_once "../script/model/Empleado.php";
  include_once "../script/controller/ControlEmpleado.php";
  include_once "../script/controller/ControlConexion.php";

  $objArea=new Area("","","");
  $objControlArea=new ControlArea($objArea);
  $respuestaArea=$objControlArea->AllArea();
  $ArrayArea=$respuestaArea->fetch_all(MYSQLI_ASSOC);
  $plantilla;

  if ($respuestaArea->num_rows!==0) {
    $Resultado="";

    for ($i=0; $i < $respuestaArea->num_rows; $i++) { 
      $Resultado = $Resultado.' <tr><td>'.$ArrayArea[$i]['IDAREA'].'</td><td>'.$ArrayArea[$i]['NOMBRE'].'</td><td>'.select($ArrayArea[$i]['FKEMPLE']).'</td></tr>';
    }

    $plantilla='<tr><td colspan="3" class=" tituloprincipal" >Areas</td></tr><tr><td class=" titulosecundario">ID</td><td class=" titulosecundario">Nombre Area</td><td class=" titulosecundario">Director Area</td></tr>'.$Resultado.'';
  } else {
       
  } 

  function select($ID){

    $objEmpleado=new Empleado("", "", "", "", "", "", "", "", "", "", "", "", "","");
    $objControlEmpleado=new ControlEmpleado($objEmpleado);
    $respuestaEmpleado=$objControlEmpleado-> only_Employee();

    if ($respuestaEmpleado->num_rows!==0) {
      $ArrayEmpleado=$respuestaEmpleado->fetch_all(MYSQLI_ASSOC);
      $select="";
        for ($b=0; $b < $respuestaEmpleado->num_rows; $b++) { 

          if ($ArrayEmpleado[$b]['IDEMPLEADO']===$ID) {
            $select=$select.'<option value="'.$ArrayEmpleado[$b]['IDEMPLEADO'].'" selected>'.$ArrayEmpleado[$b]['NOMBRE'].'</option>';
          } else {
            $select=$select.'<option value="'.$ArrayEmpleado[$b]['IDEMPLEADO'].'">'.$ArrayEmpleado[$b]['NOMBRE'].'</option>';
          }
        }
        
        return  $selectEmpleado='
            <select name="SelectEmpleado[]">
                <option value="0">Ninguno</option>
                '.$select.'
            </select>';
    }else{
      return $selectEmpleado='<select"><option value="0">No hay empleadosRegistrados</option></select>';  
    }
  }


  if (isset($_POST['btn'])) {
    $bot=$_POST['btn'];
    switch ($bot) {

      case 'Actualizar':
        $ArrayAreauno=$ArrayArea;
        for ($e=0; $e < $respuestaArea->num_rows; $e++) { 
          $area;
          $cedula;
            if ($_POST['SelectEmpleado'][$e]!=="0"){
              $area=$ArrayAreauno[$e]['IDAREA'];
              $cedula=$_POST['SelectEmpleado'][$e];
            }else{
              $area=$ArrayAreauno[$e]['IDAREA'];
              $cedula=NULL;
            } 

          $objActualizarArea=new Area($area,"",$cedula);
          $objControlActualizarArea=new ControlArea($objActualizarArea);
          $r=$objControlActualizarArea->modificarAreaFkempleado(); 
        }
        header("Location: ./GestionArea.php");
      break;


      case 'Menu':
        header("Location: ./Menu.php");
      break;

      default:
      break;
    }
  } 
?>