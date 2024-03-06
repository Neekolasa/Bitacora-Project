<?php
    require_once("conexion.php");

    $name = $_POST['name'];

    if ($name != "") {
        $name = utf8_decode($name);

        //echo $name; echo "<br>";

        $query = "SELECT  fk_grado_grupo from alumno WHERE CONCAT(nombre,' ',ape_paterno, ' ',ape_materno)='$name'";

        $result = mysqli_query($conexion, $query) or die(mysqli_error($conexion));

        if (mysqli_affected_rows($conexion) <= 0) {

            $name = utf8_decode($name);
            $query = "SELECT  fk_grado_grupo from alumno WHERE CONCAT(nombre,' ',ape_paterno, ' ',ape_materno)='$name'";

            $result = mysqli_query($conexion, $query) or die(mysqli_error($conexion));

            if (mysqli_affected_rows($conexion) <= 0) {

                $name = utf8_encode($name);
                $query = "SELECT  fk_grado_grupo from alumno WHERE CONCAT(nombre,' ',ape_paterno, ' ',ape_materno)='$name'";
    
                $result = mysqli_query($conexion, $query) or die(mysqli_error($conexion));

                $a = mysqli_fetch_array($result);
                //echo $a['fk_grado_grupo'];        
                $query = "select nombre, turno from grado_grupo where id_grupo='".$a['fk_grado_grupo']."'";
        
                $result = mysqli_query($conexion, $query);
        
                $res = mysqli_fetch_array($result);
        
                $nombre= $res['nombre'];
                $turno = $res['turno'];
        
                $respuesta = array(
                    'nombre' => $nombre,
                    'turno' => $turno
                );

            } else if (mysqli_affected_rows($conexion) > 0) {

                $a = mysqli_fetch_array($result);
                //echo $a['fk_grado_grupo'];        
                $query = "select nombre, turno from grado_grupo where id_grupo='".$a['fk_grado_grupo']."'";
        
                $result = mysqli_query($conexion, $query);
        
                $res = mysqli_fetch_array($result);
        
                $nombre= $res['nombre'];
                $turno = $res['turno'];
        
                $respuesta = array(
                    'nombre' => $nombre,
                    'turno' => $turno
                );
            }

        } else if (mysqli_affected_rows($conexion) > 0) {

            $a = mysqli_fetch_array($result);
            //echo $a['fk_grado_grupo'];        
            $query = "select nombre, turno from grado_grupo where id_grupo='".$a['fk_grado_grupo']."'";
    
            $result = mysqli_query($conexion, $query);
    
            $res = mysqli_fetch_array($result);
    
            $nombre= $res['nombre'];
            $turno = $res['turno'];
    
            $respuesta = array(
                'nombre' => $nombre,
                'turno' => $turno
            );
        }
        
        die(json_encode($respuesta));

        $conexion->close();
    }
    
?>