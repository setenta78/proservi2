<?

include_once("../tools.php");
include_once("../db/dbFuncionario.Class.php");
include_once("request.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=UTF-8');

$params = rules();
$objDBFuncionario = new dbFuncionario;

echo _json_encode(($params["code"]<>"412") ? $objDBFuncionario->cargosFuncionarioPorCodigo($params['codigoFuncionario'], $params['fechaDesde'], $params['fechaHasta']) : $params);