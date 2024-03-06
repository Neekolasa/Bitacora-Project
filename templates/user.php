<?php
	session_start();
	include_once 'cont/conexion.php';
  	$user=$_SESSION['usuario'];
	
	$consulta="SELECT docentes.nombre FROM doc_admin JOIN docentes ON fk_docente=id_docente WHERE usuario='$user'";
	
	$res=mysqli_query($conexion,$consulta);
	while ($resu=mysqli_fetch_assoc($res)) 
	{
		$nombre=$resu['nombre'];
	}
?>