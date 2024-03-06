<?php 

  include_once('conexion.php');

  $id=$_POST['modify_id'];

  $consulta="SELECT * FROM docentes WHERE id_docente='$id'";

  $res=mysqli_query($conexion,$consulta);

  while ($resultado=mysqli_fetch_array($res)) 

  {

    $nombre=$resultado['nombre'];

    $ape_paterno=$resultado['ape_paterno'];

    $ape_materno=$resultado['ape_materno'];

    $num_telefono=$resultado['num_tel'];

    $correo=$resultado['correo_electronico'];

  }



?>



                        <div class="form-group">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span class="required">*</span>  

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                              <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-5 col-xs-12" list="nombres" value="<?php echo $nombre ?>">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ape_paterno">Apellido paterno <span class="required">*</span>  

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                              <input type="text" id="ape_paterno" name="ape_paterno" required="required" class="form-control col-md-5 col-xs-12" list="nombres" value="<?php echo $ape_paterno ?>">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ape_materno">Apellido materno <span class="required">*</span>  

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                              <input type="text" id="ape_materno" name="ape_materno" required="required" class="form-control col-md-5 col-xs-12" list="nombres" value="<?php echo $ape_materno ?>">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Teléfono <span class="required">*</span>

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                            <input type="tel" id="telefono" name="telefono" required="required" data-validate-length-range="8,20" class="form-control col-md-5 col-xs-12" value="<?php echo $num_telefono ?>">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Correo electrónico <span class="required">*</span>

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                            <input type="email" id="email" name="email" required="required" class="form-control col-md-5 col-xs-12" value="<?php echo $correo ?>">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Confirmar correo <span class="required">*</span>

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                            <input type="email" id="email2" name="confirm_email" data-validate-linked="email" required="required" class="form-control col-md-5 col-xs-12">

                          </div>

                        </div>





                        <input type="hidden" name="token" value="modify">

                        <input type="hidden" name="id_bit" value="<?php echo $id ?>">





                      <div class="modal-footer">

                          <button type="submit" class="btn btn-success">Guardar <i class="fa fa-check"></i></button>

                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-close"></i></button>

                            

                        </div>