<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8">
<?php
    include_once 'templates/head.php';
?>
<title>BITS | Recuperar contraseña</title>
  <body class="login">
    <div>
      <center>
        <img src="images/banner2.jpg" id="banner-sec" alt="X">
        <h1>Bitacora digital para el departamento de trabajo social</h1>
      </center>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">

            <form id="login-form" method="post" action="recuperar_pass.php">
              <h1>Recuperar contraseña</h1>
              <!--<center>
                <img style="margin-bottom: 7%;" width="35%" height="auto" src="images/22.png" alt="X">
              </center>-->
              <div>
                <input type="email" id="mail" name="mail" class="form-control" placeholder="Correo electrónico" required="" />
              </div>
              
              <div>
                <input type="submit" class="btn btn-dark" value="Enviar" style="float: none;margin-left: 0;width: 50%;">
                <input type="hidden" id="token" name="token">
              </div>
             
              <div class="clearfix"></div>

              <div class="separator">
            </form>
                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©2019 Todos los derechos reservados.</p>
                </div>
              </div>
            
          </section>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
  if (isset($_POST['token'])) 
  {
    include_once 'cont/conexion.php';
    include_once 'cont/encriptar.php';
    $mail=$_POST['mail'];
    $consulta="SELECT docentes.nombre,doc_admin.usuario,doc_admin.contra FROM docentes JOIN doc_admin on id_docente=fk_docente WHERE docentes.correo_electronico='$mail'";
    $res=mysqli_query($conexion,$consulta);
    if (mysqli_num_rows($res)>0) 
    {
      while ($resultado=mysqli_fetch_array($res)) {
      $nombre=$resultado['nombre'];
      $usuario=$resultado['usuario'];
      $contra=$resultado['contra'];
    }
      $enc=encrypt($usuario,"GARLIK");
      $url="http://bitacora.siadurangomex.com/reestablecer.php?token=$enc";
    //$msg="tu contraseña es 123";
    $msg="
    <table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;'>
  
      <tr>
        <td style='background-color: #ecf0f1'>
          <div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif'>
            <h2 style='color: #e67e22; margin: 0 0 7px'>Hola $nombre!</h2>
            <p style='margin: 2px; font-size: 15px'>
              Nos hemos percatado que deseas recuperar tu contraseña del sistema web BITS<br>
              Para acceder a tu cuenta te adjuntamos a continuación un link con el cual podrás re-establecer tu usuario y contraseña:
              </p>
            <ul style='font-size: 15px;  margin: 10px 0'>
              <li><a href='$url'>$url</a></li>
              
            </ul>
            
            <div style='width: 100%; text-align: center'>
              <a style='text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db' href='$url'>Ir a la página</a> 
            </div>
            <p style='color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0'>Bitácora de Trabajo Social (BITS)</p>
          </div>
        </td>
      </tr>
    </table>";
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //echo "<script>alert('Mail enviado')</script>";
    $res=mail($mail,"Recuperar contraseña BITS",$msg,$cabeceras);
    if ($res) {
      echo "<script>
                    Swal.fire(
                    'Correcto',
                    'Revise su bandeja de entrada',
                    'success').then(function(){
      window.location.replace('login.php');
    });
                  </script>" ;
    }
    else
    {
      echo "<script>
                    Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Algo ha salido mal'
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
                    text: 'Algo ha salido mal'
                    })
                    </script>";
    }
    
  }
?>

