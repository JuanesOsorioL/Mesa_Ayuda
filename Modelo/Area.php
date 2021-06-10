<?php
	class Area 
	{
		var $IDArea;
		var $Nombre;
    var $FKEmple;
	
		function __construct($id, $nombre, $fkempleado){
			$this->IDArea=$id;
			$this->Nombre=$nombre;
      $this->FKEmple=$fkempleado;
		}

		function setIDArea($id){
			$this->IDArea=$id;
		}

		function getIDArea(){
			return $this->IDArea;
		}

		function setNombre($nombre){
			$this->Nombre=$nombre;
		}

		function getNombre(){
			return $this->Nombre;
		}

		function setFKEmple($fkempleado){
			$this->FKEmple=$fkempleado;
		}
		
		function getFKEmple(){
			return $this->FKEmple;
		}
	}
?>