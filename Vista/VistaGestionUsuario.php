<?php

  if (isset($_POST['Action'])) {

    $bot=$_POST['Action'];

    include "../Modelo/Usuario.php";
    include "../Control/ControlUsuario.php";
    include "../Control/ControlConexion.php";

    switch ($bot) {
      
      case 'LoadPage':

        $objUsuario=new Usuario("","","");
        $objControlUsuario=new ControlUsuario($objUsuario);
        $respuestaUsuario=$objControlUsuario-> AllUsers();
        $ArrayUsuario=$respuestaUsuario->fetch_all(MYSQLI_ASSOC);
        $valores='';

        foreach ($ArrayUsuario as $key => $value) {

          $acciones=($value['Estado']==="Activo")?
            '<div class="contenedor-icon">
              <i class="fas fa-pen" onclick="editar(event)"></i>
              <i class="fas fa-save" onclick="guardar(event)"></i>
            </div>
                              
            <div class="contenedor-icon"> 
              <i class="fas fa-trash-alt" onclick="lock(event)"></i>
            </div>

            ':'

            <div class="contenedor-iconlock">
              <i class="fas fa-user-lock" onclick="unlock(event)"></i>
            </div>';

          $valores = $valores.
            '<tr>
              <td>'.$value['FKIDEMPLEADO'].'</td>
              <td>'.$value['NOMBRE'].'</td>
              <td> <input type="text" name=""  value="'.$value['USUARIO'].'" disabled ></td>   
              <td> <input type="text" name=""  value="'.$value['PASS'].'" disabled ></td>
              <td>
                '.$acciones.'
              </td>
            </tr>';
        }
    
        echo $plantilla='
          <table>
            <tr>
              <td colspan="5" > Usuarios</td>
            </tr>
            <tr>
              <td>Cedula</td>
              <td>Nombre</td>
              <td>User</td>
              <td>Pass</td>
              <td>Accion</td>
            </tr>
          '.$valores.' 
          </table>';
      break;

      case "Locked":
        $Cedula=$_POST['Cedula'];
        $objUsuario=new Usuario("","",$Cedula);
        $objControlUsuario=new ControlUsuario($objUsuario);
        $resultado= $objControlUsuario-> LocketUser();
        echo $resultado;
      break;
      
      case "Unlocked":
        $Cedula=$_POST['Cedula'];
        $objUsuario=new Usuario("","",$Cedula);
        $objControlUsuario=new ControlUsuario($objUsuario);
        $resultado=$objControlUsuario->UnlocketUser();
        echo $resultado;
      break;

      case "Update":
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $Cedula=$_POST['Cedula'];
        $objUsuario=new Usuario($user,$pass,$Cedula);
        $objControlUsuario=new ControlUsuario($objUsuario);
        $resultado=$objControlUsuario->UpdateUser();
        echo $resultado;
      break;
    }
  }    
?>