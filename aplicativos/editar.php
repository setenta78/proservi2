<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/logo.png">
    <title>Sistema de Importación de Datos: SAP -> PROSERVIPOL.</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-700">
    <!-- Cabecera fija -->
    <?php include "header.php"; ?>

    <!-- Menú lateral fijo -->
    <div class="flex">
        <?php include "nav.php"; ?>
        <?php
        require_once "queries/config.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
            // Obtener datos del formulario
            $codigo = $_POST['codigo'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $procedencia = $_POST['procedencia'];
            $unidad = $_POST['unidad'];
            $codigoActivo = $_POST['codigoActivo'];
            $codigoEquipo = $_POST['codigoEquipo'];
            $nroSerie = $_POST['nroSerie'];

            // Consulta para actualizar la cámara
            $sqlUpdate = "UPDATE VIDEOCAMARA SET 
                    MVC_CODIGO = '$marca', 
                    MODVC_CODIGO = '$modelo', 
                    PREC_CODIGO = '$procedencia', 
                    UNI_CODIGO = '$unidad', 
                    VC_COD_ACTIVO_SAP = '$codigoActivo', 
                    VC_NRO_SERIE = '$nroSerie' 
                  WHERE VC_CODIGO = '$codigo'";

            if (mysqli_query($link, $sqlUpdate)) {
                echo "<script>alert('Cámara actualizada correctamente'); window.location.href='index.php';</script>";
            } else {
                echo "ERROR: No se pudo ejecutar la consulta $sqlUpdate. " . mysqli_error($link);
            }
        }

        // Obtener el código de la cámara a editar
        if (isset($_GET['id'])) {
            $codigo = $_GET['id'];

            // Consulta para obtener los datos actuales de la cámara
            $sql = "SELECT 
                VIDEOCAMARA.VC_CODIGO,
                MARCA_VIDEOCAMARA.MVC_CODIGO,
                MODELO_VIDEOCAMARA.MODVC_CODIGO,
                PROCEDENCIA_RECURSO.PREC_CODIGO,
                VIDEOCAMARA.UNI_CODIGO,
                VIDEOCAMARA.VC_COD_ACTIVO_SAP,
                VIDEOCAMARA.VC_COD_EQUIPO_SAP,
                VIDEOCAMARA.VC_NRO_SERIE,
                UNIDAD.UNI_DESCRIPCION
            FROM VIDEOCAMARA
            INNER JOIN MARCA_VIDEOCAMARA ON VIDEOCAMARA.MVC_CODIGO = MARCA_VIDEOCAMARA.MVC_CODIGO
            LEFT OUTER JOIN MODELO_VIDEOCAMARA ON VIDEOCAMARA.MODVC_CODIGO = MODELO_VIDEOCAMARA.MODVC_CODIGO
            LEFT OUTER JOIN PROCEDENCIA_RECURSO ON VIDEOCAMARA.PREC_CODIGO = PROCEDENCIA_RECURSO.PREC_CODIGO
            LEFT OUTER JOIN UNIDAD ON VIDEOCAMARA.UNI_CODIGO = UNIDAD.UNI_CODIGO
            WHERE VIDEOCAMARA.VC_CODIGO = '$codigo'";

            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
        } else {
            echo "<script>alert('Código no válido.'); window.location.href='index.php';</script>";
            exit();
        }
        ?>

        <!DOCTYPE html>
        <html lang="es">

        <script type="text/javascript">
            $(document).ready(function() {

                $('.search-box input[type="text"]').on("keyup input", function() {
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if (inputVal.length) {
                        $.get("backend-search.php", {
                            term: inputVal
                        }).done(function(data) {
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else {
                        resultDropdown.empty();
                    }
                });

                // Set search input value on click of result item
                $(document).on("click", ".result p", function() {
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                });
            });
        </script>

        <body class="bg-gray-100 p-5">
            <hr class="border-gray-400 mb-5">
            <div class="max-w-lg mx-auto p-5 bg-white shadow-lg rounded-lg mt-40">
                <h3 class="text-center text-2xl font-semibold mb-4">Editar Cámara</h3>
                <hr class="border-gray-400 mb-5">
                <form action="editar.php" method="POST">
                    <input type="hidden" name="codigo" value="<?php echo $row['VC_CODIGO']; ?>">

                    <div class="mb-4">
                        <label for="marca" class="block text-gray-700 font-semibold mb-2">Marca</label>
                        <input type="text" name="marca" value="<?php echo $row['MVC_CODIGO']; ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div class="mb-4">
                        <label for="modelo" class="block text-gray-700 font-semibold mb-2">Modelo</label>
                        <input type="text" name="modelo" value="<?php echo $row['MODVC_CODIGO']; ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div class="mb-4">
                        <label for="procedencia" class="block text-gray-700 font-semibold mb-2">Procedencia</label>
                        <input type="text" name="procedencia" value="<?php echo $row['PREC_CODIGO']; ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div class="mb-4">
                        <label for="unidad" class="block text-gray-700 font-semibold mb-2">Unidad</label>
                        <input name="unidad2" value="<?php echo $row['UNI_DESCRIPCION']; ?>" readonly
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded bg-gray-200">
                        <input type="text" name="unidad" value="<?php echo $row['UNI_CODIGO']; ?>"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div class="mb-4">
                        <label for="codigoActivo" class="block text-gray-700 font-semibold mb-2">Código Activo SAP</label>
                        <input type="text" name="codigoActivo" value="<?php echo $row['VC_COD_ACTIVO_SAP']; ?>"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div class="mb-4">
                        <label for="codigoEquipo" class="block text-gray-700 font-semibold mb-2">Código Equipo SAP</label>
                        <input type="text" name="codigoEquipo" value="<?php echo $row['VC_COD_EQUIPO_SAP']; ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div class="mb-4">
                        <label for="nroSerie" class="block text-gray-700 font-semibold mb-2">Número de Serie</label>
                        <input type="text" name="nroSerie" value="<?php echo $row['VC_NRO_SERIE']; ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="submit" name="actualizar"
                            class="px-4 py-2 bg-green-500 text-white font-semibold rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Actualizar
                        </button>
                        <a href="index.php"
                            class="px-4 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </body>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $(window).on('load', function() {
                    $(".cargando").fadeOut(1000);
                });
            });

            // JavaScript para mostrar el nombre del archivo seleccionado
            document.getElementById('file-input').addEventListener('change', function(event) {
                var fileName = event.target.files[0] ? event.target.files[0].name : 'Ningún archivo seleccionado';
                document.getElementById('file-name').textContent = fileName;
            });
        </script>

        </html>