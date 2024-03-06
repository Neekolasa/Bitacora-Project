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

 <title>Docentes | Administrar</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->

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

                    <h2>Ver lista de docentes</h2>
                    <button type="button" style="margin-left: 20px;" onclick="location.href='agregar_docente.php'" class="btn btn-success admin"><i style="margin-right: 7px;" class="fas fa-plus-square"></i>Nuevo</button>

                    <div class="clearfix"></div>

                    <nav aria-label="breadcrumb" id="bread">

                      <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="#">Docentes</a></li>

                        <li class="breadcrumb-item active">Administrar</li>

                      </ol>

                    </nav>

                  </div>



                  <div class="x_content">

                    <table id="datatable-buttons" class="table table-striped table-bordered">

                      <thead>

                        <tr>
                          <th>Nombre</th>
                          <th>Apellido Paterno</th>
                          <th>Apellido Materno</th>
                          <th>Teléfono</th>
                          <th>Correo electrónico</th>
                          <th class="admin">Acciones</th>
                        </tr>

                      </thead>

                      <tbody id="tablita">



                        <?php



                          include_once 'cont/conexion.php';  



                          $consulta="SELECT * FROM docentes";



                          $resultado=mysqli_query($conexion,$consulta);



                          while ($res=mysqli_fetch_array($resultado)) 



                          {



                            echo "



                              <tr>

                                <td>$res[nombre]</td>

                                <td>$res[ape_paterno]</td>

                                <td>$res[ape_materno]</td>

                                <td>$res[num_tel]</td>

                                <td>$res[correo_electronico]</td>

                                <td class='admin'><button type='button' class='btn btn-primary editar admin' data-toggle='modal' data-target='.bs-example-modal-lg' title='Editar registro' id=$res[id_docente] ><i class='far fa-edit'></i></button>
                                <button type='button' title='Borrar registro' class='btn btn-danger borrar_docente admin' id=$res[id_docente]><i class='far fa-trash-alt'></i></button>

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



                    <h4 class="modal-title" id="myModalLabel">Modificar registro de docente</h4>



                </div>



                <div class="modal-body">



                  <form form id="update-docente" data-parsley-validate method="post" action="ver_docentes.php" class="form-horizontal form-label-left" novalidate>

                    

                          







                  </form>

                </div>

                </div>



            </div>



        </div>

      </div>

    </div>



<?php  



    include_once 'templates/footer.php';



    if (isset($_POST['token'])) {

      

      $email=$_POST['email'];

      $email2=$_POST['confirm_email'];

     



      if ($email==$email2) 

      {

        $telefono=$_POST['telefono'];

        $ape_materno=$_POST['ape_materno'];

        $ape_paterno=$_POST['ape_paterno'];

        $nombre=$_POST['nombre'];

        $id=$_POST['id_bit'];



        $consulta="UPDATE docentes SET nombre='$nombre',ape_paterno='$ape_paterno',ape_materno='$ape_materno',num_tel='$telefono',correo_electronico='$email' WHERE id_docente='$id'";

        

        

        

        $res=mysqli_query($conexion,$consulta);

        if ($res) 

        {

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

<script src="../vendors/validator/validator.js"></script>

<script type="text/javascript">

  $(document).on('click','.editar',function(){

    var modify_id=$(this).attr('id');

    console.log(modify_id);



    $.ajax({

      url: 'cont/mod_docente.php',

      type: 'post',

      data: {"modify_id": modify_id},



    })

    .done(function(data) {

      $("#update-docente").html(data);

      $("#exampleModal").modal('show');

    })

    .fail(function() {

      console.log("error");

    })

    .always(function() {

      console.log("complete");

    });

    

  });



  $(document).on('click','.borrar_docente', function()

  {

    var borrar_docente=$(this).attr('id');

   



    $.ajax({

      url: 'cont/docentes.php',

      type: 'post',

      data: {"borrar_docente": borrar_docente},

    })

    .done(function() {

      Swal.fire(



              'Correcto',



              'El registro se eliminó correctamente',



              'success').then(function(){

                location.reload();

              });

    })

    .fail(function() {

      Swal.fire({



              type: 'error',



              title: 'Oops...',



              text: 'Algo ha salido mal, por favor verifique los datos'



              });

    })

  

    

  })

</script>
<script type="text/javascript">
  
  var privilegio='<?php echo $privilegio ?>';
  gestor_recursos(privilegio);

</script>