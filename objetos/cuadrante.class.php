<?
Class cuadrante{	
	var $codigo;
	var $descripcion;
	var $abreviatura;
    var $descUni; //Variable a�adida el 21-04-2015

	function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	function setAbreviatura($abreviatura){
		$this->abreviatura = $abreviatura;
	}
	
	//Funcion a�adida el 21-04-2015
	function setDescUni($descUni){
		$this->descUni = $descUni;
	}
    
	function getCodigo(){
		return $this->codigo;
	}
	
	function getDescripcion(){
		return $this->descripcion;
	}
	
	function getAbreviatura(){
		return $this->abreviatura;
	}
    
	//Funcion a�adida el 21-04-2015
	function getDescUni(){
		return $this->descUni;
	}
	
}//end class   
?>