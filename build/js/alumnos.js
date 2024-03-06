$(document).ready(function() {

    function dataRefresh(){
        $.ajax({
            type: "GET",
            url: 'cont/veralumnos.php',
            success:function(response){
                $('#table-body').html(response);
            }
        });
    }
    function dataRefreshBita(){
        $.ajax({
            type: "GET",
            url: 'cont/verbitacora.php',
            success:function(response){
                $('#tablita').html(response);
            }
        });
    }
    function dataRefreshAdmin(){
        $.ajax({
            type: "GET",
            url: 'cont/veradministradores.php',
            success:function(response){
                $('#tablita').html(response);
            }
        });
    }

    //$("#table-body").load('alumnos.php' + " #table-body");
    /*var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("#table-body").html(this.responseText);
      }
    };
    xhttp.open("GET", "cont/veralumnos.php", true);
    xhttp.send();*/

    /*setInterval(function() {
        $('#table-body').load('cont/veralumnos.php');
    }, 1000);*/

    /*function getData() {
        setInterval(function() {
            //$('#table-body').load('cont/veralumnos.php').fadeIn('slow');
        }, 1000);
        $.ajax({
            type: "GET",
            url: 'cont/veralumnos.php',
            success:function(response){
                $('#table-body').html(response);
            },
        });
    }*/

    $(document).on('click', '.refrescar', function(){
        //var edit_id = $(this).attr('id');
        //console.log("Refresh");
        dataRefresh();
    });
    $(document).on('click', '.refrescarbita', function(){
        //var edit_id = $(this).attr('id');
        //console.log("Refresh");
        dataRefreshBita();
    });
    $(document).on('click', '.refrescaradmin', function(){
        //var edit_id = $(this).attr('id');
        //console.log("Refresh");
        dataRefreshAdmin();
    });

    $(document).on('click', '.borrar', function(){

        var delete_id = $(this).attr('id');
        //console.log(delete_id);
        
        Swal.fire({
          title: '¿Estás Seguro?',
          text: "Si lo borras no podrás recuperarlo!",
          type: 'warning',
          showCancelButton: true,
          cancelButtonText:"Cancelar",
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
          if (result.value == true) {
            //console.log(result.value);
            var datos = {
                "delete_id":delete_id
            };
           $.ajax({
              url:"cont/Alumnos.php",
              type:"post",
              data: datos,
              success:function(data) {
                var resultado = JSON.parse(data);
                //console.log(resultado.respuesta);
                if (resultado.respuesta == 'Success') {
                    Swal.fire(
                        'Correcto',
                        'El registro se ha eliminado correctamente',
                        'success'
                      ).then(function()
                        {
                          location.reload();
                        });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Algo ha salido mal, por favor intente de nuevo'
                      })
                }
              }
            });
          }
        })
    });


    $(document).on('click', '.borrar_bita', function(){

        var delete_id = $(this).attr('id');
        console.log(delete_id);
        
        Swal.fire({
          title: '¿Estás Seguro?',
          text: "Si lo borras no podrás recuperarlo!",
          type: 'warning',
          showCancelButton: true,
          cancelButtonText:"Cancelar",
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
          if (result.value == true) {
            //console.log(result.value);
            /*var datos = {
                "delete_id":delete_id
            };*/
            $.ajax({
              url: 'cont/Bitacora.php',
              type: 'post',
              data: {"delete_id": delete_id},
            })
            .done(function() {
              Swal.fire(
                        'Correcto',
                        'El registro se ha eliminado correctamente',
                        'success'
                      ).then(function()
                        {
                          location.reload();
                        });
            })
            .fail(function() {
              Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Algo ha salido mal, por favor intente de nuevo'
                      });
            })
          }
        })
    });

    $(document).on('click', '.editar', function(){

        var edit_id = $(this).attr('id');
        //console.log("Edit id: "+edit_id);
        var datos = {
            "edit_id":edit_id
        };

        $.ajax({
            url:"cont/Alumnos.php",
            type:"post",
            data: datos,
            success:function(data) {
            $("#update-alumno").html(data);
            $("#exampleModal").modal('show');
            }
        });
    });

    $('#update-alumno').on('submit',function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var datos = $(this).serializeArray();

        //console.log(datos);

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
            
                var resultado = data;
                //console.log(resultado);

                if (resultado.respuesta == 'Success') {

                    Swal.fire(
                        'Correcto',
                        'El alumno se ha modificado correctamente',
                        'success'
                      ).then(function()
                        {
                          location.reload();
                        });

                } else {
                    Swal.fire({
                    type: 'error',
                    title: 'Usuario y/o contraseña incorrectos',
                    text: 'Por favor verifique los datos'
                    })
                }
            }
        });
    });
});