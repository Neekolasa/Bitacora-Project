<?php 
	include_once('conexion.php');

	$nombre=$_POST['alumno'];
	$grado_grupo=$_POST['grado'].$_POST['grupo'];
	$motivo=$_POST['motivo'];

	if (isset($_POST['token'])) 
	{
		$selec_id="SELECT id_alumno, nombre, ape_paterno, ape_materno FROM alumno";
		$res=mysqli_query($conexion,$selec_id);
		
			while ($a=mysqli_fetch_array($res)) 
			{
				$id=$a['id_alumno'];
				$nom=$a['nombre']." ".$a['ape_paterno']." ".$a['ape_materno'];
				if ($nom==$nombre) 
				{
					$identificador=$id;
					echo "<script>alert('$id')</script>";
					
				} 
				
			}
			
		
	
		
	}
	else if (isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        $query = "DELETE FROM bitacora WHERE id_bitacora='$id'";
        $result = mysqli_query($conexion, $query);
    }
?>