<?php
session_start();

function validateToken() {
    if (!isset($_SESSION['access_token'])) {
        echo "<script>alert('Sesión no iniciada'); self.location.href='index.php?ctrl=1';</script>";
        exit;
    }

    $url = "http://autentificaticapi.carabineros.cl/api/auth/validate-token";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $_SESSION['access_token'],
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    require("./inc/Services_JSON.php");
    $json = new Services_JSON();
    $result = $json->decode($response);

    if ($http_code != 200 || !isset($result->success)) {
        echo "<script>alert('Token no válido'); self.location.href='index.php?ctrl=1';</script>";
        exit;
    }
}
?>