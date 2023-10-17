<?php
require_once ("conexion.php");
if(empty($_POST['searchTerm'])){
	$errors[] = "ERROR searchTerm";
}else if (!empty($_POST['searchTerm'])){
	$search = $_POST['searchTerm'];
	$query_select2 = "SELECT Id, subrubro, tipo, articulo, descripcion, precio FROM t_articulos WHERE articulo LIKE '%$search%' OR tipo LIKE '%$search%' OR subrubro LIKE '%$search%'";
	$result_select2 = mysqli_query($conexion,$query_select2);
	$data = array();
	while ($row = mysqli_fetch_array($result_select2)) {
		$data[] = array("id"=>$row['articulo'], "text"=>$row['subrubro'] ." ". $row['articulo']);
	}
	echo json_encode($data);
}
?>