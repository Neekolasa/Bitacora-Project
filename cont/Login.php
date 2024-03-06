<?php
    session_start();
    include_once('conexion.php');
    if (isset($_POST['token'])) {
      $user = $_POST['user'];
      $pass = md5($_POST['pass']);
  
      $query="SELECT * FROM doc_admin WHERE usuario= '$user' AND contra='$pass'";
      $result = mysqli_query($conexion, $query);
      $a = mysqli_fetch_array($result);
  
      $privilegio = $a['privilegio'];
      $_SESSION['usuario']=$user;
      $_SESSION['privilegio']=$privilegio;
      if ($result && $privilegio != NULL) {
      
        $respuesta = array(
          'respuesta' => "Success",
          'privilegio' => $privilegio
        );

        
      } else{
    
        $respuesta = array(
          'respuesta' => 'Fail'
        );
      }
  
      $conexion->close();
      die(json_encode($respuesta));
    }

?>