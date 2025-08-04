<?

function rules(){
	
	$RutFuncionario 	= $_GET['RutFuncionario'];
	$fechaDesde			= $_GET['fechaDesde'];
	$fechaHasta			= $_GET['fechaHasta'];
	
	$message = array();
	
	(isset($RutFuncionario)===false||$RutFuncionario==="") ? $message = $message + array("RutFuncionario" => "Se requiere que indique el Rut del Funcionario") : null;
	(isset($fechaDesde)===false||$fechaDesde==="") ? $message = $message + array("fechaDesde" => "Se requiere que indique la fecha desde") : null;
	(isset($fechaHasta)===false||$fechaHasta==="") ? $message = $message + array("fechaHasta" => "Se requiere que indique la fecha hasta") : null;
	
	($fechaDesde > $fechaHasta) ? $message = $message + array("fecha" => "La fecha Desde no puede ser mayor a la fecha Hasta") : null;
	
	if(count($message)>0){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		header("HTTP/1.1 200 OK");
		return array("RutFuncionario" 	=> $RutFuncionario,
		  	 		 "fechaDesde"			=> $fechaDesde,
				 	 "fechaHasta"			=> $fechaHasta);
	}
}
