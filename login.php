<?php
  session_start();
  if (isset($_GET['token'])) {
    
    unset($_SESSION['usuario']);
    unset($_SESSION['privilegio']);
    echo "<script>window.location.replace('login.php')</script>";
  }
?>
<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8">
<?php
    include_once 'templates/head.php';
?>
<title>BITS | Acceso al sistema</title>
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

            <form id="login-form" method="post" action="cont/Login.php">
              <h1>Inicio de Sesión</h1>
              <!--<center>
                <img style="margin-bottom: 7%;" width="35%" height="auto" src="images/22.png" alt="X">
              </center>-->
              <div>
                <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" required="" />
              </div>
              <div>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña" required="" />
              </div>
              <div>
                <input type="submit" class="btn btn-dark" value="Entrar" style="float: none;margin-left: 0;width: 50%;">
                <input type="hidden" id="token" name="token">
              </div>
              <div>
                <a href="recuperar_pass.php" target="_blank">Olvidé mi contraseña</a>
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
    <script src="build/js/busqueda.js"></script>
    <script src="build/js/bitacora.js"></script>
  </body>
</html>

