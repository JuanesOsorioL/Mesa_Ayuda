<?php
    class ControlRequerimiento
    {
        var $objRequerimiento;
    
        function __construct($objrequerimiento){
            $this->objRequerimiento=$objrequerimiento;
        }
    

        function guardar(){//////funciona
            try {
                $TITULO=$this->objRequerimiento->getTITULO();
                $FKAREA=$this->objRequerimiento->getFKAREA();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "insert into requerimiento (FKAREA, TITULO) values('".$FKAREA."','".$TITULO."')";
                $id=$objControlConexion->ejecutarComandoSqlRecuperarID($comandoSql);
                return $id;
                $objControlConexion->cerrarBd();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

/*         $comandoSql = "select ID,FKIDEMPLEADO from usuario where USUARIO = '".$usu."' && PASS = '".$con."' ";

        "SELECT nombre_columna FROM tableA INNER JOIN tableB ON tableA.nombre_columna=tableB.nombre_columna"
         "SELECT IDREQ ,FKAREA FROM Requerimiento INNER JOIN detallereq ON Requerimiento.IDREQ=detallereq.FKREQ  where FKAREA  = '".$FKAREA."' && FKESTADO  = 1 ";
 */



////////////
function ColsultarTodosLosID(){///funciona
    try {
        $FKAREA=$this->objRequerimiento->getFKAREA();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
        //$comandoSql = "select * from Requerimiento where FKAREA  = '".$FKAREA."' ";
        $comandoSql = "SELECT IDREQ ,TITULO,FKEMPLE,FKAREA,FKESTADO,OBSERVACION,FKEMPLEASIGNADO FROM Requerimiento INNER JOIN detallereq ON Requerimiento.IDREQ=detallereq.FKREQ  where FKAREA  = '".$FKAREA."'";
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        return $rs;
        $objControlConexion->cerrarBd();
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
// && FKESTADO  = 1 
//////////









        
        function consultarUna(){
            try {
                $IDREQ=$this->objRequerimiento->getIDREQ();	
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "select FKAREA from Requerimiento where IDREQ  = '".$IDREQ."' ";
                $rs = $objControlConexion->ejecutarSelect($comandoSql);
                $registro = $rs->fetch_array(MYSQLI_BOTH);
                ($registro!=null)?$id = $registro["FKAREA"]:$id = "undefine";
                $this->objRequerimiento->setID($id);
                $objControlConexion->cerrarBd();
                return $this->objRequerimiento;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }








function ConsultarRequerimientosAsignados(){
    try {
       
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
        $comandoSql = "select * from detallereq";
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        return $rs;
        $objControlConexion->cerrarBd();
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}



        function consultarTodas(){
            try {
               
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "select * from Requerimiento";
                $rs = $objControlConexion->ejecutarSelect($comandoSql);
                return $rs;
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

         function modificar(){
            try {
                $IDREQ=$this->objRequerimiento->getIDREQ();	
                $FKAREA=$this->objRequerimiento->getFKAREA();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "update Requerimiento set FKAREA = '".$FKAREA."' where IDREQ = '".$IDREQ."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    
        function borrar(){
            try {
                $IDREQ=$this->objRequerimiento->getIDREQ();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "delete from Requerimiento where IDREQ = '".$IDREQ."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } 
    }
?>