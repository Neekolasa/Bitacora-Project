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
 <title>Alumnos | Administrar</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
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
                    <h2>Ver lista de alumnos</h2>
                    <button type="button" style="margin-left: 20px;" onclick="location.href='registrar_alumno.php'" class="btn btn-success admin"><i style="margin-right: 7px;" class="fas fa-plus-square"></i>Nuevo</button>
                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Alumnos</a></li>
                        <li class="breadcrumb-item active">Administrar</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <!--<button type="button" class="btn btn-round btn-info refrescar">Refrescar datos <i class="fas fa-refresh"></i></button>-->

                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Grado</th>
                          <th>Grupo</th>
                          <th>Turno</th>
                          <th>Estatus</th>
                          <th class="admin">Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                          <?php
                                include_once('cont/conexion.php');
                                $query = "SELECT alumno.id_alumno, CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombres, alumno.estatus, grado_grupo.nombre, grado_grupo.turno FROM alumno JOIN grado_grupo ON alumno.fk_grado_grupo=grado_grupo.id_grupo";
                                $result = mysqli_query($conexion, $query);
                            
                                while($data = mysqli_fetch_array($result)) {
                            
                                    echo "<tr>"; 
                                    echo "<td>".$data['nombres']."</td>
                                            <td>".$data['nombre'][0]."</td>
                                            <td>".$data['nombre'][1]."</td>
                                            <td>".$data['turno']."</td>
                                            <td>".$data['estatus']."</td>
                                            <td class='admin'><button type='button' class='btn btn-primary editar admin' data-toggle='modal' data-target='.bs-example-modal-lg' id=".$data['id_alumno']." ><i class='far fa-edit'></i></button>
                                            <button type='button' class='btn btn-danger borrar admin' id=".$data['id_alumno']."><i class='far fa-trash-alt'></i></button></td>";
                                    echo "</tr>";
                                }
                          ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Modificar información del alumno</h4>
                </div>
                <div class="modal-body">
                  <form form id="update-alumno" data-parsley-validate method="post" action="cont/Alumnos.php" class="form-horizontal form-label-left">
                  </form>
                </div>
            </div>
        </div>
      </div>
<?php  
    include_once 'templates/footer.php';
?>
  </body>
</html>
<script src="build/js/alumnos.js"></script>
<script src="build/js/curp.js"></script>
<style type="text/css">
  #resultado {
      color: red;
     
  }
  #resultado.ok {
      color: green;
  }
</style>
<script type="text/javascript">
  
  var privilegio='<?php echo $privilegio ?>';
  gestor_recursos(privilegio);

</script>

