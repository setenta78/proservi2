<?

error_reporting(0);
ini_set('display_errors', '1');

include_once("../tools.php");
include_once("../db/dbVehiculoProservipolHistorico_2019_2021.Class.php");
include_once("request.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=UTF-8');

$params = rules();
$objDBVehiculoProservipolHistorico_2019_2021 = new dbVehiculoProservipolHistorico_2019_2021;

echo _json_encode(($params["code"]<>"412") ? $objDBVehiculoProservipolHistorico_2019_2021->serviciosVehiculooPorCodigoDeVehiculo_2019_2021($params['codigoVehiculo'], $params['fechaDesde'], $params['fechaHasta']) : $params);

//echo _json_encode($objDBFuncionarioProservipolHistorico->serviciosFuncionarioPorCodigo_2019_2021($params['codigoFuncionario'], $params['fechaDesde'], $params['fechaHasta']) : $params);


?>