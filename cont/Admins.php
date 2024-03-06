<?php
    include_once('conexion.php');


    if (isset($_POST['edit_id'])) {
        $id = $_POST['edit_id'];

        $query = "SELECT docentes.id_docente, CONCAT(docentes.nombre,' ', docentes.ape_paterno,' ', docentes.ape_materno) as nombres, 
                docentes.num_tel, doc_admin.usuario, doc_admin.privilegio 
                FROM docentes 
                JOIN doc_admin 
                ON docentes.id_docente=doc_admin.fk_docente
                WHERE doc_admin.usuario='$id'";

        $result = mysqli_query($conexion, $query);

        $data= mysqli_fetch_array($result);
        ?>
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de usuario <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="name" class="form-control col-md-7 col-xs-12" minlength="4" value="<?php echo $data['usuario'];?>" name="name" required="required" type="text" placeholder="Minímo 4 caracteres">
            </div>
        </div>

        <div class="item form-group">
            <label for="password" class="control-label col-md-3">Contraseña *</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="password" type="password" name="password" minlength="5" class="form-control col-md-7 col-xs-12" required="required" placeholder="Minímo 5 caracteres">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Docente al que pertenece *</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="id_docente">
                    <?php 
                        include_once('conexion.php');

                        $consulta="SELECT * FROM docentes";

                        $res=mysqli_query($conexion,$consulta);

                        while ($datos=mysqli_fetch_array($res)) {
                            ?>
                            <option <?php if ($data['nombres'] ==( $datos['nombre']." ".$datos['ape_paterno']." ".$datos['ape_materno'])) echo "selected"; ?> value="<?php echo $datos['id_docente']; ?>"><?php echo $datos['nombre']." ".$datos['ape_paterno']." ".$datos['ape_materno']; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Privilegio *</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="privilegio" required="required">
                    <option <?php if ($data['privilegio'] =='admin') echo "selected"; ?>value="admin">Administrador</option>
                    <option <?php if ($data['privilegio'] =='estandar') echo "selected"; ?> value="estandar">Usuario estándar</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="token" value="<?php echo $data['usuario'];?>">
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar <i class="fa fa-check"></i></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-close"></i></button>
                                   
        </div>
        <?php
    } else if (isset($_POST['borrar'])){
        $user = $_POST['id'];

        $query = "DELETE FROM doc_admin WHERE usuario='$user'";
        $result = mysqli_query($conexion, $query);

        if ($result) {
		
            $respuesta = array(
                'respuesta' => "Success"
            );
            
        } else{
    
            $respuesta = array(
                'respuesta' => 'Fail'
            );
        }
    } else if (isset($_POST['token'])) {
        
        $nombre = $_POST['name'];
        $pass = $_POST['password'];
        $id_doc = $_POST['id_docente'];
        $privilegio = $_POST['privilegio'];
        $user = $_POST['token'];

        if ($pass != "") {
            $pass = md5($pass);
            $query = "UPDATE doc_admin SET fk_docente='$id_doc', usuario='$nombre', contra='$pass', privilegio='$privilegio'  WHERE usuario='$user'";
        } else if ($pass == "") {
            $query = "UPDATE doc_admin SET fk_docente='$id_doc', usuario='$nombre', privilegio='$privilegio'  WHERE usuario='$user'";
        }
        
        $result = mysqli_query($conexion, $query);

        if($result) {
            $respuesta = array(
                'respuesta' => "Success"
            );
        }
    }

    $conexion->close();

    if(isset($respuesta)) {
        die(json_encode($respuesta));
    }
?>