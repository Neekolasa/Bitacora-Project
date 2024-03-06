<?php 
	include_once('conexion.php');
	$id=$_POST['modify_id'];
	$consulta="SELECT bitacora.id_bitacora, bitacora.motivo,alumno.nombre,alumno.ape_paterno,alumno.ape_materno,grado_grupo.nombre as grado FROM bitacora JOIN alumno on fk_alumno=id_alumno JOIN grado_grupo on fk_grado_grupo=id_grupo WHERE id_bitacora='$id'";
	$res=mysqli_query($conexion,$consulta);
	
	while ($resultados=mysqli_fetch_array($res)) {
		$nombre=$resultados['nombre']." ".$resultados['ape_paterno']." ".$resultados['ape_materno'];
		$motivo=$resultados['motivo'];
		$grado=$resultados['grado'][0];
		$grupo=$resultados['grupo'][1];
		$id=$resultados['id_bitacora'];
	}
	

?>

						


                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alumno">Nombre del alumno<span class="required">*</span>  

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                              <input type="text" id="alumno" name="alumno" required="required" class="form-control col-md-5 col-xs-12" list="nombres" value="<?php echo $nombre?>" onSelect="fill();" onkeyup="busqueda();">

                              <datalist id="nombres">

                              </datalist>

                          </div>

                        </div>



                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="grado">Grado </label>

                          <div class="col-md-1 col-sm-4 col-xs-6">

                              <select  readonly disabled id="grado" name="grado" required class="form-control col-md-7 col-xs-12">

                                

                                <option value="1" <?php if ($grado==1) {echo "selected";
                                } ?>>1</option>

                                <option value="2" <?php if ($grado==2) {echo "selected";
                                } ?> >2</option>

                                <option value="3" <?php if ($grado==3) {echo "selected";
                                } ?>>3</option>

                              </select>

                          </div>

                            <label class="control-label col-md-1 col-sm-3 col-xs-12" for="grupo">Grupo </label>

                            <div class="col-md-1 col-sm-4 col-xs-6">

                              <select readonly disabled id="grupo" name="grupo" required class="form-control col-md-4 col-xs-12">

                               

                                <option value="A" <?php if ($grupo=="A") echo "selected"; {
                                } ?>>A</option>

                                <option value="B" <?php if ($grupo=="B") echo "selected"; {
                                } ?>>B</option>

                                <option value="C" <?php if ($grupo=="C") echo "selected"; {
                                } ?>>C</option>

                                <option value="D" <?php if ($grupo=="D") echo "selected"; {
                                } ?>>D</option>

                                <option value="E" <?php if ($grupo=="E") echo "selected"; {
                                } ?>>E</option>

                                <option value="F" <?php if ($grupo=="F") echo "selected"; {
                                } ?>>F</option>

                              </select>

                            </div>

                          </div>







                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="motivo">Motivo<span class="required">*</span>

                          </label>

                          <div class="col-md-5 col-sm-6 col-xs-12">

                              <input type="text" id="motivo" name="motivo" required class="form-control col-md-5 col-xs-12" value="<?php echo $motivo ?>">

                          </div>

                        </div>
							<input type="hidden" name="modify">
							<input type="hidden" name="id" value="<?php echo $id?>">
							
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Guardar <i class="fa fa-check"></i></button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-close"></i></button>
                            
                        </div>

<script src="../build/js/alumnos.js"></script>