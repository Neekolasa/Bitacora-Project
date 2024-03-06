<?php 
  session_start();
  if (!isset($_SESSION['usuario']))
  {
      echo "<script>window.location.replace('login.php')</script>";
  }
  else
  {
    $privilegio=$_SESSION['privilegio'];
    if ($privilegio=='estandar') 
    {
      echo "<script>window.location.replace('inicio.php')</script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8">
<?php
    include_once 'templates/head.php';
?>
 <title>Administración | Nuevo</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
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
                    <h2>Agregar nuevo usuario al sistema</h2>
                    <button type="button" style="margin-left: 20px;" onclick="location.href='veradmins.php'" class="btn btn-success"><i style="margin-right: 7px;" class="fas fa-list-ul"></i>Administrar</button>
                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="veradmins.php">Administradores</a></li>
                        <li class="breadcrumb-item active">Nuevo</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="x_content">

                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" autocomplete="off" action="admins.php" method="post">

                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de usuario <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="name" class="form-control col-md-7 col-xs-12" minlength="4" name="name" required="required" type="text" placeholder="Minímo 4 caracteres">
                            </div>
                        </div>

                        <div class="item form-group">
                          <label for="password" class="control-label col-md-3">Contraseña *</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" type="password" name="password" minlength="5" class="form-control col-md-7 col-xs-12" required="required" placeholder="Minímo 5 caracteres">
                          </div>
                        </div>

                        <div class="item form-group">
                          <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repetir contraseña *</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                          </div>
                        </div>
                      
                        <!--<div class="item form-group">
                          <label for="mail" class="control-label col-md-3 col-sm-3 col-xs-12">Correo electrónico *</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="mail" type="mail" name="mail" class="form-control col-md-7 col-xs-12" required="required">
                          </div>
                        </div>-->

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Docente al que pertenece *</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="id_docente">
                          	<?php 

      		                     	include_once('cont/conexion.php');

      		                     	$consulta="SELECT * FROM docentes";

      		                     	$res=mysqli_query($conexion,$consulta);

      		                     	while ($datos=mysqli_fetch_array($res)) {

      								            echo "<option value=".$datos['id_docente'].">".$datos['nombre']." ".$datos['ape_paterno']." ".$datos['ape_materno']."</option>";

      		                     	}

    		                     ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Privilegio *</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="privilegio" required="required">
                            	<option value="admin">Administrador</option>
                            	<option value="estandar">Usuario estándar</option>
                            </select>
                          </div>
                        </div>

                        <input type="hidden" name="token" value="insert">

                        <div class="ln_solid"></div>

                        <div class="form-group" id="no-modal">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
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

    include_once('cont/conexion.php');

    if (isset($_POST['token'])) 
    {

    	$user=$_POST['name'];

    	$password=md5($_POST['password']);

    	$privilegio=$_POST['privilegio'];

    	$id_docente=$_POST['id_docente'];

      
     	

     	$consulta="INSERT INTO doc_admin VALUES($id_docente,'$user','$password','$privilegio')";

      	$resultado=mysqli_query($conexion,$consulta);

        if ($resultado==1) {

              echo "<script>
                    Swal.fire(
                    'Correcto',
                    'El registro se agregó correctamente',
                    'success');
                  </script>" ;
            }
            else
            {
              echo "<script>
                    Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Algo ha salido mal, por favor verifique los datos'
                    })
                    </script>";
            }
  }
?>
  </body>
</html>
<script src="vendors/validator/validator.js"></script>