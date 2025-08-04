<?
//CONEXION A SELIME

$link=mysql_connect("168.88.130.19","proservipol","servipol");
mysql_select_db("SELIME",$link) or die ("Error: No es posible establecer la conexión");

$query = "UPDATE licencias_intermedias SET dias=8  WHERE serie='Q' AND folio='00003234'";

// Enviamos la consulta a MySQL
$queEmp = mysql_query($query, $link) or die(mysql_error());

// Mostramos los datos
//while ($resEmp = mysql_fetch_assoc($queEmp)) {
//   echo $a1=$resEmp['serie'];
//   echo $a2=$resEmp['folio'];
//   echo  $a3=$resEmp['rut'];

//}
// Cerramos la conexion
mysql_close($conexion);

?>
