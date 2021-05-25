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
                    $valores= $valores.
                    '<tr>
                         <td>'.$value['FKIDEMPLEADO'].'</td>
                         <td>'.$value['NOMBRE'].'</td>
                         <td> <input type="text" name=""  value="'.$value['USUARIO'].'" disabled ></td>   
                         <td> <input type="text" name=""  value="'.$value['PASS'].'" disabled ></td>
                         <td>
                              <div class="contenedor-icon">
                                   <i class="fas fa-pen" onclick="editar(event)"></i>
                                   <i class="fas fa-save" onclick="guardar(event)"></i>
                              </div>
                            
                              <div class="contenedor-icon"> 
                                   <i class="fas fa-trash-alt" onclick="eliminar(event)"></i>
                              </div>
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


          case "Update":
               $user=$_POST['user'];
               $pass=$_POST['pass'];
               $id=$_POST['id'];
               $objUsuario=new Usuario($user, $pass, $id);
               $objControlUsuario=new ControlUsuario($objUsuario);
               $resultado= $objControlUsuario-> UpdateUser();
               echo  $resultado;
          break;

          case "Delete":
               $id=$_POST['id'];
               $objUsuario=new Usuario("","", $id);
               $objControlUsuario=new ControlUsuario($objUsuario);
               $resultado= $objControlUsuario-> DeleteUser();
               echo  $resultado;
          break;
          }
     }
     
?>