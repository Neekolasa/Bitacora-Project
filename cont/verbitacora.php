<?php
    include_once('conexion.php');
     $consulta="SELECT bitacora.fecha,bitacora.hora,bitacora.motivo, alumno.id_alumno,bitacora.id_bitacora,alumno.nombre,alumno.ape_paterno,alumno.ape_materno, grado_grupo.nombre as grado_grupo, grado_grupo.turno FROM bitacora JOIN alumno on fk_alumno=id_alumno JOIN grado_grupo ON fk_grado_grupo=id_grupo";
                          $resultado=mysqli_query($conexion,$consulta);
                          while ($res=mysqli_fetch_array($resultado)) 
                          {
                            echo "
                              <tr>
                                <td>$res[fecha]</td>
                                <td>$res[hora]</td>
                                <td>$res[nombre]</td>
                                <td>$res[ape_paterno]</td>
                                <td>$res[ape_materno]</td>
                                <td>$res[grado_grupo]</td>
                                <td>$res[turno]</td>
                                <td>$res[motivo]</td>
                                <td>
                                  <button type='button' class='btn btn-danger borrar_bita' id=$res[id_bitacora]><i class='far fa-trash-alt'></i></button>
                                </td>

                              </tr>
                            ";
                          }


?>