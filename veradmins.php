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
?>
 <title>Administradores | Administrar</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
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
                    <h2>Ver lista de administradores</h2>
                    <button type="button" style="margin-left: 20px;" onclick="location.href='admins.php'" class="btn btn-success"><i style="margin-right: 7px;" class="fas fa-plus-square"></i>Nuevo</button>
                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Administradores</a></li>
                        <li class="breadcrumb-item active">Administrar</li>
                      </ol>
                    </nav>
                  </div>

                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <!--<button type="button" class="btn btn-round btn-info refrescaradmin">Refrescar datos <i class="fas fa-refresh"></i></button>-->

                      <thead>
                        <tr>
                          <th>Nombre del docente</th>
                          <th>Número de teléfono</th>
                          <th>Usuario</th>
                          <th>Privilegio</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

                      <tbody id="table-body">

                          <?php
                                include_once('cont/conexion.php');

                                $query = "SELECT docentes.id_docente, CONCAT(docentes.nombre,' ', docentes.ape_paterno,' ', docentes.ape_materno) as nombres, docentes.num_tel, doc_admin.usuario, doc_admin.privilegio FROM docentes JOIN doc_admin ON docentes.id_docente=doc_admin.fk_docente";
                                $result = mysqli_query($conexion, $query);                            

                                while($data = mysqli_fetch_array($result)) {                            

                                    echo "<tr>"; 

                                    echo "<td>".$data['nombres']."</td>
                                            <td>".$data['num_tel']."</td>
                                            <td>".$data['usuario']."</td>
                                            <td>".$data['privilegio']."</td>
                                            <td><button type='button' class='btn btn-primary editar' data-toggle='modal' data-target='.bs-example-modal-lg' title='Editar registro' id=".$data['usuario']." ><i class='far fa-edit'></i></button>
                                            <button type='button' title='Borrar registro' class='btn btn-danger borrar' id=".$data['usuario']."><i class='far fa-trash-alt'></i></button></td>";
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
                    <h4 class="modal-title" id="myModalLabel">Modificar información del administrador</h4>
                </div>

                <div class="modal-body">
                  <form form id="update-user" data-parsley-validate method="post" action="cont/Admins.php" class="form-horizontal form-label-left" novalidate>                  
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

<script src="build/js/admin.js"></script>