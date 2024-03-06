<?php 
	require_once("conexion.php");

	$result= "";

    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    if ($name != "") {

        $query = "SELECT id_alumno from alumno WHERE CONCAT(nombre,ape_paterno,ape_materno) LIKE '%".$name."%'";

        $ex = mysqli_query($conexion, $query);
        
        while ($a = mysqli_fetch_array($ex)) {
            $result.= "<option>";
            $result.= $a["nombre"]." ".$a['ape_paterno']." ".$a['ape_materno'];
            $result.= "</option>";
        }
        /*$respuesta = array(
            'nombre' => $result
        );*/
        echo $result;
    }
?>