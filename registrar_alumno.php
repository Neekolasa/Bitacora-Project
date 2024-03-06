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
 <title>Alumno | Nuevo</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
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
                    <h2>Agregar un nuevo alumno</h2>
                    <button type="button" style="margin-left: 20px;" onclick="location.href='alumnos.php'" class="btn btn-success"><i style="margin-right: 7px;" class="fas fa-list-ul"></i>Administrar</button>
                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="alumnos.php">Alumnos</a></li>
                        <li class="breadcrumb-item active">Nuevo</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="x_content">

                  <form form id="agrega-alumno" data-parsley-validate method="post" action="cont/Alumnos.php" class="form-horizontal form-label-left">
                    <div class="form-group" id="no-modal">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                    </div>

                      <div class="form-group" id="no-modal">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ape_pat">Apellido Paterno<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="ape-pat" name="ape-pat" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group" id="no-modal">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ape-mat">Apellido Materno<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="ape-mat" name="ape-mat" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group" id="no-modal">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="curp">CURP<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="curp" name="curp" oninput="validarInput(this)" required="required" class="form-control col-md-7 col-xs-12">
                            <span id="resultado"></span> 
                        </div>
                      </div>

                      <div class="form-group" id="no-modal">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-nac">Fecha de nacimiento<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class='input-group date' id='myDatepicker'>
                            <input type='text' class="form-control" name="fecha-nac" required="required" id="fecha-nac"  value="" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group" id="no-modal">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="grado">Grado </label>
                        <div class="col-md-1 col-sm-4 col-xs-6">
                            <select id="grado" name="grado" required="required" class="form-control col-md-7 col-xs-12">
                              <option value=""></option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                        </div>
                          <label class="control-label col-md-1 col-sm-3 col-xs-12" for="grupo">Grupo </label>
                          <div class="col-md-1 col-sm-4 col-xs-6">
                            <select id="grupo" name="grupo" required="required" class="form-control col-md-4 col-xs-12">
                              <option value=""></option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>
                              <option value="D">D</option>
                              <option value="E">E</option>
                              <option value="F">F</option>
                            </select>
                          </div>
                          <label class="control-label col-md-1 col-sm-3 col-xs-12" for="turno">Turno </label>
                          <div class="col-md-2 col-sm-4 col-xs-6">
                              <select id="turno" name="turno" required="required" class="form-control col-md-7 col-xs-12">
                                <option value=""></option>
                                <option value="matutino">Matutino</option>
                                <option value="vespertino">Vespertino</option>
                                <option value="intermedio">Intermedio</option>
                              </select>
                          </div>
                      </div>
                      <input type="hidden" name="token" value="insert">
                    <div class="ln_solid"></div>
                    <div class="form-group" id="no-modal">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        
                        <button type="submit" class="btn btn-success">Guardar <i class="fa fa-check"></i></button>
                        <button class="btn btn-default" type="reset">Limpiar campos<i class="fa fa-trash"></i></button>
                      </div>
                    </div>
                  </form>
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
<script src="vendors/validator/validator.js"></script>
<script src="build/js/curp.js"></script>
<style type="text/css">
  #resultado {
      color: red;
     
  }
  #resultado.ok {
      color: green;
  }
</style>
