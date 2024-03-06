<?php
    include_once('conexion.php');
    $query = "SELECT bitacora.id_bitacora ,bitacora.fecha, bitacora.fk_alumno,
                formato_carta_comp.id_carta_comp,formato_carta_comp.razon, 
                CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombrec, alumno.fk_grado_grupo, 
                grado_grupo.nombre, grado_grupo.turno 
                FROM bitacora 
                JOIN formato_carta_comp 
                ON bitacora.id_bitacora=formato_carta_comp.fk_carta_comp 
                JOIN alumno 
                ON alumno.id_alumno=bitacora.fk_alumno 
                JOIN grado_grupo 
                ON alumno.fk_grado_grupo=grado_grupo.id_grupo";

    $result = mysqli_query($conexion, $query);

    while($data = mysqli_fetch_array($result)) {

        echo "<tr>";
        echo "<td>".$data['fecha']."</td>
            <td>".utf8_encode($data['nombrec'])."</td>
            <td>".$data['nombre'][0]."</td>
            <td>".$data['nombre'][1]."</td>
            <td>".utf8_encode($data['razon'])."</td>
            <td><button type='button' class='btn btn-primary ver' id=".$data['id_bitacora']." ><i class='fas fa-print'></i></button>
            <button type='button' class='btn btn-danger borrar' id=".$data['id_carta_comp']."><i class='far fa-trash-alt'></i></button></td>";
        echo "</tr>";
    }
?>