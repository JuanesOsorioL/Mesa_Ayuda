<?php
session_start();
function ValidarUsuario($usu,$con){
    include "../script/model/Usuario.php";
    include "../script/controller/ControlUsuario.php";
    include "../script/controller/ControlConexion.php";
    include "../script/model/Area.php";
    include "../script/controller/ControlArea.php";

    $objUsuario=new Usuario($usu,$con,"");
    $objControlUsuario=new ControlUsuario($objUsuario);
    $respuesta=$objControlUsuario-> ValidarLoguin();

    if ($respuesta==="null") {
        echo "<label>clave o usuario incorrecto</label>";
    } else {
      $_SESSION['Session']= $respuesta;

        //include "../script/controller/ControlConexion.php";

        $cedula=$_SESSION['Session']['Cedula'];
        $objArea=new Area("","",$cedula);
       // $objArea=new Area("","",$respuesta->Cedula);
        $objControlArea=new ControlArea($objArea);
        $respuesta=$objControlArea-> ConsultarCedulaEnArea();
        $_SESSION['Areas'] = $respuesta->fetch_all(MYSQLI_ASSOC);
        header("Location: ./Menu.php");
    } 
}
?>