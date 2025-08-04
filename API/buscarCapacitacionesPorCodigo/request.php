<?

function rules(){
	
	$codigoFuncionario	= $_GET['codigoFuncionario'];
	
	$message = array();
	
	(isset($codigoFuncionario)===false||$codigoFuncionario==="") ? $message = $message + array("codigoFuncionario" => "Se requiere que indique el Codigo del Funcionario") : null;
	
	if(count($message)>0){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		header("HTTP/1.1 200 OK");
		return array("codigoFuncionario" => $codigoFuncionario);
	}
}
