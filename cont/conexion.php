<?php

	/*$servidor = "bitacora.siadurangomex.com";
	$user = "1006416_ob63556";
	$pass = "Bita_2018";
	$bd = "1006416-bitacora";*/
	$servidor="santacruza.proyectosutd.com";
	$bd="proyec23_santacruza";
	$user="proyec23_usana";
	$pass="O4RPCWR8RB";

	$conexion = mysqli_connect($servidor, $user, $pass, $bd);

	if ($conexion->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }/*else if($conexion){
        echo "<script>alert('exito')</script>";
    }*/
?>