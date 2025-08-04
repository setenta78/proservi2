<?

function rules(){
	
	$rut			= STRTOUPPER($_POST['rut']);
	$codFuncionario	= STRTOUPPER($_POST['textCodFuncionario']);
	$nombre1		= STRTOUPPER(utf8_decode($_POST['textNombre1']));
	$nombre2		= STRTOUPPER(utf8_decode($_POST['textNombre2']));
	$apellido1		= STRTOUPPER(utf8_decode($_POST['textApellido1']));
	$apellido2		= STRTOUPPER(utf8_decode($_POST['textApellido2']));
	$codGrado		= $_POST['codGrado'];
	$codEscalafon	= $_POST['codEscalafon'];
	$grado			= $_POST['textGrado'];
	$dotacion		= STRTOUPPER(utf8_decode($_POST['textDotacion']));
	$reparticionD	= STRTOUPPER(utf8_decode($_POST['textReparticionD']));
	$reparticionA	= STRTOUPPER(utf8_decode($_POST['textReparticionA']));
	//$numCelular		= $_POST['numeroCelular'];
	//$numIp			= $_POST['textIpNum'];
	$numCelular		= 0;
	$numIp			= 0;
	$email			= $_POST['textEmail'];
	$tipoCurso		= $_POST['tipoCurso'];
	$ip				= $_SERVER['REMOTE_ADDR'];
	
	$message = array();
	(isset($rut)===false||$rut==="") ? $message = $message + array("rut" => "Se requiere que indique el Rut del Funcionario") : null;
	(isset($codFuncionario)===false||$codFuncionario==="") ? $message = $message + array("codFuncionario" => "Se requiere que indique el Codigo del Funcionario") : null;
	(isset($nombre1)===false||$nombre1==="") ? $message = $message + array("nombre1" => "Se requiere que indique el Primer Nombre del Funcionario") : null;
	//(isset($nombre2)===false||$nombre2==="") ? $message = $message + array("nombre2" => "Se requiere que indique el Segundo Nombre del Funcionario") : null;
	(isset($apellido1)===false||$apellido1==="") ? $message = $message + array("apellido1" => "Se requiere que indique el Primer Apellido del Funcionario") : null;
	(isset($apellido2)===false||$apellido2==="") ? $message = $message + array("apellido2" => "Se requiere que indique el Segundo Apellido del Funcionario") : null;
	(isset($codGrado)===false||$codGrado==="") ? $message = $message + array("codGrado" => "Se requiere que indique el grado del Funcionario") : null;
	(isset($codEscalafon)===false||$codEscalafon==="") ? $message = $message + array("codEscalafon" => "Se requiere que indique el escalafon del Funcionario") : null;
	(isset($grado)===false||$grado==="") ? $message = $message + array("grado" => "Se requiere que indique el grado del Funcionario") : null;
	//(isset($dotacion)===false||$dotacion==="") ? $message = $message + array("dotacion" => "Se requiere que indique la dotacion del Funcionario") : null;
	//(isset($reparticionD)===false||$reparticionD==="") ? $message = $message + array("reparticionD" => "Se requiere que indique la reparticion dependiente del Funcionario") : null;
	//(isset($reparticionA)===false||$reparticionA==="") ? $message = $message + array("reparticionA" => "Se requiere que indique la alta reparticion del Funcionario") : null;
	//(isset($numCelular)===false||$numCelular==="") ? $message = $message + array("numCelular" => "Se requiere que indique el celular del Funcionario") : null;
	//(isset($numIp)===false||$numIp==="") ? $message = $message + array("numIp" => "Se requiere que indique el IP del Funcionario") : null;
	(isset($email)===false||$email==="") ? $message = $message + array("email" => "Se requiere que indique el email del Funcionario") : null;
	(isset($tipoCurso)===false||$tipoCurso==="") ? $message = $message + array("tipoCurso" => "Se requiere que indique el tipo de curso") : null;
	
	if(count($message)>0){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		header("HTTP/1.1 200 OK");
		return array("rut"				=> $rut,
		  	 		 "codFuncionario"	=> $codFuncionario,
				 	 "nombre1"			=> $nombre1,
					 "nombre2"			=> $nombre2,
					 "apellido1"		=> $apellido1,
					 "apellido2"		=> $apellido2,
					 "codGrado"			=> $codGrado,
					 "codEscalafon"		=> $codEscalafon,
					 "grado"			=> $grado,
					 "dotacion"			=> $dotacion,
					 "reparticionD"		=> $reparticionD,
					 "reparticionA"		=> $reparticionA,
					 "numCelular"		=> $numCelular,
					 "numIp"			=> $numIp,
					 "email"			=> $email,
					 "tipoCurso"		=> $tipoCurso,
					 "ip"				=> $ip
					 );
	}
}
