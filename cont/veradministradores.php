<?php  
	include_once('cont/conexion.php');
    $query = "SELECT docentes.id_docente, CONCAT(docentes.nombre,' ', docentes.ape_paterno,' ', docentes.ape_materno) as nombres, docentes.num_tel, doc_admin.usuario, doc_admin.privilegio FROM docentes JOIN doc_admin ON docentes.id_docente=doc_admin.fk_docente";
    $result = mysqli_query($conexion, $query);
                            
    while($data = mysqli_fetch_array($result)) 
    {
                            
        echo "<tr>"; 
        echo "<td>".$data['id_docente']."</td>
           <td>".$data['nombres']."</td>
           <td>".$data['num_tel']."</td>
           <td>".$data['usuario']."</td>
           <td>".$data['privilegio']."</td>
           <td><button type='button' class='btn btn-primary editar' data-toggle='modal' data-target='.bs-example-modal-lg' id=".$data['id_docente']." ><i class='far fa-edit'></i></button>
            <button type='button' class='btn btn-danger borrar' id=".$data['id_docente']."><i class='far fa-trash-alt'></i></button></td>";
        echo "</tr>";
    }

?>