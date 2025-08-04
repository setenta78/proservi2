<?

function rules(){
	
	$codUnidad = $_GET['codUnidad'];
	$descUnidad = $_GET['descUnidad'];
	$captura = $_GET['captura'];
	
	header("HTTP/1.1 200 OK");
	return array("codUnidad" 	=> $codUnidad,
				 "descUnidad"	=> $descUnidad,
				 "captura"		=> $captura);
}
