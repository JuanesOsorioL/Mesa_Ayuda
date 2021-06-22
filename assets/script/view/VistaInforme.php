<?php

   if (isset($_POST['Action'])) {   

    $Funcion=$_POST['Action'];
    switch ($Funcion) {

      case 'Primero':

        include "../model/Area.php";
        include "../model/Empleado.php";
        include "../controller/ControlEmpleado.php";
        include "../controller/ControlArea.php";
        include "../controller/ControlConexion.php";
        
        $objArea=new Area("","","");
        $objControlArea=new ControlArea($objArea);
        $respuestaArea=$objControlArea->AllArea();
        $ArrayArea=$respuestaArea->fetch_all(MYSQLI_ASSOC);
        $items='';

        foreach ($ArrayArea as $key => $item) {
        $nombre="Null";
        if ($item['FKEMPLE']!="") {
          $objEmpleado=new Empleado($item['FKEMPLE'],"","","","","","","","","","","","","");
          $objControlEmpleado=new ControlEmpleado($objEmpleado);
          $respuestaEmpleado=$objControlEmpleado->ValidarEmpleado();
          $ArrayEmpleado=$respuestaEmpleado->fetch_all(MYSQLI_ASSOC);
          $nombre=$ArrayEmpleado[$key]['NOMBRE'];
        }

        $cantidad="0";
        $objEmpleado=new Empleado("","","","","","","","","",$item['IDAREA'],"","","","");
        $objControlEmpleado=new ControlEmpleado($objEmpleado);
        $respuestaEmpleado=$objControlEmpleado->ConsultarSoloEmpleadosPorArea();
        $cantidad=$respuestaEmpleado->num_rows;
        
         $items=$items.'
          <tr>
            <td>
              '.$item['IDAREA'].'
            </td>
            <td>
              '.$item['NOMBRE'].'
            </td>
            <td>
              '.$nombre.'
            </td>
             <td>
              '.$cantidad.'
            </td>
          </tr>
        '; 
        }

        echo'
        <div>
          <table>
            <tr>
              <td>
              ID
              </td>
              <td>
                Area
              </td>
              <td>
               Jefe
              </td>
            </tr>
          '.$items.'
          </table>  
        </div>
        '; 
      break;



      case 'Segundo':

        include "../model/Empleado.php";
        include "../controller/ControlEmpleado.php";
        include "../controller/ControlConexion.php";
        
        $objEmpleados=new Empleado("","","","","","","","","","","","","","");
        $objControlEmpleados=new ControlEmpleado($objEmpleados);
        $respuestaEmpleados=$objControlEmpleados->ReportEmployee();
        $ArrayEmpleados=$respuestaEmpleados->fetch_all(MYSQLI_ASSOC);
        $items='';

        foreach ($ArrayEmpleados as $key => $item) {
        $nombre="Null";
        if ($item['fkEMPLE_JEFE']!="") {
          $objEmpleado=new Empleado($item['fkEMPLE_JEFE'],"","","","","","","","","","","","","");
          $objControlEmpleado=new ControlEmpleado($objEmpleado);
          $respuestaEmpleado=$objControlEmpleado->ValidarEmpleado();
          $ArrayEmpleado=$respuestaEmpleado->fetch_all(MYSQLI_ASSOC);
          $nombre=$ArrayEmpleado[$key]['NOMBRE'];
        }

         $items=$items.'
          <tr>
            <td>
              '.$item['IDEMPLEADO'].'
            </td>
            <td>
              '.$item['NOMBREEMPLEADO'].'
            </td>
            <td>
              '.$nombre.'
            </td>
             <td>
             '.$item['NOMBREAREA'].'
            </td>
          </tr>
        '; 
        }

        echo'
        <div>
          <table>
            <tr>
              <td>
              Cedula
              </td>
              <td>
                Nombre
              </td>
              <td>
               Jefe
              </td>
              <td>
               Area
              </td>
            </tr>
          '.$items.'
          </table>
        </div>
        ';  
      break;





      
    }
    }
?>