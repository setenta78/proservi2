<?php
// Incluir archivos de configuración de base de datos y consulta de solicitudes
require_once "queries/config.php";
require_once "queries/dataSolicitudes.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Administrador de Solicitudes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Solicitudes Pendientes</h1>
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="w-1/6 py-2 px-4 border-b">Código</th>
                    <th class="w-1/6 py-2 px-4 border-b">Unidad</th>
                    <th class="w-1/6 py-2 px-4 border-b">Fecha</th>
                    <th class="w-1/6 py-2 px-4 border-b">Problema</th>
                    <th class="w-1/6 py-2 px-4 border-b">Operador</th>
                    <th class="w-1/6 py-2 px-4 border-b">Días Pendientes</th>
                    <th class="w-1/6 py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexión a la base de datos
                // $conexion = new mysqli("host", "usuario", "contraseña", "base_datos");

                // Ejecutar consulta
                $query = "SELECT  
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
                SOLICITUD.SOL_FECHA DESC";  // Tu consulta SQL completa aquí

                $resultado = $conexion->query($query);

                // Mostrar resultados
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        $difDias = $row['DIF_DIAS'];
                        $colorFila = $difDias > 3 ? 'bg-red-100' : '';

                        echo "<tr class='$colorFila'>";
                        echo "<td class='py-2 px-4 border-b'>{$row['SOL_CODIGO']}</td>";
                        echo "<td class='py-2 px-4 border-b'>{$row['UNI_DESCRIPCION']}</td>";
                        echo "<td class='py-2 px-4 border-b'>{$row['SOL_FECHA']}</td>";
                        echo "<td class='py-2 px-4 border-b'>{$row['PROB_DESCRIPCION']}</td>";
                        echo "<td class='py-2 px-4 border-b'>{$row['DATO_OPER']}</td>";
                        echo "<td class='py-2 px-4 border-b'>{$difDias}</td>";
                        echo "<td class='py-2 px-4 border-b'><button class='bg-blue-500 text-white px-2 py-1 rounded'>Gestionar</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='py-2 px-4 border-b text-center'>No hay solicitudes pendientes.</td></tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

</body>

</html>