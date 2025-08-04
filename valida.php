<?php
session_start();
include("./inc/configV4.inc.php");
include("./baseDatos/Conexion.class.php");
require("./baseDatos/dbUsuarios.class.php");
require("./objetos/usuario.class.php");
require("./objetos/perfil.class.php");
require("./objetos/funcionario.class.php");
require("./objetos/unidad.class.php");
require("./objetos/escalafon.class.php");
require("./objetos/grado.class.php");

$userName = $_POST['textUsuario'];
$clave = 'dummy';
$aplicacion = 10;
$ip = $_SERVER['REMOTE_ADDR'];
$fecha_hra_inicio = date("Y/m/d H:i:s");

$msjCargo = "ATENCION :\\n\\nEL USUARIO NO REGISTRA EL CARGO DE ENCARGADO DE PROSERVIPOL, SE SOLICITA REGULARIZAR ESTA SITUACION A LA BREVEDAD \\nCONSULTAS REALIZARLAS AL CORREO: correo.proservipol@carabineros.cl.";
$msjAUsuarios = "ATENCION!! \\n\\nAL MOMENTO DE SOLICITAR ALGUN REQUERIMIENTO VIA CORREO ELECTRÓNICO PARA LA SOLUCIÓN DE PROBLEMAS CON EL SISTEMA PROSERVIPOL V3.9, USTED DEBERÁ INCLUIR LOS SIGUIENTES DATOS: \\n\\n1.- PARA HABILITAR FUNCIONARIOS REINTEGRADOS: DEBE INDICAR EL CÓDIGO DEL FUNCIONARIO.\\n\\n2.- PARA HABILITACIÓN DE VEHICULOS: DEBE INDICAR EL CÓDIGO B.C.U.\\n\\n3.- PARA HABILITACIÓN DE ARMAS: DEBE INDICAR EL NÚMERO DE SERIE DEL ARMAMENTO.\\n CONSULTAS REALIZARLAS A : correo.proservipol@carabineros.cl.";

$objDBUsuarios = new dbUsuarios;
$usuario = new usuario();
$usuario->setUserName($userName);
$usuario->setClave($clave);

$objDBUsuarios->validaUsuario($userName, $usuario);

if (is_object($usuario)) {
    $userName = $usuario->getUserName();
    if ($userName != $_POST['textUsuario']) {
        error_log("Usuario no coincide: Esperado " . $_POST['textUsuario'] . ", Obtenido " . $userName);
        echo "<script>self.location.href='index.php?ctrl=1';</script>";
        exit;
    }

    $codigoFuncionario = $usuario->getFuncionario()->getCodigoFuncionario();
    $gradoUsuario = $usuario->getFuncionario()->getGrado()->getDescripcion();
    $nombreUsuario = $usuario->getFuncionario()->getNombreCompleto();

    $gradoUsuarioPadre = $usuario->getFuncionario()->getGrado()->getDescripcion();
    $nombreUsuarioPadre = $usuario->getFuncionario()->getNombreCompleto();
    $codigoFuncPadre = $usuario->getFuncionario()->getCodigoFuncionario();
    $codigoUnidadUsuario = $usuario->getUnidad()->getCodigoUnidad();
    $descUnidadUsuario = $usuario->getUnidad()->getDescripcionUnidad();
    $tienePlanCuadrante = $usuario->getUnidad()->getTienePlanCuadrante();
    $codigoPerfil = $usuario->getPerfil()->getCodigoPerfil();
    $perfil = $usuario->getPerfil()->getDescripcionPerfil();
    $codigoUnidadPadre = $usuario->getUnidad()->getPadreUnidad()->getCodigoUnidad();
    $unidadBloqueo = $usuario->getUnidad()->getBloqueada();
    $unidadEspecialidad = $usuario->getUnidad()->getEspecialidad();
    $unidadEspecialidadO = $usuario->getUnidad()->getEspecialidadOld();
    $tipoUnidad = $usuario->getUnidad()->getTipoUnidad();
    $contieneHijos = $usuario->getUnidad()->getContieneHijos();
    $cargo = $usuario->getFuncionario()->getCargo();
    $UnidadTipo = $usuario->getUnidad()->getUnidadTipo();
    $tipoUnidadNew = $usuario->getUnidad()->getTipoUnidadNew();
    $especialidadUnidadNew = $usuario->getUnidad()->getEspecialidadUnidadNew();
    $tipoUnidadPadre = $usuario->getUnidad()->getTipoUnidadPadre()->getTipoUnidad();
    $fechaLimite = $usuario->getFechaLimite();
    $permisoValidar = $usuario->getPerfil()->getPermisoValidar();
    $permisoRegistrar = $usuario->getPerfil()->getPermisoRegistrar();
    $permisoConsultarUnidad = $usuario->getPerfil()->getPermisoConsultarUnidad();
    $permisoConsultarPerfil = $usuario->getPerfil()->getPermisoConsultarPerfil();

    $arr1 = array('CF1','CF2','CF3');
    $arr2 = array('CUAD1','CUAD2');
    $arr3 = array('DF1','DF2','DF3');
    $array1 = array('1','VEH','KM_INICIAL','KM_FINAL',$arr1,$arr2,$arr3);
    $array2 = array('1','VEH','KM_INICIAL','KM_FINAL',$arr1,$arr2,$arr3);
    $arrFinla = array($array1, $array1);

    $_SESSION['USUARIO_USERNAME'] = $userName;
    $_SESSION['USUARIO_CLAVE'] = $clave;
    $_SESSION['USUARIO_FECHALIMITE'] = $fechaHoy;
    $_SESSION['DIRECCION_IP'] = $ip;
    $_SESSION['HORA_INICIO'] = $fecha_hra_inicio;

    $_SESSION['USUARIO_CODIGOFUNCIONARIO'] = $codigoFuncionario;
    $_SESSION['USUARIO_CODIGOFUNCIONARIO_ORIGEN'] = $codigoFuncionario;

    $_SESSION['USUARIO_GRADO'] = $gradoUsuario;
    $_SESSION['USUARIO_GRADO_ORIGEN'] = $gradoUsuario;

    $_SESSION['USUARIO_NOMBRE'] = $nombreUsuario;
    $_SESSION['USUARIO_NOMBRE_ORIGEN'] = $nombreUsuario;

    $_SESSION['USUARIO_CODIGOPERFIL'] = $codigoPerfil;
    $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'] = $codigoPerfil;

    $_SESSION['USUARIO_PERFIL'] = $perfil;
    $_SESSION['USUARIO_PERFIL_ORIGEN'] = $perfil;

    $_SESSION['USUARIO_CODIGOUNIDAD'] = $codigoUnidadUsuario;
    $_SESSION['USUARIO_CODIGOUNIDAD_ORIGEN'] = $codigoUnidadUsuario;

    $_SESSION['USUARIO_TIPOUNIDAD'] = $tipoUnidad;
    $_SESSION['USUARIO_TIPOUNIDAD_ORIGEN'] = $tipoUnidad;

    $_SESSION['USUARIO_DESCRIPCIONUNIDAD'] = $descUnidadUsuario;
    $_SESSION['USUARIO_DESCRIPCIONUNIDAD_ORIGEN'] = $descUnidadUsuario;

    $_SESSION['USUARIO_CODIGOPADREUNIDAD'] = $codigoUnidadPadre;
    $_SESSION['USUARIO_CODIGOPADREUNIDAD_ORIGEN'] = $codigoUnidadPadre;

    $_SESSION['USUARIO_CONTIENEHIJOS'] = $contieneHijos;
    $_SESSION['USUARIO_CONTIENEHIJOS_ORIGEN'] = $contieneHijos;

    $_SESSION['USUARIO_UNIDADPLANCUADRANTE'] = $tienePlanCuadrante;
    $_SESSION['USUARIO_UNIDADPLANCUADRANTE_ORIGEN'] = $tienePlanCuadrante;

    $_SESSION['USUARIO_UNIDADBLOQUEO'] = $unidadBloqueo;
    $_SESSION['USUARIO_UNIDADBLOQUEO_ORIGEN'] = $unidadBloqueo;

    $_SESSION['USUARIO_UNIDADESPECIALIDAD'] = $unidadEspecialidad;
    $_SESSION['USUARIO_UNIDADESPECIALIDAD_ORIGEN'] = $unidadEspecialidad;

    $_SESSION['USUARIO_UNIDADESPECIALIDAD_OLD'] = $unidadEspecialidadO;
    $_SESSION['USUARIO_UNIDADESPECIALIDAD_OLD_ORIGEN'] = $unidadEspecialidadO;

    $_SESSION['USUARIO_UNIDADTIPO'] = $UnidadTipo;
    $_SESSION['USUARIO_UNIDADTIPO_ORIGEN'] = $UnidadTipo;

    $_SESSION['USUARIO_TIPO_UNIDAD'] = $tipoUnidadNew;
    $_SESSION['USUARIO_TIPO_UNIDAD_ORIGEN'] = $tipoUnidadNew;
    $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD'] = $especialidadUnidadNew;
    $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD_ORIGEN'] = $especialidadUnidadNew;

    $_SESSION['FECHA_LIMITE'] = date("d-m-Y", strtotime($fechaLimite));

    $_SESSION['PERMISO_VALIDAR'] = $permisoValidar;
    $_SESSION['PERMISO_REGISTRAR'] = $permisoRegistrar;
    $_SESSION['PERMISO_CONSULTAR_UNIDAD'] = $permisoConsultarUnidad;
    $_SESSION['PERMISO_CONSULTAR_PERFIL'] = $permisoConsultarPerfil;

    $objDBUsuarios = new dbUsuarios;
    $objDBUsuarios->insertBitacoraUsuario($codigoFuncionario, $codigoUnidadUsuario, $fecha_hra_inicio, $ip, $codigoPerfil);

    if (($permisoConsultarUnidad && !$permisoValidar) || $permisoConsultarPerfil) {
        $paginaInicio = "unidades.php?login=true";
    } else {
        if ($permisoValidar) {
            $paginaInicio = "certificacionServicio.php?login=true";
        } else if ($permisoRegistrar && ($tipoUnidad == 30 || $tipoUnidad == 120)) {
            $paginaInicio = "serviciosUnidadesEspecializadas.php?login=true";
        } else if ($permisoRegistrar) {
            $paginaInicio = "servicios.php?login=true";
        }
    }

    header("Location: " . $paginaInicio);
    exit;
} else {
    error_log("Validación de usuario falló para: " . $userName);
    echo "<script>";
    echo "sessionStorage.removeItem('access_token');";
    echo "sessionStorage.removeItem('expires_at');";
    echo "sessionStorage.removeItem('token_type');";
    echo "self.location.href='index.php?ctrl=1';";
    echo "</script>";
}
?>