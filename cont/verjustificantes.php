<?php
    include_once('conexion.php');

    $query = "SELECT bitacora.id_bitacora ,bitacora.fecha, 
                formato_justificante.id_justificante, formato_justificante.dias_justificar, formato_justificante.motivo, 
                CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombrec, alumno.fk_grado_grupo, 
                grado_grupo.nombre 
                FROM bitacora JOIN formato_justificante 
                ON bitacora.id_bitacora=formato_justificante.fk_justificante 
                JOIN alumno 
                ON alumno.id_alumno=bitacora.fk_alumno 
                JOIN grado_grupo 
                ON alumno.fk_grado_grupo=grado_grupo.id_grupo
                WHERE 1";

    $result = mysqli_query($conexion, $query);

    while($data = mysqli_fetch_array($result)) {                  

        echo "<tr>";
        echo "  <td>".$data['fecha']."</td>
                <td>".utf8_encode($data['nombrec'])."</td>
                <td>".$data['nombre'][0]."</td>
                <td>".$data['nombre'][1]."</td>
                <td>".$data['dias_justificar']."</td>
                <td>".$data['motivo']."</td>
                <td><button type='button' class='btn btn-primary ver' id=".$data['id_bitacora']." ><i class='fas fa-print'></i></button>
                <button type='button' class='btn btn-danger borrar' id=".$data['id_justificante']."><i class='far fa-trash-alt'></i></button></td>";
        echo "</tr>";
    }

?>