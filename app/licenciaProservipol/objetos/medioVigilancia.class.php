<?
Class medioVigilancia{	
	var $vehiculo;
	var $funcionarios = array();
	var $kmInicial;
	var $kmFinal;
	var $cuadrantes = array();
	var $factor;
	var $numeroMedio;
	var $unidades = array(); //Variable a�adida e�l 22-04-2015
	
			
	function setVehiculo($vehiculo){
		$this->vehiculo = $vehiculo;
	}
	
	function setFuncionarios($funcionario){
		$this->funcionarios[count($this->funcionarios)] = $funcionario;
	}	
	
	function setKmInicial($kmInicial){
		$this->kmInicial = $kmInicial;
	}
	
	function setKmFinal($kmFinal){
		$this->kmFinal = $kmFinal;
	}
	
	function setCuadrantes($cuadrante){
		$this->cuadrantes[count($this->cuadrantes)] = $cuadrante;
	}
	
	function setFactor($factor){
		$this->factor = $factor;
	}
	
	function setNumeroMedio($numeroMedio){
		$this->numeroMedio = $numeroMedio;
	}
	
	//Funcion a�adida el 22-04-2015
	function setUnidades($unidad){
	    $this->unidades[count($this->unidades)] = $unidad;
	}	
	
		
	function getVehiculo(){
		return $this->vehiculo;
	}
	
	function getFuncionarios($numero){
		return $this->funcionarios[$numero];
	}
	
	function getKmInicial(){
		return $this->kmInicial;
	}
	
	function getKmFinal(){
		return $this->kmFinal;
	}
	
	function getCuadrantes($numero){
		return $this->cuadrantes[$numero];
	}
	
	function getFactor(){
		return $this->factor;
	}
	
    //Funcion a�adida el 22-04-2015
	function getUnidades($numero){
	    return $this->unidades[$numero];
	}
    
	function getCantidadDeFuncionarios(){
		return count($this->funcionarios);
	}
	
	function getCantidadDeCuadrantes(){
		return count($this->cuadrantes);
	}
	
	function getNumeroMedio(){
		return $this->numeroMedio;
	}
    
	//Funcion a�adida el 22-04-2015
	function getCantidadDeUnidades(){
		return count($this->unidades);
	}


}//end class   
?>