<?php
	class Detalle 
	{
		var $IDDETALLE;
		var $FECHA;
        var $OBSERVACION;
        var $FKREQ ;
        var $FKESTADO ;
        var $FKEMPLE ;
        var $FKEMPLEASIGNADO  ;
	
		function __construct($iddetalle, $fecha, $observacion, $fkreq, $fkestado, $fkemple, $fkempleasignado){
           $this->IDDETALLE=$iddetalle;
           $this->FECHA=$fecha;
           $this->OBSERVACION=$observacion;
           $this->FKREQ=$fkreq;
           $this->FKESTADO=$fkestado;
           $this->FKEMPLE=$fkemple;
           $this->FKEMPLEASIGNADO=$fkempleasignado;
		}

        function setIDDETALLE($iddetalle){
			$this->IDDETALLE=$iddetalle;
		}

		function getIDDETALLE(){
			return $this->IDDETALLE;
		}

        function setFECHA($fecha){
			$this->FECHA=$fecha;
		}

		function getFECHA(){
			return $this->FECHA;
		}

		function setOBSERVACION($observacion){
			$this->OBSERVACION=$observacion;
		}

		function getOBSERVACION(){
			return $this->OBSERVACION;
		}

		function setFKREQ($fkreq){
			$this->FKREQ=$fkreq;
		}

		function getFKREQ(){
			return $this->FKREQ;
		}

		function setFKESTADO($fkestado){
			$this->FKESTADO=$fkestado;
		}

		function getFKESTADO(){
			return $this->FKESTADO;
		}

		function setFKEMPLE($fkemple){
			$this->FKEMPLE=$fkemple;
		}

		function getFKEMPLE(){
			return $this->FKEMPLE;
		}

		function setFKEMPLEASIGNADO($fkempleadoasignado){
			$this->FKEMPLEASIGNADO=$fkempleadoasignado;
		}

		function getFKEMPLEASIGNADO(){
			return $this->FKEMPLEASIGNADO;
		}
	}
?>