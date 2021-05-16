<?php
	class Empleado 
	{
		var $IDEmpleado;
		var $Nombre;
        var $Foto;
        var $HojaVida;
        var $Telefono;
        var $Email;
        var $Direccion;
        var $X;
        var $Y;
		var $FKArea;
		var $FKEmple_Jefe;
		var $FKCargo;
		var $FechaInicio;
		var $FechaFin;

		function __construct($idempleado, $nombre, $foto, $hojavida, $telefono, $email, $direccion, $x, $y, $fkarea, $fkemple_jefe,
		$fkcargo,$fechainicio,$fechafin){

            $this->IDEmpleado=$idempleado;
            $this->Nombre=$nombre;
            $this->Foto=$foto;
            $this->HojaVida=$hojavida;
            $this->Telefono=$telefono;
            $this->Email=$email;
            $this->Direccion=$direccion;
            $this->X=$x;
            $this->Y=$y;
			$this->FKArea=$fkarea;
			$this->FKEmple_Jefe=$fkemple_jefe;
			$this->FKCargo=$fkcargo;
			$this->FechaInicio=$fechainicio;
			$this->FechaFin=$fechafin;
		}

///////////
		function setFechaFin($fechafin){
			$this->FechaFin=$fechafin;
		}

		function getFechaFin(){
			return $this->FechaFin;
		}

		function setFechaInicio($fechainicio){
			$this->FechaInicio=$fechainicio;
		}

		function getFechaInicio(){
			return $this->FechaInicio;
		}

		function setFKCargo($fkcargo){
			$this->FKCargo=$fkcargo;
		}

		function getFKCargo(){
			return $this->FKCargo;
		}
///////////	
        function setIDEmpleado($idempleado){
			$this->IDEmpleado=$idempleado;
		}

		function getIDEmpleado(){
			return $this->IDEmpleado;
		}

        function setNombre($nombre){
			$this->Nombre=$nombre;
		}

		function getNombre(){
			return $this->Nombre;
		}

        function setFoto($foto){
			$this->Foto=$foto;
		}

		function getFoto(){
			return $this->Foto;
		}

        function setHojaVida($hojavida){
			$this->HojaVida=$hojavida;
		}

		function getHojaVida(){
			return $this->HojaVida;
		}

        function setTelefono($telefono){
			$this->Telefono=$telefono;
		}

		function getTelefono(){
			return $this->Telefono;
		}

        function setEmail($email){
			$this->Email=$email;
		}

		function getEmail(){
			return $this->Email;
		}

        function setDireccion($direccion){
			$this->Direccion=$direccion;
		}

		function getDireccion(){
			return $this->Direccion;
		}

        function setX($x){
			$this->X=$x;
		}

		function getX(){
			return $this->X;
		}

        function setY($y){
			$this->Y=$y;
		}

		function getY(){
			return $this->Y;
		}

		function setFKArea($fkarea){
			$this->FKArea=$fkarea;
		}

		function getFKArea(){
			return $this->FKArea;
		}

		function setFKEmple_Jefe($fkemple_jefe){
			$this->FKEmple_Jefe=$fkemple_jefe;
		}
		
		function getFKEmple_Jefe(){
			return $this->FKEmple_Jefe;
		}
	}
?>