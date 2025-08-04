<?
function rules(){
	
	$fecha = $_GET['fecha'];
	
	$message = array();
	(isset($fecha)===false||$fecha==="") ? $message = $message + array("fecha" => "Se requiere que indique fecha") : null;
		
	if(count($message)>0){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		return array("fecha"	=> $fecha);
	}
}
