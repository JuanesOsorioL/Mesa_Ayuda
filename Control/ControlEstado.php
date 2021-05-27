<?php
    class ControlEstado
    {
        var $objEstado;
        
         function __construct($objestado){
            $this->objEstado=$objestado;
        } 
    
        function guardar(){
            try {
                $id=$this->objEstado->getIDESTADO();
                $nom=$this->objEstado->getNOMBRE();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "insert into estado (IDESTADO , NOMBRE) values('".$id."','".$nom."')";
                $objControlConexion->ejecutarComandoSqlSinRespuesta($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } 

        function consultarTodosEstados(){
            try {
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "select * from estado";
                $rs = $objControlConexion->ejecutarSelect($comandoSql);
                return $rs;
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    
        function modificarEstado() {
            try {
                $id=$this->objEstado->getIDESTADO();
                $nom=$this->objEstado->getNOMBRE();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "update estado set NOMBRE = '".$nom."' where IDESTADO = '".$id."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }


        function borrar(){
            try {
                $id=$this->objEstado->getIDESTADO();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "delete from estado where IDESTADO = '".$id."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }  
    }
?> 