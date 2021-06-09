<?php
	class Cargo 
	{
		var $IDCargo;
		var $NOMBRE;
	
		function __construct($idCargo, $nombre){
			$this->IDCargo=$idCargo;
			$this->NOMBRE=$nombre;
		}

		function setIDCargo($idCargo){
			$this->IDCargo=$idCargo;
		}

		function getIDCargo(){
			return $this->IDCargo;
		}

		function setNOMBRE($nombre){
			$this->NOMBRE=$nombre;
		}

		function getNOMBRE(){
			return $this->NOMBRE;
		}
	}
?>