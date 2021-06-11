<?php
  class ControlUsuario{
    
    var $objUsuario;
   
    function __construct($objusuario){
      $this->objUsuario=$objusuario;
    }
    
    function AllUsers(){
      try {	
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL MostrarTodosLosUsuarios()';
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        return $rs;
        $objControlConexion->cerrarBd();
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function UpdateUser(){
      try {
        $user=$this->objUsuario->getUSUARIO();
        $pass=$this->objUsuario->getPASS();
        $Cedula=$this->objUsuario->getFKIDEMPLEADO();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL ModificarUsuario("'.$Cedula.'","'.$user.'","'.$pass.'")';
        $resultado=$objControlConexion->ejecutarComandoSql($comandoSql);
        return $resultado;
        $objControlConexion->cerrarBd();
      } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
    }

    function LocketUser(){
      try {
        $Cedula=$this->objUsuario->getFKIDEMPLEADO();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL InactivarUnUsuario("'.$Cedula.'")';
        $resultado=$objControlConexion->ejecutarComandoSql($comandoSql);
        return $resultado;
        $objControlConexion->cerrarBd();
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function UnlocketUser(){
      try {
        $Cedula=$this->objUsuario->getFKIDEMPLEADO();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL ActivarUnUsuario("'.$Cedula.'")';
        $resultado=$objControlConexion->ejecutarComandoSql($comandoSql);
        return $resultado;
        $objControlConexion->cerrarBd();
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function ValidarUsuario(){
      try {
        $usu=$this->objUsuario->getUSUARIO();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL ValidateUser("'.$usu.'")';
        $respuesta = $objControlConexion->ejecutarSelect($comandoSql);
       return $respuesta;
        $objControlConexion->cerrarBd();
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function GuardarUsuario(){
      try {
        $usu=$this->objUsuario->getUSUARIO();
        $con=$this->objUsuario->getPASS();
        $idemple=$this->objUsuario->getFKIDEMPLEADO();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL SaveUsuario("'.$usu.'","'.$con.'","'.$idemple.'")';
        $respuesta=$objControlConexion->ejecutarComandoSql($comandoSql);
        return $respuesta;
        $objControlConexion->cerrarBd();
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
        
////////////////////////////////

        function ValidarLoguin(){ ////funciona
            try {
                $usu=$this->objUsuario->getUSUARIO();
                $con=$this->objUsuario->getPASS();	
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd();
                $comandoSql = "SELECT FKIDEMPLEADO,fkAREA,NOMBRE,FOTO,FKCARGO FROM usuario INNER JOIN empleado INNER JOIN cargo_por_empleado ON usuario.FKIDEMPLEADO=empleado.IDEMPLEADO && cargo_por_empleado.FKEMPLE = usuario.FKIDEMPLEADO where USUARIO = '".$usu."' && PASS = '".$con."' ";
                $rs = $objControlConexion->ejecutarSelect($comandoSql);
                $registro = $rs->fetch_array(MYSQLI_BOTH);
                if ($registro!==null) {
                    $cedula=$registro["FKIDEMPLEADO"];
                    $area=$registro["fkAREA"];
                    $foto=$registro["FOTO"];
                    $nombre=$registro["NOMBRE"];
                    $cargo=$registro["FKCARGO"];
                    $ArraySession=["Cedula"=>$cedula,"Nombre"=>$nombre,"Cargo"=>$cargo,"Area"=>$area,"Foto"=>$foto];
                    return $ArraySession;
                }
                else {
                    return "null";
                } 
                $objControlConexion->cerrarBd();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }       
///////
/*"SELECT usuario FROM tableA INNER JOIN tableB ON tableA.nombre_columna=tableB.nombre_columna"*/
//MostrarTodosLosUsuarios


        function consultar(){
            try {
                $usu=$this->objUsuario->getUSUARIO();
                $con=$this->objUsuario->getPASS();	
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
                $comandoSql = "select ID,FKIDEMPLEADO from usuario where USUARIO = '".$usu."' && PASS = '".$con."' ";
                $rs = $objControlConexion->ejecutarSelect($comandoSql);
                $registro = $rs->fetch_array(MYSQLI_BOTH);
                if  ($registro!=null) {
                    $id = $registro["ID"];
                    $fkidempleado= $registro["FKIDEMPLEADO"];
                } else {
                    $id = "undefine";
                    $fkidempleado= "undefine";
                }
                $this->objUsuario->setID($id);
                $this->objUsuario->setFKIDEMPLEADO($fkidempleado);
                $objControlConexion->cerrarBd();
                return $this->objUsuario;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    
    }
?>