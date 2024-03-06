<?php
    include_once('conexion.php');

    if (isset ($_POST['token'])) {

        $nombre = $_POST['nombre']; //$nombre = utf8_decode($nombre);
        $ape_pat = $_POST['ape-pat']; //$ape_pat = utf8_decode($ape_pat);
        $ape_mat = $_POST['ape-mat']; //$ape_mat = utf8_decode($ape_mat);
        $curp = $_POST['curp']; 
        $fecha_nac = $_POST['fecha-nac']; 
        $grado =$_POST['grado']; 
        $grupo = $_POST['grupo'];  
        $turno = $_POST['turno'];
    
        $gradogrupo = "";
        $gradogrupo .= $grado;
        $gradogrupo .= $grupo; 

        $query = "SELECT id_grupo FROM grado_grupo WHERE nombre='$gradogrupo' AND turno='$turno'";
        $result = mysqli_query($conexion, $query);
        $a = mysqli_fetch_array($result);
        $id_grupo = $a['id_grupo'];

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $query = "INSERT INTO alumno (nombre, ape_paterno, ape_materno, fecha_nac, curp, fk_grado_grupo) VALUES ('$nombre', '$ape_pat', '$ape_mat', '$fecha_nac', '$curp', '$id_grupo')";
        $result = mysqli_query($conexion, $query);

        if($result) {
            $respuesta = array(
                'respuesta' => 'Success'
            );
        } else {
           $respuesta = array(
                'respuesta' => 'Fail'
            );
        }
    
    } else if (isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        $query = "DELETE FROM alumno WHERE id_alumno='$id'";
        $result = mysqli_query($conexion, $query);

        if($result) {
            $respuesta = array(
                'respuesta' => 'Success'
            );
        } else {
           $respuesta = array(
                'respuesta' => 'Fail'
            );
        }
    } else if (isset($_POST['edit_id'])) {
        
        $id = $_POST['edit_id'];
        $query = "SELECT nombre, ape_paterno, ape_materno, fecha_nac, curp, estatus, fk_grado_grupo FROM alumno WHERE id_alumno='$id'";
        $result = mysqli_query($conexion, $query) or die(mysqli_error($conexion));

        $data = mysqli_fetch_array($result);

        $query2 = "SELECT nombre, turno FROM grado_grupo WHERE id_grupo='$data[fk_grado_grupo]'";
        $result2 = mysqli_query($conexion, $query2) or die(mysqli_error($conexion));

        $data2 = mysqli_fetch_array($result2);
        
        ?>
            <div class="form-group" id="no-modal" >
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre (s)<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nombre" name="nombre" required="required" value="<?php echo $data['nombre']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group" id="no-modal">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ape_pat">Apellido Paterno<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="ape-pat" name="ape-pat" required="required" value="<?php echo $data['ape_paterno']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group" id="no-modal">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ape-mat">Apellido Materno<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="ape-mat" name="ape-mat" required="required" value="<?php echo $data['ape_materno']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group" id="no-modal">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="curp">CURP<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                            
                    <input type="text" id="curp" name="curp" oninput="validarInput(this)" value="<?php echo $data['curp']; ?>" required class="form-control col-md-7 col-xs-12">
                    <span id="resultado"></span> 
                </div>
            </div>

            <div class="form-group" id="no-modal">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-nac">Fecha de nacimiento<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class='input-group date' id='myDatepicker'>
                    <input type='text' class="form-control" name="fecha-nac" value="<?php echo $data['fecha_nac']; ?>" required id="fecha-nac"  value="" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>

            <div class="form-group" id="no-modal">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="grado">Grado </label>
                <div class="col-md-1 col-sm-4 col-xs-6">
                    <select id="grado" name="grado" value="<?php echo $data2['nombre'][0]; ?>" required class="form-control col-md-7 col-xs-12">
                        <option <?php if ($data2['nombre'][0] == '1') echo 'selected';?> value="1">1</option>
                        <option <?php if ($data2['nombre'][0] == '2') echo 'selected';?> value="2">2</option>
                        <option <?php if ($data2['nombre'][0] == '3') echo 'selected';?> value="3">3</option>
                    </select>
                </div>
                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="grupo">Grupo </label>
                <div class="col-md-1 col-sm-4 col-xs-6">
                <select id="grupo" name="grupo" required class="form-control col-md-4 col-xs-12">
                    <option <?php if ($data2['nombre'][1] == 'A') echo 'selected';?> value="A">A</option>
                    <option <?php if ($data2['nombre'][1] == 'B') echo 'selected';?> value="B">B</option>
                    <option <?php if ($data2['nombre'][1] == 'C') echo 'selected';?> value="C">C</option>
                    <option <?php if ($data2['nombre'][1] == 'D') echo 'selected';?> value="D">D</option>
                    <option <?php if ($data2['nombre'][1] == 'E') echo 'selected';?> value="E">E</option>
                    <option <?php if ($data2['nombre'][1] == 'F') echo 'selected';?> value="F">F</option>
                </select>
                </div>
                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="turno">Turno </label>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <select id="turno" name="turno" required class="form-control col-md-7 col-xs-12">
                    <option <?php if ($data2['turno'] == 'matutino') echo 'selected';?> value="matutino">Matutino</option>
                    <option <?php if ($data2['turno'] == 'vespertino') echo 'selected';?> value="vespertino">Vespertino</option>
                    <option <?php if ($data2['turno'] == 'intermedio') echo 'selected';?> value="intermedio">Intermedio</option>
                    </select>
                </div>
            </div>
            <div class="form-group" id="no-modal">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estatus">Estatus<span class="required">*</span></label>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <select id="turno" name="estatus" required class="form-control col-md-7 col-xs-12">
                    <option value=""></option>
                    <option <?php if ($data['estatus'] == 'activo') echo 'selected';?> value="activo">Activo</option>
                    <option <?php if ($data['estatus'] == 'suspendido') echo 'selected';?> value="suspendido">Suspendido</option>
                    <option <?php if ($data['estatus'] == 'traspaso') echo 'selected';?> value="traspaso">Traspaso</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Guardar <i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-close"></i></button>
                                   
            </div>
            <input type="hidden" name="update" value="<?php echo $id?>">
            <script src="build/js/bitacora.js"></script>
        <?php
    } else if (isset($_POST['update'])) {

        $nombre = $_POST['nombre']; //$nombre = utf8_decode($nombre);
        $ape_pat = $_POST['ape-pat']; //$ape_pat = utf8_decode($ape_pat);
        $ape_mat = $_POST['ape-mat']; //$ape_mat = utf8_decode($ape_mat);
        $curp = $_POST['curp']; 
        $fecha_nac = $_POST['fecha-nac']; 
        $grado =$_POST['grado']; 
        $grupo = $_POST['grupo'];  
        $turno = $_POST['turno'];
        $estatus = $_POST['estatus'];
        $id = $_POST['update'];
    
        $gradogrupo = "";
        $gradogrupo .= $grado;
        $gradogrupo .= $grupo; 

        $query = "SELECT id_grupo FROM grado_grupo WHERE nombre='$gradogrupo' AND turno='$turno'";
        $result = mysqli_query($conexion, $query);
        $a = mysqli_fetch_array($result);
        $id_grupo = $a['id_grupo'];

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $query = "UPDATE alumno SET nombre='$nombre',ape_paterno='$ape_pat',ape_materno='$ape_mat',fecha_nac='$fecha_nac',curp='$curp',estatus='$curp', estatus='$estatus',fk_grado_grupo='$id_grupo' WHERE id_alumno='$id'";
        $result = mysqli_query($conexion, $query);

        if($result) {
            $respuesta = array(
                'respuesta' => 'Success'
            );
        } else {
           $respuesta = array(
                'respuesta' => 'Fail'
            );
        }

    } else {
        $respuesta = array(
            'respuesta' => 'Fail'
        );
    }

    $conexion->close();
    if(isset($respuesta)) {
        die(json_encode($respuesta));
    }
?>