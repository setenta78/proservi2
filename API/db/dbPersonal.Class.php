<?
include_once("../inc/configPersonal.inc.php");
include_once("conexion.Class.php");

Class dbPersonal extends Conexion{
	
	function buscarFuncionario($codFuncionario){
		
		$sql = "SELECT 
				  P.PEFBNOM1,
				  P.PEFBNOM2,
				  REPLACE(P.PEFBAPEP,\"'\",'') PEFBAPEP,
				  P.PEFBAPEM,
				  P.PEFBRUT,
				  E.ESCALAFON_CODIGO,
				  E.GRADO_CODIGO,
				  E.GRADO_DESCRIPCION,
				  R0.REPARTICION_DESCRIPCION R0,
				  IF(ISNULL(R1.REPARTICION_DESCRIPCION),'',R1.REPARTICION_DESCRIPCION) R1,
				  IF(ISNULL(R2.REPARTICION_DESCRIPCION),'',R2.REPARTICION_DESCRIPCION) R2,
				  IF(ISNULL(R3.REPARTICION_DESCRIPCION),'',R3.REPARTICION_DESCRIPCION) R3,
				  IF(ISNULL(R4.REPARTICION_DESCRIPCION),'',R4.REPARTICION_DESCRIPCION) R4
				FROM pesbasi P
				JOIN tescalafongrado E ON (E.ESCALAFON_CODIGO = P.PEFBESC AND E.GRADO_CODIGO = P.PEFBGRA)
				LEFT JOIN treparticion R0 ON (P.PEFBREP = R0.REPARTICION_CODIGO)
				LEFT JOIN treparticion R1 ON (CONCAT(LEFT(P.PEFBREP, 4),'00000000') = R1.REPARTICION_CODIGO)
				LEFT JOIN treparticion R2 ON (CONCAT(LEFT(P.PEFBREP, 3),'000000000') = R2.REPARTICION_CODIGO)
				LEFT JOIN treparticion R3 ON (CONCAT(LEFT(P.PEFBREP, 2),'0000000000') = R3.REPARTICION_CODIGO)
				LEFT JOIN treparticion R4 ON (CONCAT(LEFT(P.PEFBREP, 1),'00000000000') = R4.REPARTICION_CODIGO)
				WHERE P.PEFBCOD = '{$codFuncionario}'
				AND P.PEFBACT IN (0,29,32)
				AND E.TIPO NOT IN (5)";
		
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		$listaServicios = array();
		$sinServicio = true;
		while($myrow = mysql_fetch_array($result)){
			array_push($listaServicios, array(
			"rut"						=> utf8_encode($myrow["PEFBRUT"]),
			"primerNombre" 				=> utf8_encode($myrow["PEFBNOM1"]),
			"segundoNombre"				=> utf8_encode($myrow["PEFBNOM2"]),
			"apellidoPaterno"			=> utf8_encode($myrow["PEFBAPEP"]),
			"apellidoMaterno"			=> utf8_encode($myrow["PEFBAPEM"]),
			"codEscalafon"				=> utf8_encode($myrow["ESCALAFON_CODIGO"]),
			"codGrado"					=> utf8_encode($myrow["GRADO_CODIGO"]),
			"grado"						=> utf8_encode($myrow["GRADO_DESCRIPCION"]),
			"dotacion"					=> utf8_encode($myrow["R0"]),
			"reparticionDependiente"	=> utf8_encode($myrow["R2"]),
			"altaReparticion"			=> utf8_encode($myrow["R4"])
			));
			if($myrow["EXISTE"]<>true) $sinServicio = false;
		}
		return $sinServicio ? array("data" => false) : array("data" => $listaServicios);
	}
	
	function buscarEscalafonesFaltantes($Jdata){
		
		$data = json_decode($Jdata);
		$lista = implode(",", $data);
		return $lista;
		
		$sql = "SELECT E.ESCALAFON_CODIGO
				FROM tescalafongrado E
				WHERE E.ESCALAFON_CODIGO IN ({$lista})";
		
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		$listaServicios = array();
		$sinServicio = true;
		while($myrow = mysql_fetch_array($result)){
			array_push($listaServicios, array(
				"ESCALAFON_CODIGO"		=> utf8_encode($myrow["ESCALAFON_CODIGO"])
			));
			if($myrow["EXISTE"]<>true) $sinServicio = false;
		}
		return $sinServicio ? array("data" => false) : array("data" => $listaServicios);
	}
}
