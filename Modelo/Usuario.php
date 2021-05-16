<?php
	class Usuario 
	{
		var $ID;
		var $USUARIO;
		var $PASS;
		var $FKIDEMPLEADO;

		function __construct($usuario, $pass, $fkidempleado)
		{
			$this->USUARIO=$usuario;
			$this->PASS=$pass;
			$this->FKIDEMPLEADO=$fkidempleado;
		}
		function setID($id){
			$this->ID=$id;
		}
		function getID(){
			return $this->ID;
		}
		function setUSUARIO($usuario){
			$this->USUARIO=$usuario;
		}
		function getUSUARIO(){
			return $this->USUARIO;
		}
		function setPASS($pass){
			$this->PASS=$pass;
		}
		function getPASS(){
			return $this->PASS;
		}
		function setFKIDEMPLEADO($fkidempleado){
			$this->FKIDEMPLEADO=$fkidempleado;
		}
		function getFKIDEMPLEADO(){
			return $this->FKIDEMPLEADO;
		}
	}
?>