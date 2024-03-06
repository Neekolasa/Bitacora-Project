<?php
    include_once('conexion.php');

    $padre = $_POST['padre'];
    $alumno = $_POST['alumno'];
    $grado = $_POST['grado'];
    $grupo = $_POST['grupo'];
    $fecha_cita = $_POST['fecha-cita'];
    $hora_cita = $_POST['hora-cita'];
    $observaciones =$_POST['observaciones'];
    
    //$name = utf8_decode($alumno);

    $query1 = "SELECT id_alumno from alumno WHERE CONCAT(nombre,' ',ape_paterno, ' ',ape_materno)='$alumno'";

    $result = mysqli_query($conexion, $query1);

    /*if($result){
        echo "Query 1 OK"; echo "<br>";
    }*/
            
    $a = mysqli_fetch_array($result);

    $id_alumno = $a['id_alumno'];

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    date_default_timezone_set('America/Monterrey');

    $fecha = date("d.m.Y"); //$fecha_inicio;
    $hora = date("H:i");
    $motivo = $_POST['motivo'];

    $query2 = "INSERT INTO bitacora (fecha, hora, motivo, fk_alumno) VALUES ('$fecha', '$hora', '$motivo', '$id_alumno')";
    $result = mysqli_query($conexion, $query2);

    /*if($result){
        echo "Query 2 OK"; echo "<br>";
    }*/
    
    $query2 = "SELECT id_bitacora FROM bitacora WHERE fecha = '$fecha' AND hora = '$hora' AND motivo = '$motivo' AND fk_alumno = '$id_alumno'";
    
    $result = mysqli_query($conexion, $query2);
    $a = mysqli_fetch_array($result);

    $id_bitacora = $a['id_bitacora'];

    /*if($result){
        echo "Query 2.2 OK"; echo "<br>"; echo "iD:"; echo $id_bitacora;
    }*/
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $query3 = "INSERT INTO formato_citatorio (nombre_padre, fecha_citatorio, hora_citatorio, observaciones, fk_citatorio) VALUES ('$padre', '$fecha_cita', '$hora_cita', '$observaciones', '$id_bitacora')";
    $result = mysqli_query($conexion, $query3) or die(mysqli_error($conexion));

    /*if($result){
        echo "Query 3 OK"; echo "<br>"; 
    }*/
    

	if ($result) {
		
		$respuesta = array(
			'respuesta' => "Success"
		);
		
	} else{

		$respuesta = array(
			'respuesta' => 'Fail'
		);
    }
        $conexion->close();
        die(json_encode($respuesta));
?>