<?php 
  session_start();
  if (!isset($_SESSION['usuario']))
  {
      echo "<script>window.location.replace('login.php')</script>";
  }
  else
  {
    $privilegio=$_SESSION['privilegio'];
  }
?>
<!DOCTYPE html>
<html lang="es">
<?php
    include_once 'templates/head.php';
?>
 <title>Formatos | Citatorio</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
<?php
    include_once 'templates/barra.php';

    include_once 'templates/navegacion.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"> <!-- Barra de busqueda dentro de la sección principal de la página-->
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Citatorio</h2>
                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Formatos</a></li>
                        <li class="breadcrumb-item active">Citatorio</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="x_content">
                      <button type="button" class="btn btn-success admin" data-toggle="modal" data-target=".bs-example-modal-lg">Registrar Nuevo <i class="fa fa-plus"></i></button>

                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Fecha (dd/mm/aaa)</th>
                          <th>Alumno</th>
                          <th>Padre/Tutor</th>
                          <th>Grado</th>
                          <th>Grupo</th>
                          <th>Fecha Cita</th>
                          <th>Hora Cita</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                          <?php
                                include_once('cont/conexion.php');
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
                                          <td>".$data['nombrec']."</td>
                                          <td>".$data['nombre_padre']."</td>
                                          <td>".$data['nombre'][0]."</td>
                                          <td>".$data['nombre'][1]."</td>
                                          <td>".$data['fecha_citatorio']."</td>
                                          <td>".$data['hora_citatorio']."</td>
                                          <td><button type='button' class='btn btn-primary ver' id=".$data['id_bitacora']." ><i class='fas fa-print'></i></button>
                                          <button type='button' class='btn btn-danger borrar admin' id=".$data['id_citatorio']."><i class='far fa-trash-alt'></i></button></td>";
                                  echo "</tr>";
                                }
                          ?>
                      </tbody>
                    </table>

                      <div class="modal fade bs-example-modal-lg" id="modalwindow" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">Registrar nuevo citatorio</h4>
                              </div>
                            <div class="modal-body">
                                <form id="citatorio" data-parsley-validate="" autocomplete="off" method="post" action="cont/AddCitatorio.php" class="form-horizontal form-label-left">

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="padre">Nombre del Padre/Madre <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="padre" name="padre" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">Fecha de la cita<span class="required">*</span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                          <div class='input-group date' id='myDatepicker'>
                                              <input type='text' class="form-control" name="fecha-cita" id="fecha-cita"  value="" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                          </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hora-cita">Hora de la cita <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class='input-group date' id='myDatepicker4'>
                                            <input type='text' class="form-control" name="hora-cita" id="hora-cita" />
                                            <span class="input-group-addon">
                                              <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alumno">Nombre del Alumno <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="alumno" name="alumno" required="required" class="form-control col-md-7 col-xs-12" list="nombres" onchange="fill();" onkeyup="busqueda();">
                                      <datalist id="nombres">
                                      </datalist>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="grado">Grado </label>
                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                      <input type="text" id="grado" name="grado" required="required" readonly class="form-control col-md-7 col-xs-12">
                                    </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="grupo">Grupo </label>
                                      <div class="col-md-2 col-sm-4 col-xs-6">
                                        <input type="text" id="grupo" name="grupo" required="required" readonly class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="observaciones">Observaciones <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="resizable_textarea form-control" id="observaciones" name="observaciones"></textarea>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="motivo">Motivo (para registrar en bitacora) <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="resizable_textarea form-control" id="motivo" name="motivo"></textarea>
                                    </div>
                                  </div>
                                  
                                  <div class="modal-footer">
                                     <button type="submit" class="btn btn-success">Guardar <i class="fa fa-check"></i></button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-close"></i></button>
                                   
                                  </div>
                                </form>
                            </div>
                          </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php  
    include_once 'templates/footer.php';
?>
  </body>
</html>
<script src="build/js/citatorio.js"></script>
<script src="vendors/validator/validator.js"></script>
<script type="text/javascript">
  
  var privilegio='<?php echo $privilegio ?>';
  gestor_recursos(privilegio);

</script>
