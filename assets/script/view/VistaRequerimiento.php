<?php
  include "../model/Requerimiento.php";
  include "../model/Detalle.php";
  include "../controller/ControlDetalle.php";
  include "../controller/ControlRequerimiento.php";
  include "../controller/ControlConexion.php";
  session_start();
  $msj="";
  if (isset($_POST['Action'])) {
    $FKAREA=$_POST["selectArea"];
    $Action=$_POST['Action'];
    switch ($Action) {
      case 'Radicar':
      try {
        $TITULO=$_POST["titulo"];
        $objRequerimiento=new Requerimiento("", $FKAREA, $TITULO);
        $objControlRequerimiento=new ControlRequerimiento($objRequerimiento);
        $id=$objControlRequerimiento->guardar();
        if ($id!=0) {
          $FECHA= (new DateTime('now'))->format("Y-m-d");//
          $OBSERVACION=$_POST["message"];
          $FKESTADO="1";
          $objDetalle=new Detalle(0,$FECHA, $OBSERVACION, intval($id), $FKESTADO, $_SESSION['Session']['Cedula'],"");
          $objControlDetalle=new ControlDetalle($objDetalle);
          $res=$objControlDetalle->guardarTodo();
          if ($res===true) {
            $msj="se guardo correctamente";
          } else {
            $msj="no se guardo detalle";
          }
        } else {
          $msj="no se guardo requerimiento";
        } 
        echo $msj;
      } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
      }   
      break;

      default:
      break;
    }
  }
?>