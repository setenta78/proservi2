<?

function rules(){
	
	$codFuncionario	= STRTOUPPER($_GET['codFuncionario']);
	
	$message = array();
	(isset($codFuncionario)===false||$codFuncionario==="") ? $message = $message + array("codFuncionario" => "Se requiere que indique el codigo del funcionario") : null;

	if(count($message)>0){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		header("HTTP/1.1 200 OK");
		return array("codFuncionario"	=> $codFuncionario);
	}
}
