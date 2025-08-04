<?

include_once("../inc/configProservipolHistorico_2014_2018.inc.php");
include_once("conexionDBProservipolHistorico.Class.php");

Class dbFuncionarioProservipolHistorico_2014_2018 extends ConexionDBProservipolHistorico{
	
	function serviciosFuncionarioPorCodigo_2014_2018($codigoFuncionario, $fechaDesde, $fechaHasta){
		
		$sql = "SELECT 
					FUNCIONARIO.FUN_APELLIDOPATERNO,
					FUNCIONARIO.FUN_APELLIDOMATERNO,
					FUNCIONARIO.FUN_NOMBRE,
					FUNCIONARIO.FUN_NOMBRE2,
					GRADO.GRA_DESCRIPCION,
					FUNCIONARIO.FUN_CODIGO,
					SERVICIO.FECHA,
					UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) TIPOSERVICIO,
					SERVICIO.HORA_INICIO,
					SERVICIO.HORA_TERMINO,
					UNIDAD.UNI_DESCRIPCION DESTACAMENTO
				FROM SERVICIO 
				INNER JOIN FUNCIONARIO_SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO AND FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				INNER JOIN FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = FUNCIONARIO_SERVICIO.FUN_CODIGO)
				INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)	AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				INNER JOIN TIPO_SERVICIO ON (TIPO_SERVICIO.TSERV_CODIGO = SERVICIO.TSERV_CODIGO)
				INNER JOIN UNIDAD ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
				WHERE FUNCIONARIO.FUN_CODIGO = '{$codigoFuncionario}' AND SERVICIO.FECHA BETWEEN '{$fechaDesde}' AND '{$fechaHasta}'
				ORDER BY SERVICIO.FECHA";

		//echo "fhcvh" .$sql;

		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		
		$fecha_actual = date("d-m-Y H:i:s"); 

		$listaServicios = array();
		$sinServicio 	= true;

		while($myrow = mysqli_fetch_array($result)){

			array_push($listaServicios, array(
				"nombreCompletoFuncionario"	=> $myrow["FUN_APELLIDOPATERNO"] . " " . $myrow["FUN_APELLIDOMATERNO"] . ", " .  $myrow["FUN_NOMBRE"] . " " . $myrow["FUN_NOMBRE2"],
				"gradoFuncionario" 			=> $myrow["GRA_DESCRIPCION"],
				"codigoFuncionario"			=> $myrow["FUN_CODIGO"],
				"fecha" 					=> $myrow["FECHA"], //date('d-m-Y', strtotime($myrow["FECHA"])), 
				"tipoServicio" 				=> $myrow["TIPOSERVICIO"],
				"horaInicio" 				=> $myrow["HORA_INICIO"],
				"horaTermino" 				=> $myrow["HORA_TERMINO"],
				"destacamento" 				=> $myrow["DESTACAMENTO"],
				"fechaHoraConsulta"			=> $fecha_actual
			));
			//if($myrow["EXISTE"]<>true) $sinServicio = false;
		}
		//return $sinServicio ? array("data" => false) : array("data" => $listaServicios);

		return array("data" => $listaServicios);
	}


	


}

?>