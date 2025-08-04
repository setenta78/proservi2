<?php
session_start();

$token = $_SESSION['jwtToken'] ?? ''; // Corrección para PHP 5.1.2
if (!$token) {
    header('Location: login.php');
    exit;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://des-proservipol.carabineros.cl/api/auth/validate-token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    session_destroy();
    header('Location: login.php');
}
?>