<?
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
include_once("../tools.php");
include_once("../db/dbVehiculo.Class.php");
include_once("request.php");

$params = rules();
$objDBVehiculo= new dbVehiculo;
echo _json_encode(($params["code"]<>"412") ? $objDBVehiculo->listaEstadoVehiculosDINAOPERPOL($params['fecha']) : $params);
