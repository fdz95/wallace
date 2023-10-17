<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "database1";
$conexion = mysqli_connect($host,$user,$password,$database);
if (!$conexion){
	die("ERR_CONNECTION</br></br>SERVER_RESPONSE --->  ". mysqli_error($conexion));
}