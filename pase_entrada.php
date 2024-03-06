
<!DOCTYPE html>
<html lang="es">
<?php
    include_once 'templates/head.php';
?>
 <title>Formatos | Pase de Entrada</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
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
                    <h2>Pase de Entrada</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Registrar Nuevo <i class="fa fa-plus"></i></button>
                      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">Registrar nuevo pase de entrada</h4>
                              </div>
                            <div class="modal-body">
                                <form id="pase-entrada" method="post" action="" autocomplete="off" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                                  
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">Fecha <span class="required">*</span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                          <div class='input-group date' id='myDatepicker'>
                                              <input type='text' class="form-control" name="fecha-inicio" id="fecha-inicio"  value="" />
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
                                      <input type="text" id="alumno" name="alumno" required="required" class="form-control col-md-7 col-xs-12" list="nombres" onSelect="fill();" onkeyup="busqueda();">
                                      <datalist id="nombres">
                                      </datalist>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="maestro">Nombre del Maestro <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="maestro" name="maestro" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="minutos">Minutos (estancia) <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input type="number" id="minutos" name="minutos" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modulo">Modulo <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input type="number" id="modulo" name="modulo" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>
                                  
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-close"></i></button>
                                    <button type="submit" class="btn btn-success">Guardar <i class="fa fa-check"></i></button>
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
