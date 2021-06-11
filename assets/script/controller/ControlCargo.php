<?php
    class ControlCargo{
    var $objCargo;
        
    function __construct($objCargo){
      $this->objCargo=$objCargo;
    } 
    
    function AllPositions(){
      try {
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL AllPositions()';
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        return $rs;
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function ValidateArea($Nombre,$objControlConexion){
      try {
      $objControlConexion->abrirBd();
        $comandoSql ='CALL ValidateArea("'.$Nombre.'")';
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        return $rs;
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function NewArea(){
      try {
        $Nombre=$this->objCargo->getNOMBRE();
        $objControlConexion = new ControlConexion();
        $respuesta=$this->ValidateArea($Nombre,$objControlConexion);
        if ($respuesta->num_rows===1) {
          return "1";
        } else {
          $objControlConexion->abrirBd();
          $comandoSql ='CALL NewArea("'.$Nombre.'")';
          $objControlConexion->ejecutarSelect($comandoSql);
          $objControlConexion->cerrarBd();
          return "0";
        }  
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function UpdateArea(){
      try {
        $id=$this->objCargo->getIDCargo();
        $Nombre=$this->objCargo->getNOMBRE();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL UpdateArea("'.$id.'","'.$Nombre.'")';
        $respuesta=$objControlConexion->ejecutarSelect($comandoSql);
        return $respuesta;
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function DeleteArea(){
      try {
        $id=$this->objCargo->getFKCargo();
        $FechaInicial=$this->objCargo->getFechaInicio();
        $FechaActual=$this->objCargo->getFechaFin();
        $Estado=$this->objCargo->getFKEmple_Jefe();
        $objControlConexion = new ControlConexion();

        $respuesta=$this->CambiarEstadoArea($id,$Estado,$objControlConexion);
        if (intval($respuesta) ===1) {
          $objControlConexion->abrirBd();
          $comandoSql ='CALL DeleteArea('.$id.',"'.$FechaInicial.'","'.$FechaActual.'")';
          $respuesta=$objControlConexion->ejecutarSelect($comandoSql); 
          return $respuesta;
          $objControlConexion->cerrarBd();
        }  else {
         return "-1";
        }
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function CambiarEstadoArea($id,$Nombre,$objControlConexion){
      try {
      $objControlConexion->abrirBd();
        $comandoSql ='CALL UpdateDeleteArea('.$id.',"'.$Nombre.'")';
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        return $rs;
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function Unlocked(){
      $id=$this->objCargo->getIDCargo();
      $Estado=$this->objCargo->getNOMBRE();
      $objControlConexion = new ControlConexion();
      $respuesta=$this->CambiarEstadoArea($id,$Estado,$objControlConexion);
      return $respuesta;
    }
  }
?>
