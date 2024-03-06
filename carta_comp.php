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

  date_default_timezone_set('America/Monterrey');
  $dia=date('d.m.Y');
?>
<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8">
<?php
    include_once 'templates/head.php';
?>
 <title>Formatos | Carta de compromiso</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
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
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Carta de compromiso</h2>
                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Formatos</a></li>
                        <li class="breadcrumb-item active">Carta de compromiso</li>
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
                          <th>Grado</th>
                          <th>Grupo</th>
                          <th>Razón</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                          <?php
                                include_once('cont/conexion.php');
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
                                        <td>".$data['nombrec']."</td>
                                        <td>".$data['nombre'][0]."</td>
                                        <td>".$data['nombre'][1]."</td>
                                        <td>".$data['razon']."</td>
                                        <td><button type='button' class='btn btn-primary ver' id=".$data['id_bitacora']." ><i class='fas fa-print'></i></button>
                                        <button type='button' class='btn btn-danger borrar admin' id=".$data['id_carta_comp']."><i class='far fa-trash-alt'></i></button></td>";
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
                                  <h4 class="modal-title" id="myModalLabel">Registrar nueva carta de compromiso</h4>
                              </div>
                            <div class="modal-body">
                                <form id="carta-comp" method="post" autocomplete="off" action="cont/AddCartaComp.php" data-parsley-validate="" class="form-horizontal form-label-left">
                                  
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">Fecha <span class="required">*</span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                          <div class='input-group date' id='myDatepicker'>
                                              <input readonly name="fecha" type='text' id="fecha" class="form-control col-md-6 col-xs-12" value="<?php echo $dia?>"/>
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
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
                                    <label class="control-label col-md-3 col-sm-3" for="grado">Grado </label>
                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                      <input type="text" id="grado" name="grado" required="required" readonly class="form-control col-md-7 col-xs-12">
                                    </div>
                                      <label class="control-label col-md-2 col-sm-2" for="grupo">Grupo </label>
                                      <div class="col-md-2 col-sm-4 col-xs-6">
                                        <input type="text" id="grupo" name="grupo" required="required" readonly class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="turno">Turno </label>
                                    <div class="col-md-4 col-sm-1 col-xs-12">
                                      <input type="text" id="turno" name="turno" required="required" readonly class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="razon">Razón<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="resizable_textarea form-control" id="razon" name="razon"></textarea>
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
<script src="build/js/carta_comp.js"></script>
<script src="vendors/validator/validator.js"></script>
<script type="text/javascript">
  
  var privilegio='<?php echo $privilegio ?>';
  gestor_recursos(privilegio);

</script>
