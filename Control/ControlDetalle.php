<?php
    class ControlDetalle
    {
        var $objDetalle;
        
         function __construct($objDetalle){
            $this->objDetalle=$objDetalle;
        } 
/// "SELECT * FROM detallereq INNER JOIN requerimiento ON detallereq.FKREQ =requerimiento.IDREQwhere FKEMPLEASIGNADO  = '".$FKEMPLEASIGNADO."'";

        function ConsultarRequerimientosAsignados(){/////funciona
            try {
                $FKEMPLEASIGNADO=$this->objDetalle->getFKEMPLEASIGNADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
               // $comandoSql = "select * from detallereq where FKEMPLEASIGNADO  = '".$FKEMPLEASIGNADO."'";
               $comandoSql ="SELECT * FROM detallereq INNER JOIN requerimiento ON detallereq.FKREQ =requerimiento.IDREQ where FKEMPLEASIGNADO  = '".$FKEMPLEASIGNADO."'";
                $rs = $objControlConexion->ejecutarSelect($comandoSql);
                return $rs;
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        //////////

        function ConsulRequeSinAsignar(){///////funciona
            try {
                $IDREQ=$this->objDetalle->getFKREQ();
                $FKESTADO=$this->objDetalle->getFKESTADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "select IDDETALLE,OBSERVACION,FKEMPLEASIGNADO,FKEMPLE from detallereq where FKREQ = '".$IDREQ."' && FKESTADO = '".$FKESTADO."'";
                $rs = $objControlConexion->ejecutarSelect($comandoSql);
                return $rs;
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ///////////////
            /*  function ModificarFKEmpleadoAsignado() {////funciona
                    try {
                    $IDDETALLE=$this->objDetalle->getIDDETALLE();
                    $FKEMPLEASIGNADO=$this->objDetalle->getFKEMPLEASIGNADO();
                        $objControlConexion = new ControlConexion();
                        $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");

                        if ($FKEMPLEASIGNADO===NULL) {
                            $comandoSql = "update detallereq set FKEMPLEASIGNADO = NULL where IDDETALLE = '".$IDDETALLE."'";
                        // $comandoSql = "update area set FKEMPLE = NULL where IDAREA = '".$id."'";
                        } else {
                            $comandoSql = "update detallereq set FKEMPLEASIGNADO = '".$FKEMPLEASIGNADO."', FKESTADO = 2 where IDDETALLE = '".$IDDETALLE."'";
                        // $comandoSql = "update area set FKEMPLE = '".$fkemple."' where IDAREA = '".$id."'";
                        }

                    
                        $respuesta=$objControlConexion->ejecutarComandoSql($comandoSql);
                        return  $respuesta;
                        $objControlConexion->cerrarBd();
                    } catch(Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } */

        //////
        function GuardarNuevoDetalleReg(){
            try {
                $FECHA=$this->objDetalle->getFECHA();
                $OBSERVACION=$this->objDetalle->getOBSERVACION();
                $FKREQ=$this->objDetalle->getFKREQ();
                $FKESTADO=$this->objDetalle->getFKESTADO();
                $FKEMPLE=$this->objDetalle->getFKEMPLE();
                $FKEMPLEASIGNADO=$this->objDetalle->getFKEMPLEASIGNADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "insert into detallereq (FECHA, OBSERVACION, FKREQ, FKESTADO, FKEMPLE,FKEMPLEASIGNADO) values('".$FECHA."','".$OBSERVACION."','".$FKREQ."','".$FKESTADO."','".$FKEMPLE."','".$FKEMPLEASIGNADO."')";
                $res=$objControlConexion->ejecutarComandoSql($comandoSql);
                return $res;
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ///////////

        function guardarTodo(){/////funciona
            try {
                $FECHA=$this->objDetalle->getFECHA();
                $OBSERVACION=$this->objDetalle->getOBSERVACION();
                $FKREQ=$this->objDetalle->getFKREQ();
                $FKESTADO=$this->objDetalle->getFKESTADO();
                $FKEMPLE=$this->objDetalle->getFKEMPLE();
                $FKEMPLEASIGNADO=$this->objDetalle->getFKEMPLEASIGNADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "insert into detallereq (FECHA, OBSERVACION, FKREQ, FKESTADO, FKEMPLE) values('".$FECHA."','".$OBSERVACION."','".$FKREQ."','".$FKESTADO."','".$FKEMPLE."')";
                $res=$objControlConexion->ejecutarComandoSql($comandoSql);
                return $res;
                $objControlConexion->cerrarBd();
                    } catch(Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } 

///////////////

function ConsultarRequerimientos(){/////funciona
    try {
        $FKEMPLEASIGNADO=$this->objDetalle->getFKEMPLEASIGNADO();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
       // $comandoSql = "select * from detallereq where FKEMPLEASIGNADO  = '".$FKEMPLEASIGNADO."'";
       $comandoSql ="SELECT * FROM detallereq INNER JOIN requerimiento ON detallereq.FKREQ =requerimiento.IDREQ";
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        return $rs;
        $objControlConexion->cerrarBd();
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}








///////////
        function Consultar(){
            try {
                $IDDETALLE=$this->objDetalle->getIDDETALLE();
                $FKEMPLEASIGNADO=$this->objDetalle->getFKEMPLEASIGNADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "select * from detallereq where IDDETALLE = '".$IDDETALLE."'";
                $rs = $objControlConexion->ejecutarSelect($comandoSql);
                return $rs;
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function modificarDetalle() {
            try {
               $IDDETALLE=$this->objDetalle->getIDDETALLE();
               $FECHA=$this->objDetalle->getFECHA();
               $OBSERVACION=$this->objDetalle->getOBSERVACION();
               $FKREQ=$this->objDetalle->getFKREQ();
               $FKESTADO=$this->objDetalle->getFKESTADO();
               $FKEMPLE=$this->objDetalle->getFKEMPLE();
               $FKEMPLEASIGNADO=$this->objDetalle->getFKEMPLEASIGNADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "update detallereq set FECHA = '".$FECHA."',OBSERVACION = '".$OBSERVACION."',FKREQ = '".$FKREQ."',FKESTADO = '".$FKESTADO."',FKEMPLE = '".$FKEMPLE."',FKEMPLEASIGNADO = '".$FKEMPLEASIGNADO."' where IDDETALLE = '".$IDDETALLE."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function modificarDetalleFKEmpleadoAsignado() {
            try {
               $IDDETALLE=$this->objDetalle->getIDDETALLE();
               $FKEMPLEASIGNADO=$this->objDetalle->getFKEMPLEASIGNADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "update detallereq set FKEMPLEASIGNADO = '".$FKEMPLEASIGNADO."' where IDDETALLE = '".$IDDETALLE."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function Borrar() {
            try {
               $IDDETALLE=$this->objDetalle->getIDDETALLE();
               $FKEMPLEASIGNADO=$this->objDetalle->getFKEMPLEASIGNADO();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "delete from detallereq where IDDETALLE = '".$IDDETALLE."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }   
    }
?> 