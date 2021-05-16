<?php
	class Requerimiento 
	{
		var $IDREQ ;
		var $FKAREA ;
		var $TITULO ;
       
		function __construct($idreq, $fkarea, $titulo){
			$this->IDREQ=$idreq;
			$this->FKAREA=$fkarea;
			$this->TITULO=$titulo;
		}
        
		function setTITULO($titulo){
			$this->TITULO=$titulo;
		}

		function getTITULO(){
			return $this->TITULO;
		}

		function setIDREQ($idreq){
			$this->IDREQ=$idreq;
		}

		function getIDREQ(){
			return $this->IDREQ;
		}

		function setFKAREA($fkarea){
			$this->FKAREA=$fkarea;
		}

		function getFKAREA(){
			return $this->FKAREA;
		}
	}
?>