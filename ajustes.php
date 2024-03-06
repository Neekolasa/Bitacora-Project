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

<?php

    include_once 'templates/head.php';

    if (isset($_GET['backup'])=='yes')

      {
        if ($privilegio=='estandar') 
        {
          echo "<script>window.location.replace('inicio.php')</script>";
        }
        else
        {
          $db_host="santacruza.proyectosutd.com";

          $db_name="proyec23_santacruza";

          $db_user="proyec23_usana";

          $db_pass="O4RPCWR8RB";

            

          $fecha = date("Ymd-His");

          $salida_sql = $db_name.'_'.$fecha.'.sql'; 

          $dump = "mysqldump --opt -h $db_host -u $db_user -p$db_pass $db_name | gzip > $salida_sql";

          system($dump,$output);

          

          $zip = new ZipArchive();

          $salida_zip = $db_name.'_'.$fecha.'.zip';

          if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true) 

          { 

            $zip->addFile($salida_sql);

            $zip->close();

            unlink($salida_sql);

            header ("Location: $salida_zip");

          } 

          else 

          {

            echo 'Error';

          }                    
        }

        

      }
?>

 <title>Administración | Ajustes</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->

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

                    <h2>Ajustes</h2>

                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="veradmins.php">Administradores</a></li>
                        <li class="breadcrumb-item active">Ajustes</li>
                      </ol>
                    </nav>
                  </div>

                  <div class="x_content">

                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

               

                        <div class="box-part text-center">

                            <i class="far fa-save"></i>

                                      

                          <div class="title">

                            <h4>Respaldo de información</h4>

                          </div>

                                      

                          <div class="text">

                            <span>Crea un backup de la base de datos existente. Descarga una copia en formato SQL de las tablas e información almacenada comprimidos en un archivo ZIP.</span>

                          </div>

                                      

                          <a href="?backup=yes">Realizar respaldo</a>

                          <?php 



                          ?>

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

