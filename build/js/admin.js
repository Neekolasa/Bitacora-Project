$(document).ready(function() {
    $(document).on('click', '.editar', function(){

        var edit_id = $(this).attr('id');
        //console.log("Edit id: "+edit_id);
        var datos = {
            "edit_id":edit_id
        };

        $.ajax({
            url:"cont/Admins.php",
            type:"post",
            data: datos,
            success:function(data) {
              $("#update-user").html(data);
              $("#exampleModal").modal('show');
            }
        });
    });

    $(document).on('click','.borrar', function(){
        var id = $(this).attr('id');
        //console.log(id);
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
              "id":id,
              "borrar":true
          };
          //console.log(datos);
          $.ajax({
            url:"cont/Admins.php",
            type:"post",
            data: datos,
            success:function(data) {

              var resultado = JSON.parse(data);
              console.log(resultado.respuesta);

              if (resultado.respuesta == 'Success') {
                  Swal.fire(
                      'Correcto',
                      'El registro se ha eliminado correctamente',
                      'success'
                    ).then(function(){ 
                        location.reload();
                      }
                    ); 
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

  
  $('#update-user').on('submit',function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var datos = $(this).serializeArray();

        console.log(datos);

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
            
                var resultado = data;
                //console.log(resultado.respuesta);
                if (resultado.respuesta == 'Success') {

                    Swal.fire(
                        'Correcto',
                        'El alumno se ha modificado correctamente',
                        'success'
                      ).then(function(){ 
                        location.reload();
                      }
                    ); 

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