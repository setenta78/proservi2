<?

function rules(){
	
	$Email = $_GET['email'];
	
	$message = array();
	(isset($Email)===false||$Email==="") ? $message = $message + array("Email" => "Se requiere el Email") : null;
	
	if(count($message)>0){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		header("HTTP/1.1 200 OK");
		return array("Email" 	=> $Email);
	}
}
