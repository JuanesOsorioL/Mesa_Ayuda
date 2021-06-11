<?php
	class Estado 
	{
		var $IDESTADO;
		var $NOMBRE;
      
	
		function __construct($idestado, $nombre){
			$this->IDESTADO=$id;
			$this->NOMBRE=$nombre;
		}

		function setIDESTADO($idestado){
			$this->IDESTADO=$idestado;
		}

		function getIDESTADO(){
			return $this->IDESTADO;
		}

		function setNOMBRE($nombre){
			$this->NOMBRE=$nombre;
		}

		function getNOMBRE(){
			return $this->NOMBRE;
		}
	}
?>