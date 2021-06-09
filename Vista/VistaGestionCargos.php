<?php
  if (isset($_POST['Action'])) {

    $Funcion=$_POST['Action'];
    include "../Modelo/Cargo.php";
    include "../Control/ControlCargo.php";
    include "../Control/ControlConexion.php";

    switch ($Funcion) {

      case 'LoadPage':

        $objCargo=new Cargo("","");
        $objControlCargo=new ControlCargo($objCargo);
        $respuestaCargo=$objControlCargo-> AllPositions();
        $ArrayCargo=$respuestaCargo->fetch_all(MYSQLI_ASSOC);
        $items='';

        foreach ($ArrayCargo as $key => $value) {

        $accion=($value['Estado']==='Activo')?
          '<td>
              <div class="contenedor-icon">
                <i class="fas fa-pen" onclick="editar(event)"></i>
                <i class="fas fa-save" onclick="modificar(event)"></i>
              </div>
              <div class="contenedor-icon"> 
                <i class="fas fa-trash-alt" onclick="eliminar(event)"></i>
              </div>
            </td>
          </tr>':'
            <td>
              <div class="contenedor-iconlock">
                <i class="fas fa-user-lock" onclick="unlock(event)"></i>
              </div>
            </td>
          </tr>';

          $valor=($key<=1)?
            '<td>
              <div class="contenedor-iconlock">
                <i class="fas fa-lock" onclick="bloqueado()"></i>
              </div>
            </td>
          </tr>':$accion;

          $items=$items.'
          <tr>
            <td>
              <span>'.$value['IDCARGO'].'</span>
            </td>
          <td>
            <input type="text" value="'.$value['NOMBRE'].'" disabled>
          </td>'.$valor;

        }

        echo'
        <div class="main__sectionCargo-tabla">
          <table class="table_cargo">
            <tr>
              <td colspan="3">Cargos</td>
            </tr>
            <tr>
              <td><span>ID</span></td>
              <td><span>Nombre</span></td>
              <td><span>Accion</span></td>
            </tr>
            '.$items.'
          </table>    
        </div>
        <div class="main__sectionCargo-btn">
          <i class="fas fa-plus-circle" onclick="Activar(event)" ></i>
        </div>';

      break;

      case 'NewArea':
        $Nombre=$_POST['Nombre'];
        $objCargo=new Cargo("",$Nombre);
        $objControlCargo=new ControlCargo($objCargo);
        $respuesta=$objControlCargo-> NewArea();
        echo $respuesta;
      break;

      case 'Update':
        $Nombre=$_POST['Nombre'];
        $id=$_POST['id'];
        $objCargo=new Cargo($id,$Nombre);
        $objControlCargo=new ControlCargo($objCargo);
        $respuesta=$objControlCargo-> UpdateArea();
        echo $respuesta;
      break;

      case 'Delete':
        include "../Modelo/Empleado.php";
        $id=$_POST['id'];
        $FechaActual=$_POST['FechaActual'];
        $FechaInicial=$_POST['FechaInicial'];
        $Estado=$_POST['Estado'];
        
        $objEmpleado=new Empleado("", "", "", "", "", "", "", "","", "", $Estado,$id,$FechaInicial,$FechaActual);
        $objControlCargo=new ControlCargo($objEmpleado);
        $respuesta=$objControlCargo-> DeleteArea();
        echo $respuesta;
      break;

       case 'Unlocked':
        $id=$_POST['id'];
        $Estado=$_POST['Estado'];
        $objCargo=new Cargo($id,$Estado);
        $objControlCargo=new ControlCargo($objCargo);
        $respuesta=$objControlCargo-> Unlocked();
        echo $respuesta;
      break;
    }
  }

?>