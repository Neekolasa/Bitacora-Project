<?php
    include_once('conexion.php');
    $query = "SELECT bitacora.id_bitacora, bitacora.fecha, bitacora.fk_alumno,
    formato_carta_cond.id_carta_cond, formato_carta_cond.retribucion, formato_carta_cond.nombre_padre,
    CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombrec, alumno.fk_grado_grupo, 
    grado_grupo.nombre 
    FROM bitacora 
    JOIN formato_carta_cond ON bitacora.id_bitacora=formato_carta_cond.fk_carta_cond 
    JOIN alumno 
    ON alumno.id_alumno=bitacora.fk_alumno 
    JOIN grado_grupo 
    ON alumno.fk_grado_grupo=grado_grupo.id_grupo";

    $result = mysqli_query($conexion, $query);

    while($data = mysqli_fetch_array($result)) {

        echo "<tr>";
        echo "  <td>".$data['fecha']."</td>
                <td>".utf8_encode($data['nombrec'])."</td>
                <td>".utf8_encode($data['nombre_padre'])."</td>
                <td>".$data['nombre'][0]."</td>
                <td>".$data['nombre'][1]."</td>
                <td>".$data['retribucion']."</td>
                <td><button type='button' class='btn btn-primary ver' id=".$data['id_bitacora']." ><i class='fas fa-print'></i></button>
                <button type='button' class='btn btn-danger borrar' id=".$data['id_carta_cond']."><i class='far fa-trash-alt'></i></button></td>";
        echo "</tr>";
    }
?>