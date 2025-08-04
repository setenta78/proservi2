<?
Class unidad {	
    //Clase modificada el 16-04-2014
    //Atributos a�adidos: $contieneHijos, $unidadServicio
    //Funciones a�adidas: setContieneHijos(), setUnidadServicio(), getContieneHijos(), getUnidadServicio()
	var $codigoUnidad;
	var $padreUnidad;
	var $descripcionUnidad;
	var $tienePlanCuadrante;
	var $seleccionable;
	var $bloqueda;
	var $especialidad;
	var $tipo;
	var $contieneHijos; //Variable a�adida 16-04-2015 
	var $unidadServicio; //variable a�adida 16-04-2015
	var $UnidadTipo; //variable a�adida 17-06-2019
	
	var $cuadrantes	= array();
		
	function setCodigoUnidad($codigoUnidad){
		$this->codigoUnidad = $codigoUnidad;
	}
	
	function setPadreUnidad($padreUnidad){
		$this->padreUnidad = $padreUnidad;
	}
			
	function setDescripcionUnidad($descripcionUnidad){
		$this->descripcionUnidad = $descripcionUnidad;
	}
	
	function setTienePlanCuadrante($tienePlanCuadrante){
		$this->tienePlanCuadrante = $tienePlanCuadrante;
	}
		
	function setCuadrantes($cuadrante){
		$this->cuadrantes[count($this->cuadrantes)] = $cuadrante;
	}
	
	function setSeleccionable($seleccionable){
		$this->seleccionable = $seleccionable;
	}
	
	function setBloqueada($bloqueda){
		$this->bloqueda = $bloqueda;
	}
	
	function setEspecialidad($especialidad){
		$this->especialidad = $especialidad;
	}
	
	function setTipoUnidad($tipo){
		$this->tipo = $tipo;
	}
	
	//A�adida: 16-04-2015
	function setContieneHijos($contieneHijos){
		$this->contieneHijos = $contieneHijos;
	}
	//A�adida: 16-04-2015
	function setUnidadServicio($unidadServicio){
		$this->unidadServicio = $unidadServicio;
	}
	//A�adida: 17-06-2019
	function setUnidadTipo($UnidadTipo){
		$this->UnidadTipo = $UnidadTipo;
	}
	
	function getCodigoUnidad(){
		return $this->codigoUnidad;
	}
	
	function getPadreUnidad(){
		return $this->padreUnidad;
	}
	
	function getDescripcionUnidad(){
		return $this->descripcionUnidad;
	}
	
	function getTienePlanCuadrante(){
		return $this->tienePlanCuadrante;
	}
	
	function getCuadrantes($numero){
		return $this->cuadrantes[$numero];
	}
	
	function getCantidadCuadrantes(){
		return count($this->cuadrantes);
	}
	
	function getSeleccionable(){
		return $this->seleccionable;
	}
	
	function getBloqueada(){
		return $this->bloqueda;
	}
	
	function getEspecialidad(){
		return $this->especialidad;
	}
	
	function getTipoUnidad(){
		return $this->tipo;
	}
	
	//A�adida: 16-04-2015
	function getContieneHijos(){
		return $this->contieneHijos;
	}
	//A�adida: 16-04-2015
	function getUnidadServicio(){
		return $this->unidadServicio;
	}
	//A�adida: 17-06-2019
	function getUnidadTipo(){
		return $this->UnidadTipo;
	}
    
}//end class   
?>