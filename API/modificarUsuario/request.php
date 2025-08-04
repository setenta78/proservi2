<?

function rules(){
	
	$codFuncionario	= STRTOUPPER($_GET['codFuncionario']);
	$codigoUnidad	= $_GET['codigoUnidad'];
	$tipoUsuario	= $_GET['tipoUsuario'];
	$password		= $_GET['password'];
	
	$message = array();
	(isset($codFuncionario)===false||$codFuncionario==="") ? $message = $message + array("codFuncionario" => "Se requiere que indique el codigo del funcionario") : null;
	(isset($codigoUnidad)===false||$codigoUnidad==="") ? $message = $message + array("codigoUnidad" => "Se requiere que indique codigo de la unidad") : null;
	(isset($tipoUsuario)===false||$tipoUsuario==="") ? $message = $message + array("tipoUsuario" => "Se requiere que indique el tipo de usuario") : null;
	(isset($password)===false||$password==="") ? $message = $message + array("password" => "Se requiere que indique la contraseña del usuario") : null;
	
	if(count($message)>0){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		header("HTTP/1.1 200 OK");
		return array("codFuncionario"	=> $codFuncionario,
					 "codigoUnidad"		=> $codigoUnidad,
					 "tipoUsuario"		=> $tipoUsuario,
					 "password"			=> $password
					 );
	}
}
