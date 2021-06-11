<?php
   if (isset($_POST['Action'])) {

    $Funcion=$_POST['Action'];
    include "../model/Area.php";
    include "../controller/ControlArea.php";
    include "../controller/ControlConexion.php";
 
    switch ($Funcion) {

      case 'LoadPage':
        $objArea=new Area("","","");
        $objControlArea=new ControlArea($objArea);
        $respuestaArea=$objControlArea-> AllAreaAlert();
        $ArrayArea=$respuestaArea->fetch_all(MYSQLI_ASSOC);
        $items='';
        if ($respuestaArea->num_rows===0) {
         echo '<div class="main__sectionAlertas-MSJ">
            <h1>Todas las Areas estan asignadas.</h1>
          </div>' ;
        } else {
          foreach ($ArrayArea as $key => $value) {

          $items=$items.'
          <tr>
            <td>
              <span>'.$value['IDAREA'].'</span>
            </td>
            <td>
              <span class="left">'.$value['NOMBRE'].'</span>
            </td>';
        }
        echo'
        <div class="main__sectionAlertas">
          <table class="table_Alertas">
            <tr>
              <td colspan="2">Alertas</td>
            </tr>
            <tr>
              <td colspan="2">Areas Sin Asignar</td>
            </tr>
            <tr>
              <td><span>ID</span></td>
              <td><span>Nombre</span></td>
            </tr>
            '.$items.'
            <tr>
              <td colspan="2">
              <input type="submit" value="Ir a Areas" name="btn" onclick="area()">
              </td>
            </tr>
          </table>    
        </div>'; 
        }

      break;

    }
    }
?>