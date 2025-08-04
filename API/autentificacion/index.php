<?
include("../db/dbUsuario.Class.php");

$user			= $_GET['user'];
$password	= $_GET['pass'];

$objDBUsuario = new dbUsuario;
$data = json_encode(array("data" => $objDBUsuario->autentificacion($user, $password)));

echo $data;
