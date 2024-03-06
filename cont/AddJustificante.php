<?php
    include_once('conexion.php');

    $fecha_inicio = $_POST['fecha-inicio'];
    $alumno = $_POST['alumno'];
    $grado = $_POST['grado'];
    $grupo = $_POST['grupo'];
    $dias_just = $_POST['dias-just'];
    $motivo_just = $_POST['motivo'];
    $motivo_bita = $_POST['motivo_bitacora'];

    $name = utf8_decode($alumno);

    $query1 = "SELECT id_alumno from alumno WHERE CONCAT(nombre,' ',ape_paterno, ' ',ape_materno)='$name'";

    $result = mysqli_query($conexion, $query1);

    /*if($result){
        echo "Query 1 OK"; echo "<br>";
    }*/
            
    $a = mysqli_fetch_array($result);

    $id_alumno = $a['id_alumno'];

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    date_default_timezone_set('America/Monterrey');

    $fecha = $fecha_inicio;//date("d.m.Y");
    $hora = date("H:i");

    $query2 = "INSERT INTO bitacora (fecha, hora, motivo, fk_alumno) VALUES ('$fecha', '$hora', '$motivo_bita', '$id_alumno')";
    $result = mysqli_query($conexion, $query2);

    /*if($result){
        echo "Query 2 OK"; echo "<br>";
    }*/
    
    $query2 = "SELECT id_bitacora FROM bitacora WHERE fecha = '$fecha' AND hora = '$hora' AND motivo = '$motivo_bita' AND fk_alumno = '$id_alumno'";
    
    $result = mysqli_query($conexion, $query2);
    $a = mysqli_fetch_array($result);

    $id_bitacora = $a['id_bitacora'];

    /*if($result){
        echo "Query 2.2 OK"; echo "<br>"; echo "iD:"; echo $id_bitacora;
    }*/
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $ruta = "cont/justificante.pdf";

    $query3 = "INSERT INTO formato_justificante (dias_justificar, motivo, ruta, fk_justificante) VALUES ('$dias_just', '$motivo_just', '$ruta', '$id_bitacora')";
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