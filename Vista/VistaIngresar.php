<?php
   
session_start();

function ValidarUsuario($usu,$con){
    include "./Modelo/Usuario.php";
    include "./Control/ControlUsuario.php";
    include "./Control/ControlConexion.php";

    $objUsuario=new Usuario($usu,$con,"");
    $objControlUsuario=new ControlUsuario($objUsuario);
    $respuesta=$objControlUsuario-> ValidarLoguin();

  


    if ($respuesta==="null") {
        //return false;
        echo "<label>clave o usuario incorrecto</label>";
    } else {
        $_SESSION['Session']= $respuesta;
        header("Location: ./Menu.php");
      /// header("Location: ./Requerimiento.php");
      //  print_r($respuesta);
       // return true;
    } 
}   



function FunctionName()
{
    # code...
}
?>