<?php 
	$usuario=$_GET['token'];

	
?>
<!DOCTYPE html>
<html lang="es">
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

            <form id="login-form" method="post" action="reestablecer.php?usr=<?php echo $usuario?>">
              <h1>Recuperar contraseña</h1>
              <!--<center>
                <img style="margin-bottom: 7%;" width="35%" height="auto" src="images/22.png" alt="X">
              </center>-->
              <div>
                <input type="password" id="pass1" name="pass1" class="form-control" placeholder="Nueva contraseña" minlength="5" required="" />
              </div>
              <div>
                <input type="password" id="pass2" name="pass2" class="form-control" placeholder="Confirmar contraseña" data-validate-linked="pass1" required="" />
              </div>
              <div>
                <input type="submit" class="btn btn-dark" value="Reestablecer" style="float: none;margin-left: 0;width: 50%;">
                <input type="hidden" id="token" name="hidden">
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
    <script src="vendors/validator/validator.js"></script>
  </body>
</html>
<?php 
	include_once 'cont/conexion.php';
	include 'cont/encriptar.php';
	if (isset($_POST['hidden'])) {
		$pass=$_POST['pass1'];
		$pass2=$_POST['pass2'];
		$usuario=decrypt($_GET['usr'],"GARLIK");
		if ($pass===$pass2) 
		{
			$pass=md5($pass);
			$consulta="UPDATE doc_admin SET contra='$pass' WHERE usuario='$usuario'";

			$res=mysqli_query($conexion,$consulta);
			if ($res==1) 
			{
				echo "<script>
                    Swal.fire(
                    'Correcto',
                    'Se ha actualizado su contraseña',
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