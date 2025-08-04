<?

function rules(){
	
	$codigoUnidad	= $_GET['codigoUnidad'];
	$nrSerie		= $_GET['nrSerie'];
	$columna		= $_GET['columna'];
	$ordenar		= $_GET['ordernar'];
	
	$message = array();
	
	(isset($codigoUnidad)===false||$codigoUnidad==="") ? $message = $message + array("codigoUnidad" => "Se requiere que indique el Codigo de Unidad") : null;
	if(isset($columna)===false||$columna==="") $columna = "COD_EQUIPO";
	if(isset($ordenar)===false||$ordenar==="") $ordenar = "ASC";
	
	if(count($message)>0){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		header("HTTP/1.1 200 OK");
		return array("codigoUnidad"		=> $codigoUnidad,
					 "columna"			=>$columna,
					 "ordenar"			=>$ordenar,
					 "nrSerie"			=>$nrSerie);
	}
}
