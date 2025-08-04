<?

function rules(){
	
	$codigoCamara = $_GET['codigoCamara'];
	$codigoEquipo = $_GET['codigoEquipo'];
	
	$message = array();
	(isset($codigoCamara)===false||$codigoCamara==="") ? $message = $message + array("codigo Camara" => "Se requiere que indique el Codigo de la Camara") : null;
	(isset($codigoEquipo)===false||$codigoEquipo==="") ? $message = $message + array("codigo Equipo" => "Se requiere que indique el Codigo de Equipo") : null;
	
	if(count($message)==2){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		header("HTTP/1.1 200 OK");
		return array("codigoCamara"	=> $codigoCamara,
					 "codigoEquipo"	=> $codigoEquipo
				);
	}
}
