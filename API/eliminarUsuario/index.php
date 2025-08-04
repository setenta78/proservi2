<?
include_once("../tools.php");
include_once("../db/dbUsuario.Class.php");
include_once("request.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

$params = rules();
$objDBUsuario = new dbUsuario;

echo _json_encode(($params["code"]<>"412") ? $objDBUsuario->eliminaUsuario($params) : $params);
