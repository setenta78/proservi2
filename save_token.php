<?php
session_start();
header('Content-Type: application/json');

// Ajustar la ruta al directorio inc/ dentro de systema\web\des-proservipol\
require_once 'inc/Services_JSON.php';

$json = new Services_JSON();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $access_token = isset($_POST['access_token']) ? $_POST['access_token'] : '';
    $expires_at = isset($_POST['expires_at']) ? $_POST['expires_at'] : '';
    $token_type = isset($_POST['token_type']) ? $_POST['token_type'] : '';

    if ($access_token && $expires_at && $token_type) {
        $_SESSION['access_token'] = $access_token;
        $_SESSION['expires_at'] = $expires_at;
        $_SESSION['token_type'] = $token_type;
        echo $json->encode(array('success' => true, 'access_token' => $access_token));
    } else {
        echo $json->encode(array('success' => false, 'message' => 'Datos incompletos'));
    }
} else {
    echo $json->encode(array('success' => false, 'message' => 'Método no permitido'));
}
?>