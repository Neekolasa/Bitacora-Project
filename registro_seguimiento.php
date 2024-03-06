<!DOCTYPE html>
<html lang="es">
<?php
    include_once 'templates/head.php';
?>
 <title>Formatos | Registro de Seguimiento</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
  <body class="nav-md">
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
                    <h2>Registro de Seguimiento</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      Aqui va el contenido de la página ...
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Registrar Nuevo <i class="fa fa-plus"></i></button>

                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <h4>Text in a modal</h4>
                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
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
