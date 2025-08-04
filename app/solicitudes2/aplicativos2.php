<?php
require_once("class/class.php");

date_default_timezone_set('America/Santiago');

//require_once("solicitudesDesarrollo/js/valida.php");

//Incluimos el archivo con la función o simplemente pegamos la función
//require('fechaTexto.php');
if (isset($_SESSION["session_video_14"])) {
	$codigo = $_SESSION["session_video_14"];
	$grado  = $_SESSION["session_video_15"];
	$nombre = $_SESSION["session_video_16"];

	$tipo = $_SESSION["session_video_17"];

	$datos  = "(" . $grado . ")" . " - " . $nombre;
	//echo $codigo." ".$user." ".$descripcion


	$miFechax = date('d-m-Y h:i:s a', time());
	//	echo "The current date and time in Toronto are $miFecha.";
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Menú Sistema Interno - Carabineros de Chile</title>
		<script src="https://cdn.tailwindcss.com"></script>
	</head>

	<body class="bg-gray-100">
		<div class="flex min-h-screen">
			<!-- Sidebar -->
			<div class="w-64 bg-green-800 shadow-lg">
				<!-- Logo Carabineros de Chile -->
				<div class="p-4 flex justify-center bg-green-900">
					<img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Carabineros_de_Chile_logo.png" alt="Carabineros de Chile" class="w-24 h-24">
				</div>

				<div class="p-4 text-white font-bold text-xl text-center">
					Sistema Interno
				</div>

				<ul class="mt-4 text-white">
					<!-- Menú Items -->
					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.5 20.5h13M4 8l7.5 7.5L19 8" />
							</svg>
							<span>Ingreso Vehículos</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-4 0v7m0 0h3m-6 0h3" />
							</svg>
							<span>Cambio Fecha</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 2H7m10-6H7" />
							</svg>
							<span>Licencias Médicas</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4 4m0 0l4-4m-4 4V4" />
							</svg>
							<span>Permisos</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
							</svg>
							<span>Desvalidador</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v10m8-10v10" />
							</svg>
							<span>Reintegrados</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l4 4 4-4m0-6l-4 4-4-4" />
							</svg>
							<span>Movimientos</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
							</svg>
							<span>Listado Servicios</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
							</svg>
							<span>Ingreso Armas</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 2.21 1.79 4 4 4s4-1.79 4-4-1.79-4-4-4-4 1.79-4 4zm-7 4l4 4-4-4m0-4l4-4-4 4z" />
							</svg>
							<span>Ingreso Animales</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-1a2 2 0 012-2h4a2 2 0 012 2v1h1a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v2m-6 2h6" />
							</svg>
							<span>Solicitudes</span>
						</a>
					</li>

					<li class="p-2 hover:bg-green-700">
						<a href="#" class="flex items-center space-x-2">
							<svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6" />
							</svg>
							<span>Integración SAP</span>
						</a>
					</li>
				</ul>
			</div>

			<!-- Content -->
			<div class="flex-1 p-6 bg-gray-100">
				<h1 class="text-2xl font-bold text-green-900">Bienvenido al Sistema Interno</h1>
				<p class="mt-4 text-gray-600">Seleccione una opción del menú para comenzar.</p>
			</div>
		</div>
	</body>

	</html>


<?php
} else {
	echo "
	<script type='text/javascript'>
	alert('DEBE INICIAR SESI\u00D3N PARA ACCEDER A ESTE CONTENIDO');
	window.location='index.php';
	</script>
	";
}
?>