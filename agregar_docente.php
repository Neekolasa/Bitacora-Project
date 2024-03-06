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



 <title>Docentes | Nuevo</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->



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



                    <h2>Agregar nuevo docente</h2>

                    <button type="button" style="margin-left: 20px;" onclick="location.href='ver_docentes.php'" class="btn btn-success"><i style="margin-right: 7px;" class="fas fa-list-ul"></i>Administrar</button>



                    <div class="clearfix"></div>

                    <nav aria-label="breadcrumb" id="bread">

                      <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="ver_docentes.php">Docentes</a></li>

                        <li class="breadcrumb-item active">Nuevo</li>

                      </ol>

                    </nav>



                  </div>



                  <div class="x_content">



                      <br />



                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" autocomplete="off" action="agregar_docente.php" method="post">





                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span class="required">*</span>  

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                              <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-5 col-xs-12" list="nombres">

                          </div>

                        </div>



                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ape_paterno">Apellido paterno <span class="required">*</span>  

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                              <input type="text" id="ape_paterno" name="ape_paterno" required="required" class="form-control col-md-5 col-xs-12" list="nombres" ">

                          </div>

                        </div>



                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ape_materno">Apellido materno <span class="required">*</span>  

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                              <input type="text" id="ape_materno" name="ape_materno" required="required" class="form-control col-md-5 col-xs-12" list="nombres" ">

                          </div>

                        </div>



                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Teléfono <span class="required">*</span>

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                            <input type="tel" id="telefono" name="telefono" required="required" data-validate-length-range="8,20" class="form-control col-md-5 col-xs-12">

                          </div>

                        </div>



                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Correo electrónico <span class="required">*</span>

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                            <input type="email" id="email" name="email" required="required" class="form-control col-md-5 col-xs-12">

                          </div>

                        </div>



                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Confirmar correo <span class="required">*</span>

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                            <input type="email" id="email2" name="confirm_email" data-validate-linked="email" required="required" class="form-control col-md-5 col-xs-12">

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

    include_once('cont/conexion.php');



    if (isset($_POST['token'])) 

    {



      $email=$_POST['email'];

      $email2=$_POST['confirm_email'];



      if ($email==$email2) 

      {

        $telefono=$_POST['telefono'];

        $ape_materno=$_POST['ape_materno'];

        $ape_paterno=$_POST['ape_paterno'];

        $nombre=$_POST['nombre'];



        $consulta="INSERT INTO docentes(nombre,ape_paterno,ape_materno,num_tel,correo_electronico) VALUES('$nombre','$ape_paterno','$ape_materno','$telefono','$email')";

        

        $res=mysqli_query($conexion,$consulta);

        if ($res) 

        {

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