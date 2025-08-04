<?php
  include("./inc/configV4.inc.php");
  $host = HOST;
  $user = DB_USER;
  $pass = DB_PASS;
  $db = DB;

  echo "Intentando conectar a $host con usuario $user y base $db<br>";
  $conn = @mysql_connect($host, $user, $pass);
  if (!$conn) {
      die("Error de conexion: " . mysql_error() . "<br>");
  } else {
      echo "Conexion exitosa!<br>";
      if (mysql_select_db($db, $conn)) {
          echo "Base de datos $db seleccionada correctamente.<br>";
      } else {
          die("Error al seleccionar la base de datos: " . mysql_error() . "<br>");
      }
      mysql_close($conn);
  }
  ?>