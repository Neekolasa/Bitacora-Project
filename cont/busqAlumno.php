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

        $query = "SELECT nombre, ape_paterno, ape_materno from alumno WHERE CONCAT(nombre,ape_paterno,ape_materno) LIKE '%".$name."%'";

        $ex = mysqli_query($conexion, $query);

        if (mysqli_affected_rows($conexion) <= 0) {

            $name = utf8_decode($name);
            $query = "SELECT nombre, ape_paterno, ape_materno from alumno WHERE CONCAT(nombre,ape_paterno,ape_materno) LIKE '%".$name."%'";

            $ex = mysqli_query($conexion, $query);

            if (mysqli_affected_rows($conexion) <= 0) {

                $name = utf8_encode($name);

                $query = "SELECT nombre, ape_paterno, ape_materno from alumno WHERE CONCAT(nombre,ape_paterno,ape_materno) LIKE '%".$name."%'";
    
                $ex = mysqli_query($conexion, $query);

                $result.= "<option>";
                $result.= utf8_encode($a["nombre"]." ".$a['ape_paterno']." ".$a['ape_materno']);
                $result.= "</option>";

            } else if (mysqli_affected_rows($conexion) > 0) {

                while ($a = mysqli_fetch_array($ex)) {

                    $result.= "<option>";
                    $result.= utf8_encode($a["nombre"]." ".$a['ape_paterno']." ".$a['ape_materno']);
                    $result.= "</option>";
                }
            }

        } else if (mysqli_affected_rows($conexion) > 0) {

            while ($a = mysqli_fetch_array($ex)) {

                $result.= "<option>";
                $result.= utf8_encode($a["nombre"]." ".$a['ape_paterno']." ".$a['ape_materno']);
                $result.= "</option>";
            }

        }
        
        echo $result;

        $conexion->close();
    }
?>