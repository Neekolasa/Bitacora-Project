function buscarid() {
	var name= document.getElementById("alumno").value;
    console.log(name);

    var parametros = {
        "name": name
    };

    $.ajax({
        data: parametros,
        url: "cont/busqAlumnoId.php",
        type: "POST",
        success: function(response){
            var res= response;
            //console.log(res);
            $("#nombres").html(res);
        }
    });
}