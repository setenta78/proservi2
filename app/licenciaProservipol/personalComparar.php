<?include("session.php")?>
<?include("tiempo.php")?>
<?//include("perfil.php")?>
<?
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS']; //Variable de session a�adida el 17-04-2015
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programaci�n de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="./js/creaObjeto.js"></script>   
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/funcionariosComparar.js"></script>  
<script type="text/javascript" src="./js/usuario.js"></script>

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 		rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 		rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>

</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">

<body>
	<?include("header.php")?>
	<input type="hidden" value="<?echo $unidadBloqueada?>" name="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite"/>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">REVISI�N BASE DE DATOS PERSONAL DEPTO. P.7.</div>
		<div id="subtitulo">En esta lista se puede revisar las diferencias entre en el Personal Asignado a esta Unidad por <br>el Departamento Personal P.7. y el Personal Ingresado a Proservipol V3.</div>
		<div style="height:45px"></div>
	
		<table width="100%"><tr class="linea" ><td></td></tr></table>
		<div style="height:2px"></div>
		<div id="listado">
			<div id="cabeceraGrilla">
			<table cellspacing="1" cellpadding="1" width="100%">
		        <tr> 
		          <td id="nombreColumna" width="4%" align="center">No.</td>
		          <td id="colCodigo" class="nombreColumna" width="10%" align="center"><label id="labColCodigo">CODIGO</label></td>
		          <td id="colNombre" class="nombreColumna" width="28%" align="center"><label id="labColNombre">NOMBRE</label></td>
		          <td id="colGrado"  class="nombreColumna" width="20%" align="center"><label id="labColGrado">GRADO</label></td>
		          <td id="colCargo"  class="nombreColumna" width="38%" align="center"><label id="labColCargo">OBSERVACION</label></td>
		        </tr>
		     </table>
		    </div>
			<div id="listadoFuncionarios"></div>
		</div>
			<div style="height:2px"></div>
			<table width="100%"><tr class="linea"><td></td></tr></table>
		</div>
</body>
</html>
<?
	echo "<script>";
	echo "leeFuncionarios('".$unidadUsuario."');";
	//echo "leeFuncionarios('2355');";
	echo "</script>";
?>