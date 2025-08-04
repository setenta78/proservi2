<?php
require('config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$link) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}



// Verificar archivo
$archivotmp = $_FILES['dataCamara']['tmp_name'];
$tipo       = $_FILES['dataCamara']['type'];
$tamanio    = $_FILES['dataCamara']['size'];

if (empty($archivotmp) || $tipo !== 'text/csv') {
    die("No se ha subido ningún archivo válido");
}

// Inicialización de variables
$updateData = [];
$insertData = [];
$mvcMap = [];
$modvcMap = [];
// Variables para contar registros y almacenar errores
$contadorInsertCamaras = 0;
$contadorUpdateCamaras = 0;
$contadorInsertMarcas = 0;
$contadorInsertModelos = 0;
$errorMessages = [];

// Cargar datos de las tablas MARCA_VIDEOCAMARA y MODELO_VIDEOCAMARA
function cargarDatosExistentes($link, &$mvcMap, &$modvcMap)
{
    $resultMarca = $link->query("SELECT MVC_CODIGO, MVC_DESCRIPCION FROM MARCA_VIDEOCAMARA");
    while ($row = $resultMarca->fetch_assoc()) {
        $mvcMap[$row['MVC_DESCRIPCION']] = $row['MVC_CODIGO'];
    }

    $resultModelo = $link->query("SELECT MODVC_CODIGO, MODVC_DESCRIPCION FROM MODELO_VIDEOCAMARA");
    while ($row = $resultModelo->fetch_assoc()) {
        $modvcMap[$row['MODVC_DESCRIPCION']] = $row['MODVC_CODIGO'];
    }
}

// Inserción de marcas y modelos
function insertarMarcaModelo($link, $descripcion, &$map, $tabla, $campoCodigo, $campoDescripcion)
{
    $nuevoCodigo = !empty($map) ? max($map) + 10 : 10; // Evitar errores si $map está vacío
    $sqlInsert = $link->prepare("INSERT INTO $tabla ($campoCodigo, $campoDescripcion) VALUES (?, ?)");
    $sqlInsert->bind_param('is', $nuevoCodigo, $descripcion);

    if ($sqlInsert->execute()) {
        $map[$descripcion] = $nuevoCodigo;
        return $nuevoCodigo;
    } else {
        global $errorMessages;
        $errorMessages[] = "Error al insertar en $tabla: " . $sqlInsert->error;
        return false;
    }
}

// Función para insertar el modelo asociado a una marca específica
function insertarModeloConMarca($link, $descripcionModelo, $marcaCod, &$modvcMap)
{
    $nuevoCodigo = max($modvcMap) + 10;
    $sqlInsert = $link->prepare("INSERT INTO MODELO_VIDEOCAMARA (MODVC_CODIGO, MODVC_DESCRIPCION, MVC_CODIGO) VALUES (?, ?, ?)");
    $sqlInsert->bind_param('isi', $nuevoCodigo, $descripcionModelo, $marcaCod);

    if ($sqlInsert->execute()) {
        $modvcMap[$descripcionModelo] = $nuevoCodigo;
        return $nuevoCodigo;
    } else {
        global $errorMessages;
        $errorMessages[] = "Error al insertar el modelo: " . $sqlInsert->error;
        return false;
    }
}

// Cargar datos de marca y modelo
cargarDatosExistentes($link, $mvcMap, $modvcMap);

// Procesar el archivo CSV
if (($handle = fopen($archivotmp, "r")) === FALSE) {
    die("Error al abrir el archivo CSV.");
}
fgetcsv($handle, 1000, ";"); // Saltar cabecera

while (($datos = fgetcsv($handle, 1000, ";")) !== FALSE) {
    //$procedencia = ($datos[0] == "E") ? 10 : (($datos[0] == "J") ? 20 : 80);
    $procedencia = ($datos[0] == "C" || $datos[0] == "J") ? 10 : (($datos[0] == "N") ? 70 : (($datos[0] == "S") ? 20 : (($datos[0] == "E") ? 80 : 80)));
    $codEquipoSap = $datos[1] ?? '';
    $codActivoSap = $datos[2] ?? 'NULL';
    $nroSerie = $datos[3] ?? '';
    $marca = $datos[7] ?? '';
    $modelo = $datos[8] ?? '';

    // Procesar marca
    if (!isset($mvcMap[$marca])) {
        // Si la marca no existe, la insertamos y obtenemos el código de la nueva marca
        $marcaCod = insertarMarcaModelo($link, $marca, $mvcMap, 'MARCA_VIDEOCAMARA', 'MVC_CODIGO', 'MVC_DESCRIPCION');
        $contadorInsertMarcas++; // Incrementar contador de marcas insertadas
    } else {
        // Si la marca existe, obtenemos su código
        $marcaCod = $mvcMap[$marca];
    }

    // Procesar modelo
    if (!isset($modvcMap[$modelo])) {
        // Si el modelo no existe, insertarlo y asociarlo a la marca existente
        $modeloCod = insertarModeloConMarca($link, $modelo, $marcaCod, $modvcMap);
        $contadorInsertModelos++; // Incrementar contador de modelos insertados
    } else {
        $modeloCod = $modvcMap[$modelo];
    }

    // Verificar duplicidad
    $checkDuplicidad = $link->prepare("SELECT VC_COD_EQUIPO_SAP FROM VIDEOCAMARA WHERE VC_COD_EQUIPO_SAP = ?");
    $checkDuplicidad->bind_param('s', $codEquipoSap);
    $checkDuplicidad->execute();
    $checkDuplicidad->store_result();

    if ($checkDuplicidad->num_rows == 0) {
        $insertData[] = "('$marcaCod', '$modeloCod', '$procedencia', '$codActivoSap', '$codEquipoSap', '$nroSerie')"; //codigo autoincrementable
        $contadorInsertCamaras++; // Incrementar contador de cámaras insertadas
    } else {
        $updateData[] = [
            'marca' => $marcaCod,
            'modelo' => $modeloCod,
            'procedencia' => $procedencia,
            'codActivoSap' => $codActivoSap,
            'nroSerie' => $nroSerie,
            'codEquipoSap' => $codEquipoSap
        ];
        $contadorUpdateCamaras++; // Incrementar contador de cámaras actualizadas
    }
}
fclose($handle);

// Inserción y actualización masiva
if (!empty($insertData)) {
    $insertQuery = "INSERT INTO VIDEOCAMARA (MVC_CODIGO, MODVC_CODIGO, PREC_CODIGO, VC_COD_ACTIVO_SAP, VC_COD_EQUIPO_SAP, VC_NRO_SERIE) VALUES " . implode(", ", $insertData);
    if (!$link->query($insertQuery)) {
        $errorMessages[] = "Error en la inserción de cámaras: " . $link->error;
    }
}

if (!empty($updateData)) {
    foreach ($updateData as $data) {
        $updateQuery = $link->prepare("UPDATE VIDEOCAMARA 
                                        SET MVC_CODIGO = ?, 
                                            MODVC_CODIGO = ?, 
                                            PREC_CODIGO = ?, 
                                            VC_COD_ACTIVO_SAP = ?, 
                                            VC_NRO_SERIE = ? 
                                        WHERE VC_COD_EQUIPO_SAP = ?");

        //  print_r($data); // Muestra el contenido para debug
        $updateQuery->bind_param('iiiiis', $data['marca'], $data['modelo'], $data['procedencia'], $data['codActivoSap'], $data['nroSerie'], $data['codEquipoSap']);
        //i:enteros / s: cadenas
        if (!$updateQuery->execute()) {
            $errorMessages[] = "Error en la actualización del equipo SAP '{$data['codEquipoSap']}': " . $updateQuery->error;
        }
    }
}

// Mensaje de confirmación final
echo "<strong>OPERACIÓN COMPLETADA CORRECTAMENTE.</strong><br>";
echo "<strong>Resumen de la operación:</strong><br>";
echo "Cámaras insertadas: $contadorInsertCamaras<br>";
echo "Cámaras actualizadas: $contadorUpdateCamaras<br>";
echo "Marcas insertadas: $contadorInsertMarcas<br>";
echo "Modelos insertados: $contadorInsertModelos<br>";

if (!empty($errorMessages)) {
    echo "Errores encontrados:<br>";
    foreach ($errorMessages as $error) {
        echo $error . "<br>";
    }
} else {
    echo "Errores encontrados: No se encontraron errores durante la operación.<br>";
}
?>
<a href="javascript:window.history.back();">&laquo; Volver a la página anterior &laquo;</a>