<?php
    include_once('conexion.php');
    $query = "SELECT bitacora.id_bitacora ,bitacora.fecha, bitacora.fk_alumno, 
                formato_citatorio.id_citatorio, formato_citatorio.nombre_padre, formato_citatorio.fecha_citatorio, formato_citatorio.hora_citatorio, 
                CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombrec, alumno.fk_grado_grupo, 
                grado_grupo.nombre 
                FROM bitacora JOIN formato_citatorio 
                ON bitacora.id_bitacora=formato_citatorio.fk_citatorio 
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
                <td>".$data['fecha_citatorio']."</td>
                <td>".$data['hora_citatorio']."</td>
                <td><button type='button' class='btn btn-primary ver' id=".$data['id_bitacora']." ><i class='fas fa-print'></i></button>
                <button type='button' class='btn btn-danger borrar' id=".$data['id_citatorio']."><i class='far fa-trash-alt'></i></button></td>";
        echo "</tr>";
    }
?>