<?php
$servername = "localhost";
$username = "root";
$password = "alberto";
$dbname = "just";
// Create connection
$usuario = $_POST['user'];
$pass = $_POST['pass'];
 
if(empty($usuario) || empty($pass)){
  header("Location: index.html");
  echo  "no contiene los dos datos";
  exit();
}
 
mysql_connect('localhost','root','alberto') or die("Error al conectar " . mysql_error());
mysql_select_db('just') or die ("Error al seleccionar la Base de datos: " . mysql_error());
 
$result = mysql_query("SELECT * from UserName where userName='" . $usuario . "'");
 
if($row = mysql_fetch_array($result)){
  if($row['pass'] == $pass){
  session_start();
  $_SESSION['usuario'] = $usuario;
  header("Location: index.php");
  }else{
    echo "no eres usuario cabron";
  }
}
mysql_close();
?>