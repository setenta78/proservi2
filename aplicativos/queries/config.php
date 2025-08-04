<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Detectar la versión de PHP
$php_version = phpversion();

// Detectar la IP del servidor
$ip_address = $_SERVER['SERVER_ADDR']; // Alternativa compatible con PHP 5.1.2

// Configuración de la base de datos según la IP
if ($ip_address === '127.0.0.1' || $ip_address === '::1') {
    $db_config = array(
        'DB_SERVER'   => 'localhost',
        'DB_USERNAME' => 'root',
        'DB_PASSWORD' => 'root',
        'DB_NAME'     => 'DB_PROSERVIPOL_V3',
    );
} else {
    $db_config = array(
        'DB_SERVER'   => '172.21.111.67',
        'DB_USERNAME' => 'proservipolv3',
        'DB_PASSWORD' => 'carta77',
        'DB_NAME'     => 'DB_PROSERVIPOL_V3',
    );
}

// Conexión utilizando mysqli
if (version_compare($php_version, '5.5.0', '<')) {
    // Para PHP 5.4.x o anterior (utilizando mysql_connect() en versiones antiguas)
    $link = mysql_connect(
        $db_config['DB_SERVER'],
        $db_config['DB_USERNAME'],
        $db_config['DB_PASSWORD']
    );

    // Verificar la conexión
    if (!$link) {
        die("ERROR: No se pudo conectar a la base de datos. " . mysql_error());
    }

    // Seleccionar la base de datos
    $db_selected = mysql_select_db($db_config['DB_NAME'], $link);
    if (!$db_selected) {
        die("ERROR: No se pudo seleccionar la base de datos. " . mysql_error());
    }

    //  echo "Conexión exitosa a la base de datos usando mysql_connect().";
} else {
    // Para PHP 5.5.0 o superior (usando mysqli_connect() en versiones más nuevas)
    $link = mysqli_connect(
        $db_config['DB_SERVER'],
        $db_config['DB_USERNAME'],
        $db_config['DB_PASSWORD'],
        $db_config['DB_NAME']
    );

    // Verificar la conexión
    if (!$link) {
        die("ERROR: No se pudo conectar a la base de datos. " . mysqli_connect_error());
    }

    //echo "Conexión exitosa a la base de datos usando mysqli_connect().";
}

/*
// Detectar la IP del servidor
$ip_address = $_SERVER['SERVER_ADDR']; // Alternativa compatible con PHP 5.1.2

// Configuración de la base de datos según la IP
if ($ip_address === '127.0.0.1' || $ip_address === '::1') {
    $db_config = array(
        'DB_SERVER'   => 'localhost',
        'DB_USERNAME' => 'root',
        'DB_PASSWORD' => 'root',
        'DB_NAME'     => 'DB_PROSERVIPOL_V3',
    );
} else {
    $db_config = array(
        'DB_SERVER'   => '172.21.111.67',
        'DB_USERNAME' => 'proservipolv3',
        'DB_PASSWORD' => 'carta77',
        'DB_NAME'     => 'DB_PROSERVIPOL_V3',
    );
}

// Intento de conexión a la base de datos
$link = mysqli_connect(
    $db_config['DB_SERVER'],
    $db_config['DB_USERNAME'],
    $db_config['DB_PASSWORD'],
    $db_config['DB_NAME']
);

// Verificar la conexión
if ($link === false) {
    die("ERROR: No se pudo conectar a la base de datos. " . mysqli_connect_error());
} */
