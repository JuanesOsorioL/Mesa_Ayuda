<?php
    include "./Modelo/Requerimiento.php";
    include "./Modelo/Detalle.php";
    include "./Control/ControlDetalle.php";
    include "./Control/ControlRequerimiento.php";
    include "./Control/ControlConexion.php";
   
  
      session_start();
   
    $msj="";
if (isset($_POST['btn'])) {

   
    if (isset($_POST['btn'])) {
        $FKAREA=$_POST["selectArea"];
        $bot=$_POST['btn'];
        switch ($bot) {

            case 'Radicar':
                try {
                    $TITULO=$_POST["titulo"];
                    $objRequerimiento=new Requerimiento("", $FKAREA, $TITULO);
                    $objControlRequerimiento=new ControlRequerimiento($objRequerimiento);
                    $id=$objControlRequerimiento->guardar();
            
                    if ($id!=0) {
                      
                         // session_start();
                         
                        $FECHA= (new DateTime('now'))->format("Y-m-d h:i:s");
                        //$FECHA = date("Y-m-d h:i:s");
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


}


?>