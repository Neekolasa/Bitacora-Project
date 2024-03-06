$(document).ready(function() {

    function dataRefresh(){
        $.ajax({
            type: "GET",
            url: 'cont/vercitatorios.php',
            success:function(response){
                $('#table-body').html(response);
            }
        });
    }

  $(document).on('click', '.ver', function(){

      var id = $(this).attr('id');
      //console.log("Edit id: "+id);
      /*var datos1 = {
          "id":id
      };*/

      if(id != null) {
          var form = document.createElement('FORM');
          form.method='POST';
          form.action = 'vercitatorio.php';
          form.target = 'newWindow'; // Specify the name of the window(second parameter to window.open method.)

          var input = document.createElement("INPUT");
          input.name='id';
          input.type="hidden";
          input.value=id;
          form.appendChild(input);    
          document.body.appendChild(form);

          window.open("","newWindow","location=yes,width=900,height=1600");
          form.submit();
      }

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
              "formato":"citatorio"
          };
          //console.log(datos);
          $.ajax({
            url:"../../cont/Formatos.php",
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
                    ).then(function(){
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
});