<?php
    include_once('conexion.php');
    $query = "SELECT alumno.id_alumno, CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombres, alumno.estatus, grado_grupo.nombre, grado_grupo.turno FROM alumno JOIN grado_grupo ON alumno.fk_grado_grupo=grado_grupo.id_grupo";
    $result = mysqli_query($conexion, $query);

    while($data = mysqli_fetch_array($result)) {

        echo "<tr>"; 
        echo "<td>".utf8_encode($data['nombres'])."</td>
                <td>".$data['nombre'][0]."</td>
                <td>".$data['nombre'][1]."</td>
                <td>".$data['turno']."</td>
                <td>".$data['estatus']."</td>
                <td><button type='button' class='btn btn-primary editar' id=".$data['id_alumno']." ><i class='far fa-edit'></i></button>
                <button type='button' class='btn btn-danger borrar' id=".$data['id_alumno']."><i class='far fa-trash-alt'></i></button></td>";
        echo "</tr>";
    }
    /*$res= "";
    $query = "SELECT alumno.id_alumno, CONCAT(alumno.nombre,' ', alumno.ape_materno,' ', alumno.ape_paterno) as nombres, grado_grupo.nombre, grado_grupo.turno FROM alumno JOIN grado_grupo ON alumno.fk_grado_grupo=grado_grupo.id_grupo";
    $result = mysqli_query($conexion, $query);

    //echo "<table align='center'>";
    while($data = mysqli_fetch_array($result)) {

        $res .= "<tr>"; 
        $res .= "<td>".utf8_encode($data['nombres'])."</td>
                <td>".$data['nombre'][0]."</td>
                <td>".$data['nombre'][1]."</td>
                <td>".$data['turno']."</td>";
        $res .= "</tr>";
    }
    //echo "</table>";
    echo $res;*/

?>