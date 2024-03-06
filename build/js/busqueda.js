function busqueda(){

    var name= document.getElementById("alumno").value;
    console.log(name);

    var parametros = {
        "name": name
    };

    $.ajax({
        data: parametros,
        url: "cont/busqAlumno.php",
        type: "POST",
        success: function(response){
            var res= response;
            //console.log(res);
            $("#nombres").html(res);
        }
    });
}

function fill(){
    var name = document.getElementById("alumno").value;
    //console.log("Estudiante Seleccionado:" + name);
    var parametros = {
        "name": name
    };

    $.ajax({
        data: parametros,
        url: "cont/busqGrupo.php",
        type: "POST",
        success: function(response){
            try {
                var res= JSON.parse(response);
                //console.log(res);
                document.getElementById("grado").value = res.nombre[0];
                document.getElementById("grupo").value = res.nombre[1];
    
                var turno = document.getElementById("turno").value;
                
                if(turno != null) {
                    document.getElementById("turno").value= res.turno;
                } 
            } catch (error) {
                console.log(error);
            }
        }
    });

}
