<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "queries/config.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/logo.png">
    <title>Sistema de Importación de Datos: SAP -> PROSERVIPOL</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-700">
    <!-- Incluir cabecera -->
    <?php include "header.php"; ?>

    <div class="flex">
        <!-- Incluir menú de navegación lateral -->
        <?php include "nav.php"; ?>

        <!-- Contenido Principal -->
        <div class="ml-64 w-full mt-20 p-5">
            <h3 class="text-center text-green-800 font-semibold mt-5">Plantilla tipo</h3>
            <hr class="my-4 border-gray-400">
            <div class="container mx-auto mt-20 p-5">
                <!-- Aquí puedes agregar el contenido específico de cada página -->
                <p class="text-center text-gray-600">Bienvenido.....</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>