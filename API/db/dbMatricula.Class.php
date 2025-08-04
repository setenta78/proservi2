<?
include_once("../inc/config.inc.php");
include_once("conexion.Class.php");

Class dbMatricula extends Conexion{
	
	function registrarMatricula($matricula){
		
		$sql = "INSERT INTO MATRICULA_FUNCIONARIO 
				(RUT,
				FUN_CODIGO,
				PRIMER_NOMBRE,
				SEGUNDO_NOMBRE,
				APELLIDO_PATERNO,
				APELLIDO_MATERNO,
				ESC_CODIGO,
				GRA_CODIGO,
				GRADO,
				DOTACION,
				REPARTICION_DEPENDIENTE,
				ALTA_REPARTICION,
				NUMERO_CELULAR,
				NUMERO_IP,
				EMAIL,
				TIPO_CURSO,
				ACTIVO,
				IP) VALUES 
				('{$matricula['rut']}',
				'{$matricula['codFuncionario']}',
				'{$matricula['nombre1']}',
				'{$matricula['nombre2']}',
				'{$matricula['apellido1']}',
				'{$matricula['apellido2']}',
				 {$matricula['codEscalafon']},
				 {$matricula['codGrado']},
				'{$matricula['grado']}',
				'{$matricula['dotacion']}',
				'{$matricula['reparticionD']}',
				'{$matricula['reparticionA']}',
				 {$matricula['numCelular']},
				 {$matricula['numIp']},
				'{$matricula['email']}',
				'{$matricula['tipoCurso']}',
				1,
				'{$matricula['ip']}')";
				
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		return array("data" => $result);
	}
	
	function buscarFuncionarioMatricula($matricula){
		$sql = "SELECT FUN_CODIGO
				FROM MATRICULA_FUNCIONARIO
				WHERE FUN_CODIGO = '{$matricula['codFuncionario']}'
				AND ACTIVO = 1";
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			return array("data" => true);
		}
		return array("data" => false);
	}
	
	function buscarFuncionarioAprobado($matricula){
		$sql = "SELECT FUN_CODIGO
				FROM MATRICULA_FUNCIONARIO
				WHERE FUN_CODIGO = '{$matricula['codFuncionario']}'
				AND ACTIVO = 2";
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			return array("data" => true);
		}
		return array("data" => false);
	}
	
	function buscarFuncionarioEmail($matricula){
		$sql = "SELECT EMAIL
				FROM MATRICULA_FUNCIONARIO
				WHERE EMAIL = '{$matricula['Email']}'
				AND ACTIVO = 1";
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			return array("data" => true);
		}
		return array("data" => false);
	}
	
	function listarMatriculados(){
		$sql = "SELECT
					RUT,
					FUN_CODIGO,
					PRIMER_NOMBRE,
					SEGUNDO_NOMBRE,
					APELLIDO_PATERNO,
					APELLIDO_MATERNO,
					ESC_CODIGO,
					GRA_CODIGO,
					GRADO,
					DOTACION,
					REPARTICION_DEPENDIENTE,
					ALTA_REPARTICION,
					NUMERO_CELULAR,
					NUMERO_IP,
					EMAIL,
					IP,
					FECHA,
					TIPO_CURSO
				FROM MATRICULA_FUNCIONARIO
				WHERE ACTIVO = 1";
		
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		$listaMatriculas = array();
		while($myrow = mysql_fetch_array($result)){
			array_push($listaMatriculas, array(
					"Rut"						=> $myrow["RUT"],
					"Codigo Funcionario"		=> $myrow["FUN_CODIGO"],
					"Primer Nombre"				=> utf8_encode($myrow["PRIMER_NOMBRE"]),
					"Segundo Nombre"			=> utf8_encode($myrow["SEGUNDO_NOMBRE"]),
					"Apellido Paterno"			=> utf8_encode($myrow["APELLIDO_PATERNO"]),
					"Apellido Materno"			=> utf8_encode($myrow["APELLIDO_MATERNO"]),
					"Grado"						=> $myrow["GRADO"],
					"Dotacion"					=> utf8_encode($myrow["DOTACION"]),
					"Reparticion Dependiente"	=> $myrow["REPARTICION_DEPENDIENTE"],
					"Alta Reparticion"			=> $myrow["ALTA_REPARTICION"],
					"Numero Celular"			=> $myrow["NUMERO_CELULAR"],
					"Numero Ip"					=> $myrow["NUMERO_IP"],
					"Email"						=> $myrow["EMAIL"],
					"Ip"						=> $myrow["IP"],
					"Fecha"						=> $myrow["FECHA"],
					"tipoCurso"					=> $myrow["TIPO_CURSO"]
			));
			if($myrow["EXISTE"]<>true) $sinServicio = false;
		}
		return $sinServicio ? array("data" => false) : array("data" => $listaMatriculas);
	}
	
	function cantidadMatriculados(){
		$sql = "SELECT COUNT(1) CANTIDAD
				FROM MATRICULA_FUNCIONARIO
				WHERE ACTIVO = 1";
		$result = $this->execute($this->conect(),$sql);
		mysql_close();
		$cantidad = 0;
		$myrow = mysql_fetch_array($result);
		$cantidad = $myrow["CANTIDAD"];
		return $cantidad;
	}
	
}
