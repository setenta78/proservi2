<?php
require_once("class/class.php");
	
date_default_timezone_set('America/Santiago');  

//require_once("solicitudesDesarrollo/js/valida.php");

//Incluimos el archivo con la función o simplemente pegamos la función
//require('fechaTexto.php');
if (isset($_SESSION["session_video_14"])) {
	$codigo = $_SESSION["session_video_14"];
	$grado  = $_SESSION["session_video_15"];
	$nombre = $_SESSION["session_video_16"];

	$tipo = $_SESSION["session_video_17"];

	$datos  = "(" . $grado . ")" . " - " . $nombre;
	//echo $codigo." ".$user." ".$descripcion

  
	$miFechax = date('d-m-Y h:i:s a', time());  
//	echo "The current date and time in Toronto are $miFecha.";
?>
	<style>

	</style>
	<html>

	<head>
		<title>APLICATIVOS</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/estilos.css" type="text/css" />
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>

	<body>
	<?php include 'header.php';?>
		<div class="texto3">
			<?php
			$fecha = date("d/m/Y");
			echo "<table border='0'>";
			echo "<tr>";
			echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
			echo "</table>";
			echo "<b>" . " &nbsp;&nbsp;&nbsp;Bienvenid@" . "</b>" . ": " . $datos;
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp; SALIR <a href='salir.php'><img src='img/cerrar.png' border='0'  width='30' align='middle' alt='Salir'/></a>";
			echo "<br>";
			?>
		</div>
		<br>
		<br>


		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<table width="55%" border="0" align="center">
			<tr align="center">
				<td colspan='4'>
					<h3>APLICATIVOS GESTIÓN MESA DE AYUDA</h3>
				</td>
			</tr>
			<tr>
				<td colspan='4'><?php echo "<center><b> Fecha y Hora actual:&nbsp;</b>" . $miFechax . "</center>"; //fechaTexto($miFechax) ?><br><br></td> 
			</tr>
			<tr align="center">
				<td width="25%"><a href='http://proservipol.carabineros.cl/app/vehiculos/'><img src='img/auto.png' alt='Vehiculos' width="80" border='0' align='middle' /></a></td>
				<td width="24%"><a href='cambiofechas/modulos.php'><img src='img/calendar.png' border='0' align='middle' alt='Fechas' /></a></td>
				<td width="24%"><a href='mLicencias/licencias.php'><img src='img/salud.png' border='0' align='middle' alt='Licencias' /></a></td>
				<td width="27%"><a href='mPermisos/permisos.php'><img src='img/permiso.png' border='0' align='middle' alt='Permisos' /></a></td>
			</tr>
			<tr align="center">
				<td height="33"><strong>INGRESO VEHICULOS</strong> <label style="color:#F00; font-size:10px; font-weight:bold;"> </label></td>
				<td><strong>CAMBIO FECHA</strong></td>
				<td><strong>LICENCIAS MÉDICAS</strong></td>
				<td><strong>PERMISOS</strong></td>
			</tr>
			<tr align="center">
				<td><a href='desvalidador/desvalidar.php'><img src='img/desvalidar.png' border='0' align='middle' alt='Desvalidador' /></a></td>
				<td><a href='reintegrados/reintegrar.php'><img src='img/police.png' border='0' align='middle' alt='Reintegrados' /></a></td>
				<td><a href='movimientos/movimiento.php'><img src='img/traslado.png' border='0' align='middle' alt='Movimientos' /></a></td>
				<td><a href='servicios/servicios.php'><img src='img/pro3.fw.png' border='0' align='middle' alt='Servicios' /></a></td>
			</tr>
			<tr>
			<tr align="center">
				<td height="38"><strong>DESVALIDADOR</strong></td>
				<td><strong>REINTEGRADOS</strong></td>
				<td><strong>MOVIMIENTOS</strong></td>
				<td><strong>LISTADO SERVICIOS </strong></td>
			</tr>
			<tr align="center">
				<td><a href='http://proservipol.carabineros.cl/app/armas/'><img src='img/armas.png' alt='Ingresar Armamento' width="80" height="80" border='0' align='middle' /></a></td>
				<td><a href='http://proservipol.carabineros.cl/app/animales/'><img src='img/perro.jpg' alt='Ingresar animales' width="80" height="52" border='0' align='middle' /></a></td>
				<td><a href="http://proservipol.carabineros.cl/app/solicitudesDesarrollo/valida.php?textUsuario=<?php echo $_SESSION["USER"] ?>&textClave=<?php echo $_SESSION["PASS"] ?>" target="_blank"><img src='img/solicitudes.png' alt='Movimientos' width="72" height="70" border='0' align='middle' /></a></td>
				<td>&nbsp;</td>
			</tr>
			<tr align="center">
				<td><strong>INGRESO ARMAS <label style="color:#F00; font-size:10px; font-weight:bold;"> </label></strong></td>
				<td><strong>INGRESO ANIMALES<label style="color:#F00; font-size:10px; font-weight:bold;"> </label></strong></td>
				<td><strong>SOLICITUDES</strong></td>
				<td>&nbsp;</td>
			</tr>
		</table>
        <br><br>
        <?php include 'footer.php';?>
	</body>

	</html>
<?php
} else {
	echo "
	<script type='text/javascript'>
	alert('DEBE INICIAR SESI\u00D3N PARA ACCEDER A ESTE CONTENIDO');
	window.location='index.php';
	</script>
	";
}
?>