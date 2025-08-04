<?php
session_start(); // Asegúrate de que la sesión está iniciada
include("../class/class.php");

// Verificar que la sesión esté iniciada
if (isset($_SESSION["session_video_14"])) {
    $codigo = $_SESSION["session_video_14"];
    $grado  = $_SESSION["session_video_15"];
    $nombre = $_SESSION["session_video_16"];
    $tipo = $_SESSION["session_video_17"];

    $datos  = "($grado) - $nombre";
    $fecha = date("d/m/Y");
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado Mantenedor de Vehículos</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="../css/estilos.css" type="text/css" />
        <style>
            .wrapper {
                width: 900px;
                margin: 0 auto;
            }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="container mx-auto">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold">Últimos 30 Vehículos Ingresados a la BD</h2>
                            <a href="create.php" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Agregar Vehículo</a>
                        </div>
                        <?php
                        require_once "config.php";

                        // Attempt select query execution
                        $sql = "SELECT 
                              `VEHICULO`.`VEH_CODIGO`,
                              `VEHICULO`.`TVEH_CODIGO`,
                              `TIPO_VEHICULO`.`TVEH_DESCRIPCION`,
                              `VEHICULO`.`PREC_CODIGO`,
                              `PROCEDENCIA_RECURSO`.`PREC_DESCRIPCION`,
                              `VEHICULO`.`VEH_BCU`,
                              `VEHICULO`.`VEH_SAP`,
                              `VEHICULO`.`MODVEH_CODIGO`,
                              `MODELO_VEHICULO`.`MODVEH_DESCRIPCION`,
                              `VEHICULO`.`MVEH_CODIGO`,
                              `MARCA_VEHICULO`.`MVEH_DESCRIPCION`,
                              `VEHICULO`.`VEH_PATENTE`,
                              `VEHICULO`.`VEH_NUMEROINSITUCIONAL`,
                              `VEHICULO`.`ANNO_FABRICACION`,
                              `VEHICULO`.`UNI_CODIGO`,
                              `UNIDAD`.`UNI_DESCRIPCION`
                            FROM
                              `VEHICULO`
                              INNER JOIN `TIPO_VEHICULO` ON (`VEHICULO`.`TVEH_CODIGO` = `TIPO_VEHICULO`.`TVEH_CODIGO`)
                              LEFT JOIN `MODELO_VEHICULO` ON (`VEHICULO`.`MODVEH_CODIGO` = `MODELO_VEHICULO`.`MODVEH_CODIGO`)
                              LEFT JOIN `UNIDAD` ON (`VEHICULO`.`UNI_CODIGO` = `UNIDAD`.`UNI_CODIGO`)
                              LEFT JOIN `MARCA_VEHICULO` ON (`MODELO_VEHICULO`.`MVEH_CODIGO` = `MARCA_VEHICULO`.`MVEH_CODIGO`)
                              INNER JOIN `PROCEDENCIA_RECURSO` ON (`VEHICULO`.`PREC_CODIGO` = `PROCEDENCIA_RECURSO`.`PREC_CODIGO`)
                            ORDER BY VEH_CODIGO DESC
                            LIMIT 30";

                        if ($result = mysqli_query($link, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                echo "<table class='min-w-full border-collapse table-auto text-sm'>";  // Cambiar a text-sm para reducir tamaño de letra
                                echo "<thead class='bg-gray-200'>";
                                echo "<tr>";
                                echo "<th class='border px-4 py-2'>Código</th>";
                                echo "<th class='border px-4 py-2'>Tipo vehículo</th>";
                                echo "<th class='border px-4 py-2'>Procedencia</th>";
                                echo "<th class='border px-4 py-2'>Cod. BCU</th>";
                                echo "<th class='border px-4 py-2'>Cod. SAP</th>";
                                echo "<th class='border px-4 py-2'>Marca</th>";
                                echo "<th class='border px-4 py-2'>Modelo</th>";
                                echo "<th class='border px-4 py-2'>Patente</th>";
                                echo "<th class='border px-4 py-2'>Nro. Instituional</th>";
                                echo "<th class='border px-4 py-2'>Año</th>";
                                echo "<th class='border px-4 py-2'>Unidad</th>";
                                echo "<th class='border px-4 py-2'>Acciones</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr class='border-t'>";
                                    echo "<td class='border px-4 py-2'>{$row['VEH_CODIGO']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['TVEH_DESCRIPCION']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['PREC_DESCRIPCION']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['VEH_BCU']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['VEH_SAP']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['MVEH_DESCRIPCION']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['MODVEH_DESCRIPCION']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['VEH_PATENTE']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['VEH_NUMEROINSITUCIONAL']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['ANNO_FABRICACION']}</td>";
                                    echo "<td class='border px-4 py-2'>{$row['UNI_DESCRIPCION']}</td>";
                                    echo "<td class='border px-4 py-2'>
                                        <a href='update.php?id={$row['VEH_CODIGO']}' title='Actualizar Registro'><svg class='w-6 h-6 text-blue-500 hover:text-blue-700' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15.232 5.232l3.536 3.536m-2.036-6.036A2.5 2.5 0 0117.5 8.036l-10 10L5 20l1.964-.536 10-10a2.5 2.5 0 00-1.964-4.268z'></path></svg></a>
                                        <a href='delete.php?id={$row['VEH_CODIGO']}' title='Eliminar Registro'><svg class='w-6 h-6 text-red-500 hover:text-red-700' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path></svg></a>
                                      </td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                mysqli_free_result($result);
                            } else {
                                echo "<p class='lead'><em>No existen registros.</em></p>";
                            }
                        } else {
                            echo "ERROR: No se pudo ejecutar la consulta: " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    echo "<script type='text/javascript'>
            alert('DEBE INICIAR SESI\u00D3N PARA ACCEDER A ESTE CONTENIDO');
            window.location='http://proservipol.carabineros.cl/app/';
          </script>";
}
?>