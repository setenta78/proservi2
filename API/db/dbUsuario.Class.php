<?
include_once("../inc/config.inc.php");
include_once("conexion.Class.php");

Class dbUsuario extends Conexion{
	
	function crearUsuario($data){
		
		$sql = "INSERT INTO USUARIO (FUN_CODIGO, UNI_CODIGO, US_LOGIN, US_PASSWORD, TUS_CODIGO, US_FECHACREACION)
				VALUES ('{$data['codFuncionario']}',{$data['codigoUnidad']},'{$data['codFuncionario']}','{$data['password']}',{$data['tipoUsuario']},CURDATE())";
		
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		return array("data" => $result);
	}
	
	function eliminaUsuario($data){
		
		$sql = "DELETE FROM USUARIO
				WHERE USUARIO.FUN_CODIGO = '{$data['codFuncionario']}'";
		
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		return array("data" => $result);
	}
	
	function modificaUsuario($data){
		
		$sql = "UPDATE USUARIO
				SET TUS_CODIGO = {$data['tipoUsuario']},
					UNI_CODIGO = {$data['codigoUnidad']},
					US_PASSWORD = '{$data['password']}'
				WHERE USUARIO.FUN_CODIGO = '{$data['codFuncionario']}'";
		
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		return array("data" => $result);
	}
	
	function buscarUsuario($data){
		
		$sql = "SELECT
					F.FUN_RUT FUN_RUT,
					F.FUN_CODIGO FUN_CODIGO,
					G.GRA_DESCRIPCION GRADO_DESC,
					CONCAT(F.FUN_APELLIDOPATERNO,' ',F.FUN_APELLIDOMATERNO) FUN_APELLIDO,
					F.FUN_NOMBRE FUN_NOMBRE,
					IFNULL(DU.UNI_CODIGO, DF.UNI_CODIGO) UNIDAD_COD,
					IFNULL(DU.UNI_PADRE, IFNULL(DF.UNI_PADRE,20)) UNIDAD_PADRE,
					IF(DU.UNI_CODIGO=20,'NACIONAL',IFNULL(DU.UNI_DESCRIPCION, DF.UNI_DESCRIPCION)) UNIDAD_DESC,
					IFNULL(IFNULL(DU.UNI_CAPTURA, DF.UNI_CAPTURA),0) CAPTURA,
					IFNULL(U.TUS_CODIGO,0) TIPO_USUARIO_COD,
					IFNULL(T.TUS_DESCRIPCION,'') TIPO_USUARIO_DESC,
					IFNULL(U.US_PASSWORD,LEFT(F.FUN_CODIGO,4)) PASSWORD,
					IFNULL(DF.UNI_CODIGO,1) UNIDAD_ORIGEN,
					IFNULL(DF.UNI_DESCRIPCION,'SIN PROSERVIPOL') UNIDAD_DESC_ORIGEN
				FROM FUNCIONARIO F
				JOIN GRADO G ON F.ESC_CODIGO = G.ESC_CODIGO AND F.GRA_CODIGO = G.GRA_CODIGO
				LEFT JOIN CARGO_FUNCIONARIO C ON C.FUN_CODIGO = F.FUN_CODIGO AND C.FECHA_HASTA IS NULL
				LEFT JOIN USUARIO U ON U.FUN_CODIGO = F.FUN_CODIGO
				LEFT JOIN TIPO_USUARIO T ON T.TUS_CODIGO = U.TUS_CODIGO
				LEFT JOIN UNIDAD DU ON DU.UNI_CODIGO = U.UNI_CODIGO
				LEFT JOIN UNIDAD DF ON DF.UNI_CODIGO = IF(C.UNI_AGREGADO, C.UNI_AGREGADO, F.UNI_CODIGO)
				WHERE F.FUN_CODIGO = '{$data['codFuncionario']}'";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		$datosUsuario	= array();
		$sinUsuario = true;
		while($myrow = mysql_fetch_array($result)){
			array_push($datosUsuario, array(
				"rutFuncionario"			=> $myrow["FUN_RUT"],
				"codigoFuncionario"			=> $myrow["FUN_CODIGO"],
				"password"					=> utf8_encode($myrow["PASSWORD"]),
				"descripcionGrado"			=> utf8_encode($myrow["GRADO_DESC"]),
				"apellidoFuncionario"		=> utf8_encode($myrow["FUN_APELLIDO"]),
				"nombreFuncionario"			=> utf8_encode($myrow["FUN_NOMBRE"]),
				"codigoUnidad"				=> $myrow["UNIDAD_COD"],
				"codigoPadre"				=> $myrow["UNIDAD_PADRE"],
				"descripcionUnidad"			=> utf8_encode($myrow["UNIDAD_DESC"]),
				"captura"					=> $myrow["CAPTURA"],
				"tipoUsuarioCodigo"			=> $myrow["TIPO_USUARIO_COD"],
				"tipoUsuarioDescripcion"	=> utf8_encode($myrow["TIPO_USUARIO_DESC"]),
				"unidadOrigen"				=> $myrow["UNIDAD_ORIGEN"],
				"unidadOrigenDescripcion"	=> utf8_encode($myrow["UNIDAD_DESC_ORIGEN"])
			));
			if($myrow["EXISTE"]<>true) $sinUsuario = false;
		}
		return $sinUsuario ? array("data" => false) : array("data" => $datosUsuario);
	}
	
}
