<?php
  class ControlEmpleado{
    var $objEmpleado;

    function __construct($objEmpleado){
      $this->objEmpleado=$objEmpleado;
    }
    
    function only_Employee(){
      try {
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL ConsultarSoloEmpleadosActivos()';
        $respuesta=$objControlConexion->ejecutarSelect($comandoSql);
        return $respuesta; 
        $objControlConexion->cerrarBd();
      }catch(Exception $e) {
        echo "Error: ".$e->getMessage();
      }
    }

    function EmployeeForCC(){
      try {
        $IDEmpleado=$this->objEmpleado->getIDEmpleado();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL ConsultarEmpleadoPorCC('.$IDEmpleado.')';
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        if ($rs->num_rows!==0) {
          $registro = $rs->fetch_array(MYSQLI_BOTH);
          $Nombre=$registro["NOMBRE"];
          $Foto=$registro["FOTO"];
          $HojaVida=$registro["HOJAVIDA"];
          $Telefono=$registro["TELEFONO"];
          $Email=$registro["EMAIL"];
          $Direccion=$registro["DIRECCION"];
          $X=$registro["X"];
          $Y=$registro["Y"];
          $FKArea=$registro["fkAREA"];
          $this->objEmpleado->setNombre($Nombre);
          $this->objEmpleado->setFoto($Foto);
          $this->objEmpleado->setHojaVida($HojaVida);
          $this->objEmpleado->setTelefono($Telefono);
          $this->objEmpleado->setEmail($Email);
          $this->objEmpleado->setDireccion($Direccion);
          $this->objEmpleado->setX($X);
          $this->objEmpleado->setY($Y);
          $this->objEmpleado->setFKArea($FKArea);
          return $this->objEmpleado;
        } else {
          return null;
        }
        $objControlConexion->cerrarBd();
      }catch(Exception $e){
        echo "Error: " . $e->getMessage();
      }
    }

    function UpdateEmployeeForCC(){
      try {
        $IDEmpleado=$this->objEmpleado->getIDEmpleado();
        $Nombre=$this->objEmpleado->getNombre();
        $Foto=$this->objEmpleado->getFoto();
        $HojaVida=$this->objEmpleado->getHojaVida();
        $Telefono=$this->objEmpleado->getTelefono();
        $Email=$this->objEmpleado->getEmail();
        $Direccion=$this->objEmpleado->getDireccion();
        $X=$this->objEmpleado->getX();
        $Y=$this->objEmpleado->getY();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL UpdateAnEmployeeForCC("'.$Nombre.'","'.$Foto.'","'.$HojaVida.'","'.$Telefono.'","'.$Email.'","'.$Direccion.'",'.$X.','.$Y.',"'.$IDEmpleado.'")';
        $resultado=$objControlConexion->ejecutarComandoSql($comandoSql);
        return $resultado;
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function ValidarEmpleado(){
      try {
        $Cedula=$this->objEmpleado->getIDEmpleado();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL ValidateEmployee("'.$Cedula.'")';
        $respuesta=$objControlConexion->ejecutarSelect($comandoSql);
        return $respuesta;
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
      echo "Error: " . $e->getMessage();
      }
    }

    function GuardarEmpleado(){
      try {
        $Cedula=$this->objEmpleado->getIDEmpleado();
        $Nombre=$this->objEmpleado->getNombre();
        $Foto=$this->objEmpleado->getFoto();
        $HojaVida=$this->objEmpleado->getHojaVida();
        $Telefono=$this->objEmpleado->getTelefono();
        $Email=$this->objEmpleado->getEmail();
        $Direccion=$this->objEmpleado->getDireccion();
        $X=$this->objEmpleado->getX();
        $Y=$this->objEmpleado->getY();
        $FKArea=$this->objEmpleado->getFKArea();

        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL SaveEmployee("'.$Cedula.'","'.$Nombre.'","'.$Foto.'","'.$HojaVida.'","'.$Telefono.'","'.$Email.'","'.$Direccion.'",'.$X.','.$Y.','.$FKArea.')';
        $respuesta=$objControlConexion->ejecutarComandoSql($comandoSql);
        if ($respuesta==1) {
          $FKCARGO =$this->objEmpleado->getFKCargo();
          $FKEMPLE =$Cedula;
          $FECHAINI=$this->objEmpleado->getFechaInicio();
          $FECHAFIN=$this->objEmpleado->getFechaFin();
          $comandoSql ='CALL SaveCargo_por_empleado('.$FKCARGO.',"'.$FKEMPLE.'","'.$FECHAINI.'","'.$FECHAFIN.'")';
           $res=$objControlConexion->ejecutarComandoSql($comandoSql);
          return $res;
        }else{
          return false;
        } 
      $objControlConexion->cerrarBd();
      } catch(Exception $e) {
      echo "Error: " . $e->getMessage();
      }
    }

    function ConsultarSoloNombre(){
      try {
        $IDEmpleado=$this->objEmpleado->getIDEmpleado();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL Consultonlyname("'.$IDEmpleado.'")';
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        $registro = $rs->fetch_array(MYSQLI_BOTH);
        if ($registro!=null) {
          $Nombre=$registro["NOMBRE"];
          return  $Nombre;
        }
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function ConsultarSoloEmpleadosPorArea(){
      try {
        $Area=$this->objEmpleado->getFKArea();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL ConsultonlyEmployeeForArea("'.$Area.'")';
        $respuesta=$objControlConexion->ejecutarSelect($comandoSql);
        return $respuesta; 
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
      echo "Error: " . $e->getMessage();
      }
    }


    function ReportEmployee(){
      try {
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql ='CALL ReportEmployee()';
        $respuesta=$objControlConexion->ejecutarSelect($comandoSql);
        return $respuesta; 
        $objControlConexion->cerrarBd();
      } catch(Exception $e) {
      echo "Error: " . $e->getMessage();
      }
    }




    
    function consultarNombre(){
      try {
        $IDEmpleado=$this->objEmpleado->getIDEmpleado();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd();
        $comandoSql = "select NOMBRE from Empleado where IDEMPLEADO = '".$IDEmpleado."' ";
        $rs = $objControlConexion->ejecutarSelect($comandoSql);
        $registro = $rs->fetch_array(MYSQLI_BOTH);
        if ($registro!=null) {
          $Nombre=$registro["NOMBRE"]; 
          $this->objEmpleado->setNombre($Nombre);
        } else {
          $this->objEmpleado->setNombre("undefine");
        }
        $objControlConexion->cerrarBd();
        return $this->objEmpleado;
      } catch(Exception $e) {
          echo "Error: " . $e->getMessage();
      }
    }


    
         function modificar(){
            try {
                $IDEmpleado=$this->objEmpleado->getIDEmpleado();
                $Nombre=$this->objEmpleado->getNombre();
                $Foto=$this->objEmpleado->getFoto();
                $HojaVida=$this->objEmpleado->getHojaVida();
                $Telefono=$this->objEmpleado->getTelefono();
                $Email=$this->objEmpleado->getEmail();
                $Direccion=$this->objEmpleado->getDireccion();
                $X=$this->objEmpleado->getX();
                $Y=$this->objEmpleado->getY();

                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "update Empleado set NOMBRE = '".$Nombre."', FOTO = '".$Foto."', HOJAVIDA = '".$HojaVida."', TELEFONO = ".$Telefono.", EMAIL = '".$Email."', DIRECCION = '".$Direccion."', X = ".$X.", Y = ".$Y." where IDEMPLEADO = '".$IDEmpleado."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            
        }

        function modificarArea(){
            try {
                $IDEmpleado=$this->objEmpleado->getIDEmpleado();
                $FKArea=$this->objEmpleado->getFKArea();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "update Empleado set fkAREA  = '".$FKArea."' where IDEMPLEADO = '".$IDEmpleado."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function modificarJefe() {
            try {
                $IDEmpleado=$this->objEmpleado->getIDEmpleado();
                $FKEmple_Jefe=$this->objEmpleado->getFKEmple_Jefe();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "update Empleado set fkAREA  = '".$FKArea."' where IDEMPLEADO = '".$IDEmpleado."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function borrar() {
            try {
                $IDEmpleado=$this->objEmpleado->getIDEmpleado();
                $objControlConexion = new ControlConexion();
                 $objControlConexion->abrirBd();
                $comandoSql = "delete from Empleado where IDEMPLEADO = '".$IDEmpleado."'";
                $objControlConexion->ejecutarComandoSql($comandoSql);
                $objControlConexion->cerrarBd();
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>