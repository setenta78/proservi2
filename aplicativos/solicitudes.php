<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/logo.png">
    <title>Sistema de Importación de Datos: SAP -> PROSERVIPOL.</title>
    <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-700">
    <!-- Cabecera fija -->
    <?php include "header.php"; ?>

    <!-- Menú lateral fijo -->
    <div class="flex">
        <?php include "nav.php"; ?>

        <!-- Contenido Principal -->
        <div class="ml-64 w-full mt-20 p-5">
            <h3 class="text-center text-green-800 font-semibold mt-5">Sistema de Solicitudes PROSERVIPOL.</h3>
            <hr class="my-4 border-gray-400">

            <div class="container mx-auto mt-20 p-5">

                <!-- Campo de búsqueda -->
                <div class="flex justify-center mb-4">
                    <form action="" method="GET" class="w-full max-w-lg flex items-center">
                        <input type="text" name="search" placeholder="Buscar por unidad, usuario, tipo etc." class="w-full p-2 border rounded-l-lg focus:outline-none focus:ring focus:border-green-500" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-r-lg hover:bg-green-700">Buscar</button>
                    </form>
                </div>

                <hr class="border-gray-400">
                <!-- Aquí el código PHP para mostrar la tabla de datos y la paginación -->
                <?php
                require_once "queries/config.php";
                $records_per_page = 5;
                $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($current_page - 1) * $records_per_page;
                $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';

                // Parámetros de ordenación
                $sort = isset($_GET['sort']) ? $_GET['sort'] : 'SOL_CODIGO';
                $order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc';
                $new_order = $order === 'asc' ? 'desc' : 'asc';

                // Consulta SQL con búsqueda dinámica
                /*  $sql = "SELECT 
                        SOLICITUD.SOL_CODIGO,
                        SOLICITUD.UNI_CODIGO,
                        SOLICITUD.SOL_FECHA,
                        PROBLEMA.PROB_DESCRIPCION,
                        SUBPROBLEMA.SUBP_DESCRIPCION,
                        TIPO_MOVIMIENTO.TMOV_DESCRIPCION,
                        UNIDAD.UNI_DESCRIPCION,
                        CONCAT_WS(' ', UCASE(SOLICITUD.VALOR_IDENTI1), UCASE(SOLICITUD.VALOR_IDENTI2)) AS IDENTIFICADORES,
                        DATEDIFF(NOW(), SOLICITUD.SOL_FECHA) AS DIF_DIAS,
                        CONCAT_WS(' ', TIPO_MOVIMIENTO.TMOV_DESCRIPCION, 'POR:', GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER
                    FROM SOLICITUD
                        INNER JOIN MOVIMIENTO ON SOLICITUD.SOL_CODIGO = MOVIMIENTO.SOL_CODIGO
                        INNER JOIN SUBPROBLEMA ON SOLICITUD.PROB_CODIGO = SUBPROBLEMA.PROB_CODIGO AND SOLICITUD.SUBP_CODIGO = SUBPROBLEMA.SUBP_CODIGO
                        INNER JOIN PROBLEMA ON SUBPROBLEMA.PROB_CODIGO = PROBLEMA.PROB_CODIGO
                        INNER JOIN TIPO_MOVIMIENTO ON MOVIMIENTO.TMOV_CODIGO = TIPO_MOVIMIENTO.TMOV_CODIGO
                        INNER JOIN UNIDAD ON SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO
                        INNER JOIN FUNCIONARIO ON MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO
                        INNER JOIN GRADO ON FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO AND FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO
                    WHERE 
                        (PROBLEMA.PROB_DESCRIPCION LIKE '%$search%' OR SUBPROBLEMA.SUBP_DESCRIPCION LIKE '%$search%' OR UNIDAD.UNI_DESCRIPCION LIKE '%$search%' OR FUNCIONARIO.FUN_APELLIDOPATERNO LIKE '%$search%')
                        AND TIPO_MOVIMIENTO.TMOV_CODIGO IN (70, 80)
                        AND SOLICITUD.SOL_FECHA >= '20200101'
                        AND FECHA_TERMINO IS NULL
                    ORDER BY $sort $order
                    LIMIT $records_per_page OFFSET $offset";*/

                $sql =  "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
                UNIDAD.UNI_DESCRIPCION,
                CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
                DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
                CONCAT_WS(' ',  `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,'POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
                MOVIMIENTO.MOV_CODIGO    
                FROM
               `SOLICITUD`
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
                INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
                AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                WHERE 
                TIPO_MOVIMIENTO.TMOV_CODIGO IN(70,80)
                AND SOLICITUD.SOL_FECHA >= '20240301'
                AND FECHA_TERMINO IS NULL  AND TMOV_DESCRIPCION <> 'CIERRE: RESUELTO FAVORABLEMENTE' AND TMOV_DESCRIPCION <> 'CIERRE: RESUELTO DESFAVORABLEMENTE' 
                AND TMOV_DESCRIPCION <> 'CIERRE: INADMISIBLE'
                ORDER BY   
                SOLICITUD.SOL_FECHA DESC";

                $result = mysqli_query($link, $sql);
                echo $link;
                echo $sql;
                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<table class='min-w-full bg-white border border-gray-200 rounded-lg'>";
                    echo "<thead><tr class='bg-gray-100'>";
                    echo "<th class='border px-4 py-2'><a href='?sort=SOL_CODIGO&order=$new_order'>Código</a></th>";
                    echo "<th class='border px-4 py-2'><a href='?sort=PROB_DESCRIPCION&order=$new_order'>Problema</a></th>";
                    echo "<th class='border px-4 py-2'><a href='?sort=SUBP_DESCRIPCION&order=$new_order'>Subproblema</a></th>";
                    echo "<th class='border px-4 py-2'><a href='?sort=SOL_FECHA&order=$new_order'>Fecha</a></th>";
                    echo "<th class='border px-4 py-2'><a href='?sort=UNI_DESCRIPCION&order=$new_order'>Unidad</a></th>";
                    echo "<th class='border px-4 py-2'><a href='?sort=IDENTIFICADORES&order=$new_order'>Identificadores</a></th>";
                    echo "<th class='border px-4 py-2'>Días sin resolver</th>";
                    echo "<th class='border px-4 py-2'>Acciones</th>";
                    echo "</tr></thead><tbody>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='text-center'>";
                        echo "<td class='border px-4 py-2'>{$row['SOL_CODIGO']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['PROB_DESCRIPCION']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['SUBP_DESCRIPCION']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['SOL_FECHA']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['UNI_DESCRIPCION']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['IDENTIFICADORES']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['DIF_DIAS']}</td>";
                        echo "<td class='border px-4 py-2'><a href='#' class='bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600'>Gestionar</a></td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    // (Paginación similar a tu código existente)
                } else {
                    echo "<p class='text-center text-gray-600'><em>No existen registros.</em></p>";
                }
                mysqli_close($link);
                ?>

            </div>
        </div>
    </div>
</body>
<!-- Scripts -->
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