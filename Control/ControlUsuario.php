<?php
    class ControlUsuario
    {
        var $objUsuario;
    
        function __construct($objusuario){
            $this->objUsuario=$objusuario;
        }
    

        function AllUsers(){
            try {	
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
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
                $id=$this->objUsuario->getFKIDEMPLEADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql ='CALL ModificarUsuario("'.$id.'","'.$user.'","'.$pass.'")';
                $resultado=$objControlConexion->ejecutarComandoSql($comandoSql);
                return $resultado;
                $objControlConexion->cerrarBd();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function DeleteUser(){
            try {
                $id=$this->objUsuario->getFKIDEMPLEADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql ='CALL EliminarUnUsuario("'.$id.'")';
                $resultado=$objControlConexion->ejecutarComandoSql($comandoSql);
                return $resultado;
                $objControlConexion->cerrarBd();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

///////////////////

        function ValidarUsuario(){//funciona
            try {
                $control=false;
                $usu=$this->objUsuario->getUSUARIO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "select ID from usuario where USUARIO = '".$usu."'";
                $respuesta = $objControlConexion->ejecutarSelect($comandoSql);
                if ($respuesta->num_rows===1) {
                    $control=true;
                } 
                return $control;
                $objControlConexion->cerrarBd();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function GuardarUsuario(){///funciona
            try {
                $usu=$this->objUsuario->getUSUARIO();
                $con=$this->objUsuario->getPASS();
                $idemple=$this->objUsuario->getFKIDEMPLEADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "insert into usuario (USUARIO, PASS, FKIDEMPLEADO) values('".$usu."','".$con."','".$idemple."')";
                $respuesta=$objControlConexion->ejecutarComandoSql($comandoSql);
                return $respuesta;
                $objControlConexion->cerrarBd();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        


/*         $comandoSql = "select ID,FKIDEMPLEADO from usuario where USUARIO = '".$usu."' && PASS = '".$con."' ";

        "SELECT nombre_columna FROM tableA INNER JOIN tableB ON tableA.nombre_columna=tableB.nombre_columna"
         "SELECT FKIDEMPLEADO,NOMBRE FROM usuario INNER JOIN empleado ON usuario.FKIDEMPLEADO=empleado.IDEMPLEADO where USUARIO = '".$usu."' && PASS = '".$con."' ";
 */

//////

        function ValidarLoguin(){ ////funciona
            try {
                $usu=$this->objUsuario->getUSUARIO();
                $con=$this->objUsuario->getPASS();	
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
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
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
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