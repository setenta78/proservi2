<?
include_once("../inc/configProservipolHistorico_2014_2018.inc.php");
include_once("conexionDBProservipolHistorico.Class.php");

Class dbVehiculoProservipolHistorico_2014_2018 extends ConexionDBProservipolHistorico{
	
	function serviciosVehiculooPorCodigoDeVehiculo_2014_2018($codigoVehiculo, $fechaDesde, $fechaHasta){
		
		$sql = "SELECT DISTINCT
					VEHICULO.VEH_CODIGO,
					/*VEHICULO.VEH_COD_EQUIPO_SAP,*/
					TIPO_VEHICULO.TVEH_DESCRIPCION,
					MARCA_VEHICULO.MVEH_DESCRIPCION,
					MODELO_VEHICULO.MODVEH_DESCRIPCION,
					VEHICULO.VEH_PATENTE,
					SERVICIO.FECHA,
					UPPER(TIPO_SERVICIO.TSERV_DESCRIPCION) AS  TIPO_SERVICIO,
					SERVICIO.HORA_INICIO,
					SERVICIO.HORA_TERMINO,
					VEHICULO_SERVICIO.KM_INICIAL,
					VEHICULO_SERVICIO.KM_FINAL,
					UNIDAD.UNI_DESCRIPCION
				FROM
				UNIDAD
				INNER JOIN SERVICIO ON (UNIDAD.UNI_CODIGO = SERVICIO.UNI_CODIGO)
				INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
				AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
				INNER JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
				AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
				AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
				INNER JOIN VEHICULO_SERVICIO ON (FUNCIONARIO_VEHICULO.VEH_UNI_CODIGO = VEHICULO_SERVICIO.UNI_CODIGO)
				AND (FUNCIONARIO_VEHICULO.VEH_CORRELATIVO_SERVICIO = VEHICULO_SERVICIO.CORRELATIVO_SERVICIO)
				AND (FUNCIONARIO_VEHICULO.VEH_CODIGO = VEHICULO_SERVICIO.VEH_CODIGO)
				INNER JOIN VEHICULO ON (VEHICULO_SERVICIO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
				INNER JOIN TIPO_VEHICULO ON (VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO)
				INNER JOIN MARCA_VEHICULO ON (VEHICULO.MVEH_CODIGO = MARCA_VEHICULO.MVEH_CODIGO)
				INNER JOIN MODELO_VEHICULO ON (VEHICULO.MODVEH_CODIGO = MODELO_VEHICULO.MODVEH_CODIGO)
				LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
				WHERE VEHICULO.VEH_CODIGO = '{$codigoVehiculo}' AND SERVICIO.FECHA BETWEEN '{$fechaDesde}' AND '{$fechaHasta}'
				ORDER BY SERVICIO.FECHA, SERVICIO.HORA_INICIO";

		//echo "fhcvh" .$sql;

		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		
		$fecha_actual = date("d-m-Y H:i:s"); 

		$listaServicios = array();
		$sinServicio 	= true;

		while($myrow = mysqli_fetch_array($result)){

			array_push($listaServicios, array(
				"codigoVehiculo"		=> $myrow["VEH_CODIGO"],
				"codigoEquipoSAP" 		=> "",
				"tipoVehiculo"			=> $myrow["TVEH_DESCRIPCION"],
				"marcaVehiculo" 		=> $myrow["MVEH_DESCRIPCION"], //date('d-m-Y', strtotime($myrow["FECHA"])), 
				"modeloVehiculo" 		=> $myrow["MODVEH_DESCRIPCION"],
				"pantenteVehiculo"		=> $myrow["VEH_PATENTE"],
				"fechaServicio"			=> $myrow["FECHA"],
				"servicio"				=> $myrow["TIPO_SERVICIO"],
				"horaInicio" 			=> $myrow["HORA_INICIO"],
				"horaTermino" 			=> $myrow["HORA_TERMINO"],
				"kmInicial" 			=> $myrow["KM_INICIAL"],
				"kmFinal" 				=> $myrow["KM_FINAL"],
				"destacamento" 			=> $myrow["UNI_DESCRIPCION"],
				"fechaHoraConsulta"		=> $fecha_actual
			));
			//if($myrow["EXISTE"]<>true) $sinServicio = false;
		}
		//return $sinServicio ? array("data" => false) : array("data" => $listaServicios);

		return array("data" => $listaServicios);
	}

}
?>