<?php
    include_once('conexion.php');

    $fecha_inicio = $_POST['fecha'];
    $alumno = $_POST['alumno'];
    $grado = $_POST['grado'];
    $grupo = $_POST['grupo'];
    $turno = $_POST['turno'];

    //$name = utf8_decode($alumno);
    //echo $alumno;
    $query1 = "SELECT id_alumno from alumno WHERE CONCAT(nombre,' ',ape_paterno, ' ',ape_materno)='$alumno'";

    $result = mysqli_query($conexion, $query1);

    /*if($result){
        echo "Query 1 OK"; echo "<br>";
    } else {
        echo "Query 1 WRONG"; echo "<br>";
    }*/
            
    $a = mysqli_fetch_array($result);

    $id_alumno = $a['id_alumno'];
    //echo "ID"; echo $id_alumno; echo "<br>";

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    date_default_timezone_set('America/Monterrey');

    $fecha = $fecha_inicio;//date("d.m.Y");
    $hora = date("H:i");
    $motivo = $_POST['motivo'];

    $query2 = "INSERT INTO bitacora (fecha, hora, motivo, fk_alumno) VALUES ('$fecha', '$hora', '$motivo', '$id_alumno')";
    $result = mysqli_query($conexion, $query2);

    /*if($result){
        echo "Query 2 OK"; echo "<br>";
    } else {
        echo "Query 2 WRONG"; echo "<br>";
    }*/
    
    $query2 = "SELECT id_bitacora FROM bitacora WHERE fecha = '$fecha' AND hora = '$hora' AND motivo = '$motivo' AND fk_alumno = '$id_alumno'";
    
    $result = mysqli_query($conexion, $query2);
    $a = mysqli_fetch_array($result);

    $id_bitacora = $a['id_bitacora'];

    /*if($result){
        echo "Query 2.2 OK"; echo "<br>"; echo "iD:"; echo $id_bitacora;
    }*/
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $razon = $_POST['razon'];
    $query3 = "INSERT INTO formato_carta_comp (razon, fk_carta_comp) VALUES ('$razon', '$id_bitacora')";
    $result = mysqli_query($conexion, $query3) or die(mysqli_error($conexion));

    /*if($result){
        echo "Query 3 OK"; echo "<br>"; 
    }*/
    
	if ($result) {
		
		$respuesta = array(
			'respuesta' => 'Success'
		);
		
	} else{

		$respuesta = array(
			'respuesta' => 'Fail'
		);
    }
        $conexion->close();
        die(json_encode($respuesta));
?>