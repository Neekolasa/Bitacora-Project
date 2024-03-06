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
 <title>Bitácora | Administrar</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
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
                    <h2>Ver bitácora</h2>
                    <button type="button" style="margin-left: 20px;" onclick="location.href='agregar_bitacora.php'" class="btn btn-success admin"><i style="margin-right: 7px;" class="fas fa-plus-square"></i>Nuevo</button>
                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Bitácora</a></li>
                        <li class="breadcrumb-item active">Administrar</li>
                      </ol>
                    </nav>
                  </div>

                  <div class="x_content">

                    <table id="datatable-buttons" class="table table-striped table-bordered">

                     

                      <thead>

                        <tr>
                          <th>Fecha</th>
                          <th>Hora</th>
                          <th>Nombre</th>
                          <th>Apellido Paterno</th>
                          <th>Apellido Materno</th>
                          <th>Grado y grupo</th>
                          <th>Turno</th>
                          <th>Motivo</th>
                          <th class="admin" style="display:none">Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="tablita">

                        <?php

                          include_once 'cont/conexion.php';  

                          $consulta="SELECT bitacora.fecha,bitacora.hora,bitacora.motivo, alumno.id_alumno,bitacora.id_bitacora,alumno.nombre,alumno.ape_paterno,alumno.ape_materno, grado_grupo.nombre as grado_grupo, grado_grupo.turno FROM bitacora JOIN alumno on fk_alumno=id_alumno JOIN grado_grupo ON fk_grado_grupo=id_grupo";

                          $resultado=mysqli_query($conexion,$consulta);

                          while ($res=mysqli_fetch_array($resultado)) 

                          {

                            echo "

                              <tr>
                                <td>$res[fecha]</td>
                                <td>$res[hora]</td>
                                <td>$res[nombre]</td>
                                <td>$res[ape_paterno]</td>
                                <td>$res[ape_materno]</td>
                                <td>$res[grado_grupo]</td>
                                <td>$res[turno]</td>
                                <td>$res[motivo]</td>
                                <td class='admin'>
                                <button type='button' class='btn btn-primary editar admin' data-toggle='modal' data-target='.bs-example-modal-lg' title='Editar registro' id=$res[id_bitacora] ><i class='far fa-edit'></i></button>
                                  <button type='button' title='Borrar registro' class='btn btn-danger borrar_bita admin' id=$res[id_bitacora]><i class='far fa-trash-alt'></i></button>
                                </td>
                              </tr>

                            ";
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

                    <h4 class="modal-title" id="myModalLabel">Modificar registro de la bitácora</h4>

                </div>

                <div class="modal-body">

                  <form form id="update-bitacora" data-parsley-validate method="post" action="bitacora.php" class="form-horizontal form-label-left" novalidate>
                    
                          



                  </form>
                </div>
                </div>

            </div>

        </div>
      </div>
    </div>

<?php  

    include_once 'templates/footer.php';

    if (isset($_POST['modify'])) {
      $nombre=$_POST['alumno'];
      $motivo=$_POST['motivo'];
      $id=$_POST['id'];

      

      $selec_id="SELECT id_alumno, nombre, ape_paterno, ape_materno FROM alumno";

      $res=mysqli_query($conexion,$selec_id);

      while ($a=mysqli_fetch_array($res)) 

        {

          $id_alum=$a['id_alumno'];

          $nom=$a['nombre']." ".$a['ape_paterno']." ".$a['ape_materno'];

          if ($nom==$nombre) 

          {

            $identificador=$id_alum;

            
            $consulta="UPDATE bitacora set motivo='$motivo', fk_alumno=$identificador WHERE id_bitacora=$id";
           


            $resultado=mysqli_query($conexion,$consulta);

          }

        }
        if ($resultado==1) {

              echo "<script>

              Swal.fire(

              'Correcto',

              'El registro se modificó correctamente',

              'success').then(function(){
                window.location.href = window.location.href;
              });

  

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

<script src="build/js/alumnos.js"></script>
<script type="text/javascript">
  $(document).on('click','.editar',function(){
    var modify_id=$(this).attr('id');
    console.log(modify_id);

    $.ajax({
      url: 'cont/mod_bitacora.php',
      type: 'post',
      data: {"modify_id": modify_id},

    })
    .done(function(data) {
      $("#update-bitacora").html(data);
      $("#exampleModal").modal('show');
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  });

</script>
<script type="text/javascript">
  
  var privilegio='<?php echo $privilegio ?>';
  gestor_recursos(privilegio);

</script>