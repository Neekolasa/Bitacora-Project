<?php
    include_once('conexion.php');

    if(isset($_POST['formato'])) {

        $formato = $_POST['formato'];
        $id = $_POST['id'];

        if($formato == 'carta_cond') {

            $query = "DELETE FROM formato_carta_cond WHERE id_carta_cond='$id'";
            $result = mysqli_query($conexion, $query);

            if($result){
                $respuesta = array(
                    'respuesta' => 'Success'
                );
            }

        } else if ($formato == 'carta_comp') {
            
            $query = "DELETE FROM formato_carta_comp WHERE id_carta_comp='$id'";
            $result = mysqli_query($conexion, $query);

            if($result){
                $respuesta = array(
                    'respuesta' => 'Success'
                );
            }
        } else if ($formato == 'citatorio') {
            
            $query = "DELETE FROM formato_citatorio WHERE id_citatorio='$id'";
            $result = mysqli_query($conexion, $query);

            if($result){
                $respuesta = array(
                    'respuesta' => 'Success'
                );
            }
        } else if ($formato == 'justificante') {
            
            $query = "DELETE FROM formato_justificante WHERE id_justificante='$id'";
            $result = mysqli_query($conexion, $query);

            if($result){
                $respuesta = array(
                    'respuesta' => 'Success'
                );
            }
        }

    } else {
        $respuesta = array(
			'respuesta' => 'Fail'
        );
    }
        
    $conexion->close();
    die(json_encode($respuesta));
?>