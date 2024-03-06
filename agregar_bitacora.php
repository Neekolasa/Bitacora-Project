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

 <title>Bitacora | Nuevo</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->

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

                    <h2>Agregar nuevo dato a bitácora</h2>

                    <button type="button" style="margin-left: 20px;" onclick="location.href='bitacora.php'" class="btn btn-success"><i style="margin-right: 7px;" class="fas fa-list-ul"></i>Administrar</button>

                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="bitacora.php">Bitacora</a></li>
                        <li class="breadcrumb-item active">Nuevo</li>
                      </ol>
                    </nav>

                  </div>

                  <div class="x_content">

                      <br />

                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" autocomplete="off" action="agregar_bitacora.php" method="post">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">Fecha<span class="required">*</span>

                        </label>

                        <div class="form-group">

                          <div class="col-md-6 col-sm-6 col-xs-12">

                            <div class='input-group date' id='myDatepicker2'>

                              

                                <input readonly name="fecha" type='text' id="fecha" class="form-control col-md-6 col-xs-12" value="<?php echo $dia?>" />

                               

                                <span class="input-group-addon">

                                   <span class="glyphicon glyphicon-calendar"></span>

                                </span>



                            </div>

                          </div>

                          

                        </div>



                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alumno">Nombre del alumno<span class="required">*</span>  

                          </label>

                          <div class="col-md-5 col-sm-5 col-xs-12">

                              <input type="text" id="alumno" name="alumno" required="required" class="form-control col-md-5 col-xs-12" list="nombres" onSelect="fill();" onkeyup="busqueda();">

                              <datalist id="nombres">

                              </datalist>

                          </div>

                        </div>



                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="grado">Grado </label>

                          <div class="col-md-1 col-sm-4 col-xs-6">

                              <select  readonly id="grado" name="grado" required class="form-control col-md-7 col-xs-12">

                                

                                <option value="1">1</option>

                                <option value="2">2</option>

                                <option value="3">3</option>

                              </select>

                          </div>

                            <label class="control-label col-md-1 col-sm-3 col-xs-12" for="grupo">Grupo </label>

                            <div class="col-md-1 col-sm-4 col-xs-6">

                              <select readonly id="grupo" name="grupo" required class="form-control col-md-4 col-xs-12">

                               

                                <option value="A">A</option>

                                <option value="B">B</option>

                                <option value="C">C</option>

                                <option value="D">D</option>

                                <option value="E">E</option>

                                <option value="F">F</option>

                              </select>

                            </div>

                          </div>







                        <div class="form-group" id="no-modal">

                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="motivo">Motivo<span class="required">*</span>

                          </label>

                          <div class="col-md-5 col-sm-6 col-xs-12">

                              <input type="text" id="motivo" name="motivo" required class="form-control col-md-5 col-xs-12">

                          </div>

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

      $nombre=$_POST['alumno'];

      $grado_grupo=$_POST['grado'].$_POST['grupo'];

      $motivo=$_POST['motivo'];

      $fecha=$_POST['fecha'];



    

      $selec_id="SELECT id_alumno, nombre, ape_paterno, ape_materno FROM alumno";

      $res=mysqli_query($conexion,$selec_id);

      

        while ($a=mysqli_fetch_array($res)) 

        {

          $id=$a['id_alumno'];

          $nom=$a['nombre']." ".$a['ape_paterno']." ".$a['ape_materno'];

          if ($nom==$nombre) 

          {

            date_default_timezone_set('America/Monterrey');

            $hora = date("H:i");

            

            $identificador=$id;

            

            $consulta="INSERT INTO bitacora(fecha,hora,motivo,fk_alumno) VALUES('$fecha','$hora','$motivo',$identificador)";

            $resultado=mysqli_query($conexion,$consulta);

            

            

            //echo "<script>alert('$id \+ $hora')</script>";

            

          }

          

          

        }

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

 