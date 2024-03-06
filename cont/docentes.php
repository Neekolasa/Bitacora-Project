<?php 
	include_once 'conexion.php';
	$id=$_POST['borrar_docente'];
	$consulta="DELETE FROM docentes WHERE id_docente='$id'";
	mysqli_query($conexion,$consulta);
?>