<?php
   
session_start();

function ValidarUsuario($usu,$con){
    include "../script/model/Usuario.php";
    include "../script/controller/ControlUsuario.php";
    include "../script/controller/ControlConexion.php";

    $objUsuario=new Usuario($usu,$con,"");
    $objControlUsuario=new ControlUsuario($objUsuario);
    $respuesta=$objControlUsuario-> ValidarLoguin();

    if ($respuesta==="null") {
        echo "<label>clave o usuario incorrecto</label>";
    } else {
        $_SESSION['Session']= $respuesta;
        header("Location: ./Menu.php");
    } 
}
?>