<?php
  class ControlArea{
    var $objArea;
        
    function __construct($objArea){
      $this->objArea=$objArea;
    } 
    
    function AllArea(){
      try {
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL ConsultarTodasLasAreas()';
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        return $rs;
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    ///////////////////



















        function ConsultarCedulaEnArea(){ ////funciona
            try {
               // $ArrayAreas = array();
              // $ArrayAreas=[];
                // $ArraySession=["Cedula"=>$cedula,"Nombre"=>$nombre,"Cargo"=>$cargo,"Area"=>$area];
                $cedula=$this->objArea->getFKEmple();
                $objControlConexion = new ControlConexion();
                $objControlConexion->abrirBd();
                //$objControlConexion->abrirBd("localhost","root","","mesa_ayuda");
                $comandoSql = "select IDAREA, NOMBRE from area where FKEMPLE = '".$cedula."'";
                $rs = $objControlConexion->ejecutarSelect($comandoSql);
              // return $rs->num_rows;///cantidad registros
               //$registro = $rs->fetch_all(MYSQLI_ASSOC)[2]['NOMBRE'];
             //  $registro = $rs->fetch_all(MYSQLI_ASSOC);

                /*  for ($i=0; $i < $rs->num_rows; $i++) { 
                    $Id=$registro[$i]['IDAREA'];
                    $Nombre=$registro[$i]['NOMBRE'];
                    $Dato=["IDArea"=>$Id,"Nombre"=>$Nombre];
                    array_push($ArrayAreas,$Dato);
                }  
                print_r($registro); */
               return  $rs;

                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        //////////




        function modificarAreaFkempleado() { ////fullciona
            try {
                $id=$this->objArea->getIDArea();
                $fkemple=$this->objArea->getFKEmple();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                if ($fkemple===NULL) {
                    $comandoSql = "update area set FKEMPLE = NULL where IDAREA = '".$id."'";
                } else {
                    $comandoSql = "update area set FKEMPLE = '".$fkemple."' where IDAREA = '".$id."'";
                }
                $res=$objControlConexion->ejecutarComandoSql($comandoSql);
                return $res;
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

///////////


















        function guardarTodo(){
            try {
                $id=$this->objArea->getIDArea();
                $nom=$this->objArea->getNombre();
                $fkemple=$this->objArea->getFKEmple();
            
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "insert into area (IDAREA , NOMBRE, FKEMPLE  ) values('".$id."','".$nom."','".$fkemple."')";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } 

        function guardar(){
            try {
                $id=$this->objArea->getIDArea();
                $nom=$this->objArea->getNombre();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "insert into area (IDAREA, NOMBRE) values('".$id."','".$nom."')";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } 




        function modificarArea(){
            try {
                $id=$this->objArea->getIDArea();
                $nom=$this->objArea->getNombre();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "update area set NOMBRE = '".$nom."' where IDAREA = '".$id."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function borrar(){
            try {
                $id=$this->objArea->getIDArea();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "delete from area where IDAREA = '".$id."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }  
    }
?> 